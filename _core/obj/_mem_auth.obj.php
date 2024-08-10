<?php

class _mem_auth extends _obj
{
	public function __construct()
	{
		parent::__construct( '_mem_auth' );
	}

	/**
	 * Creates new _mem_auth row with passed params.
	 * Can create new _mem_uath for new _co registration
	 *
	 * @param array $vars _mem_login, _mem_password, fk__mem_id
	 * @return integer|boolean _mem_auth_id, FALSE on error
	 */
	public function make_new_auth( array $vars ) : int|bool
	{
		if( !$vars['_mem_login'] || !$vars['_mem_password'] || !$vars['fk__mem_id'] )
		{
			$this->fail( 'missing_parameter' );
			return FALSE;
		}

		if( $this->check_login_exists( $vars['_mem_login'] ) )
		{
			$this->fail( 'email_already_in_use' );
			return FALSE;
		}

		$_mem_auth_id = $this->save([ '_mem_login' => $vars['_mem_login'], '_mem_password' => $vars['_mem_password'], 'fk__mem_id' => $vars['fk__mem_id'] ]);
		if( FALSE === $_mem_auth_id )
		{
			$this->fail( 'db_error' );
			return FALSE;
		}

		if( $vars['fk__co_id'] )
		{
			$assigned = $this->assign__co_ownership( $_mem_auth_id, $vars['fk__co_id'] );
			if( FALSE === $assigned )
			{
				$this->delete( $_mem_auth_id );
				$this->fail( 'could_not_assign__co_ownership' );
				return FALSE;
			}
		}

		$this->success( 'mem_auth_created' );
		return $_mem_auth_id;
	}

	/**
	 * Used for _co registration, assigns a reset to another _co
	 *
	 * @param integer $mem_auth_id
	 * @param integer $new_co_id
	 * @return boolean TRUE on assignment, FALSE on error
	 */
	private function assign__co_ownership( int $mem_auth_id, int $new_co_id ) : bool
	{
		$q = "UPDATE _mem_auth SET fk__co_id = ? WHERE _mem_auth_id = ?"; //Not auto_query because we need to override the fk__co_id corrections
		$sth = $this->query( $q, [ $new_co_id, $mem_auth_id ]);

		return '00000' == $sth->errorCode() ? TRUE : FALSE;
	}

	/**
	 * password_hash()s passed password and updates _mem_auth
	 *
	 * @param string $mem_auth_id
	 * @param string $password
	 * @return boolean TRUE on update, FALSE on error
	 */
	public function save_new_password( string $mem_auth_id, string $password ) : bool
	{
		$new_pass = $this->encrypt_password( $password );
		$saved = $this->save([ '_mem_auth_id' => $mem_auth_id, '_mem_password' => $new_pass ]);
		if( FALSE === $saved )
		{
			$this->fail( 'could_not_update_password' );
			return FALSE;
		}

		$this->success( 'password_updated' );
		return TRUE;
	}

	/**
	 * Gets current _mem_auth row for the _mem_id
	 *
	 * @param integer $mem_id
	 * @return array|boolean _mem_auth row, FALSE on error
	 */
	public function get_current_auth( int $mem_id ) :array|bool
	{
		$auth = $this->get_by_col([ 'fk__mem_id' => $mem_id ]);
		if( FALSE === $auth )
		{
			$this->fail( 'failure_to_get_current_auth' );
			return FALSE;
		}

		$this->success( 'current_auth_fetched' );
		return $auth;
	}

	/**
	 * This function jacked. First it returns false if the original query failed as per usual.
	 * However, this function eeds to return false or empty if there is no login matched.
	 * Therefore, 0 means available. So you have to explicitly trap for FALSE. Otherwise,
	 * it returns the _mem_id of the matched _mem_login
	 *
	 * @param string $login
	 * @return integer|boolean
	 */
	public function check_login_exists( string $login ) : int|bool
	{
		$login = $this->get_by_col([ '_mem_login' => $login ], FALSE, TRUE, [], "fk__mem_id" );
		if( FALSE === $login )
		{
			$this->fail( 'could_not_check_logins' );
			return TRUE; // This returns TRUE so that it can't be used since we can't check the database
		}

		if( $login['fk__mem_id'] )
		{
			$this->fail( 'login_exists' );
			return $login['fk__mem_id'];
		}

		$this->success( 'login_available' );
		return 0; // Because the login doesn't exist
	}
}
