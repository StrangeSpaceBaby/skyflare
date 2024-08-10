<?php

/**
 *	_mem is short for member, i.e., 'user'
 */

class _mem extends _obj
{
	public function __construct()
	{
		parent::__construct( '_mem' );
		$this->init_me();
	}

	public function email_exists( string $email ) : int|string
	{
		if( $mem_id = $this->is_duplicate_email( $email ) )
		{
			$this->success( 'email_exists' );
			return $mem_id;
		}

		$this->fail( 'email_does_not_exist' );
		return $mem_id;
	}

	/**
	 * Checks that the email doesn't already exist for this _co
	 *
	 * @param string $email
	 * @return integer|boolean _mem_id or FALSE on error
	 */
	public function is_duplicate_email( string $email ) : int|bool
	{
		$exists = $this->get_by_col([ '_mem_email' => $email ]);
		if( $exists )
		{
			$this->fail( 'email_exists' );
			return $exists['_mem_id'];
		}

		$this->success( 'email_available' );
		return FALSE;
	}

	/**
	 * Saves _mem after converting _mem_dob to an acceptable date_format
	 *
	 * @param array $args _mem_*
	 * @return integer|boolean return from parent::save
	 */
	public function save( array $args ) : int|bool
	{
		if( $args['_mem_dob'] )
		{
			try
			{
				$dob = new DateTimeImmutable( $args['_mem_dob'] );
				$args['_mem_dob'] = $dob->format( 'Y-m-d' );
			}
			catch( Exception $e )
			{
				$this->fail( 'invalid_dob' );
				return FALSE;
			}
		}

		return parent::save( $args );
	}

	/**
	 * Using the current _mem_token, selects _mem and _module__mem
	 * and returns the merged array
	 *
	 * @return array|boolean _mem+_module__mem array or FALSE on error
	 */
	public function init_me() : array|bool
	{
		// This will get the logged in user
		$o_token = new _auth_token();
		$auth_token = $o_token->verify_token();

		if( !$auth_token['fk__mem_id'] )
		{
			$this->fail( 'not_logged_in' );
			return FALSE;
		}

		$me = $this->get_by_id( $auth_token['fk__mem_id'] );

		if( FALSE === $me )
		{
			$this->fail( 'could_not_fetch_mem_for_initting' );
			return FALSE;
		}

		if( !$me )
		{
			$this->fail( 'mem_not_found_for_initting' );
			return FALSE;
		}

		$me['roles'] = [];
		$o__module__mem = new _module__mem();
		$module_mem = $o__module__mem->get_by__mem_id( $me['_mem_id'] );

		if( $module_mem )
		{
			$me['roles'] = array_column( $module_mem, 'fk__role_id' );
		}

		$this->success( 'me_initted' );
		// me stored in session for easier retrieval without having to parse the current mem token each time.
		$_SESSION['me'] = $me;
		return $me;
	}

	/**
	 * Returns single key or entire me array
	 *
	 * @param string $key
	 * @return array|string single value or entire array
	 */
	public function me( string $key = '' ) : array|string
	{
		if( !$_SESSION['me'] )
		{
			$this->init_me();
		}

		if( $key )
		{
			return $_SESSION['me'][$key];
		}

		return $_SESSION['me'];
	}

	/**
	 *	new_mem() creates a new member for the company
	 *
	 * @param array $vars _mem*
	 * @return boolean|array returns the _mem array, FALSE on error
	 */
	public function new_mem( array $vars ) : bool|array
	{
		// This ensures we never overwrite anyone and always create a new record
		unset( $vars['_mem_id'] );

		if( !$vars['_mem_email'] )
		{
			$this->fail( 'no_email_given' );
			return FALSE;
		}

		if( $vars['_mem_password'] )
		{
			$vars['_mem_password'] = $this->encrypt_password( $vars['_mem_password'] );
		}
		else
		{
			$vars['_mem_password'] = $this->encrypt_password( $this->generate_ulid() );
		}

		if( $vars['_mem_dob'] )
		{
			try
			{
				$dob = new DateTimeImmutable( $vars['_mem_dob'] );
				$dob = $dob->format( 'Y-m-d' );
				$vars['_mem_dob'] = $dob;
			}
			catch( Exception $de )
			{
				$this->fail( 'invalid_dob' );
				return FALSE;
			}
		}

		$o__mem_auth = new _mem_auth();
		if( $o__mem_auth->check_login_exists( $vars['_mem_email'] ) )
		{
			$this->fail( 'email_already_in_use' );
			return FALSE;
		}

		if( !$vars['fk__role_id'] )
		{
			$o__role = new _role();
			$vars['fk__role_id'] = $o__role->get_default_role()['_role_id'];
		}

		if( !$vars['_mem_code'] )
		{
			$vars['_mem_code'] = $this->generate_mem_code();
		}

		$_mem_id = $this->save( $vars );
		if( FALSE === $_mem_id )
		{
			$this->fail( $this->get_error_msg() );
			return FALSE;
		}

		$vars['fk__mem_id'] = $_mem_id;
		$vars['_mem_id'] = $_mem_id;

		if( !$vars['no_login'] )
		{
			$_mem_auth_id = $o__mem_auth->make_new_auth([ 'fk__mem_id' => $vars['fk__mem_id'], '_mem_login' => $vars['_mem_email'], '_mem_password' => $vars['_mem_password'] ]);
			if( FALSE === $_mem_auth_id )
			{
				$this->fail( 'db_error' );
				return FALSE;
			}
			$vars['fk__mem_auth_id'] = $_mem_auth_id;

		}

		$this->success( 'new__mem_saved' );
		return $vars;
	}

	/**
	 * Generates a unique code with microtimestamp and generated ulid
	 *
	 * @return string _mem_code
	 */
	public function generate_mem_code() : string
	{
		return $this->alphaID( microtime( true ), FALSE, FALSE, $this->generate_ulid() );
	}
}
