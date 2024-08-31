<?php

class _auth extends _obj
{
	public function __construct()
	{
		parent::__construct( '_mem_auth' );
		$this->log_chan( '_auth' )->log_lvl( 'error' );
	}

	public function send_magic_link( string $email ) : mixed
	{
		$o__mem = new _mem();
		$_mem_id = $o__mem->email_exists( $email );
		if( !$_mem_id )
		{
			$this->fail( 'mem_does_not_exist_with_email' );
			return $_mem_id;
		}
		$_mem = $o__mem->get_by_id( $_mem_id );

		$o__mem_reset = new _mem_reset();
		$reset = $o__mem_reset->create_reset([
			'_mem_reset_type' => 'magic',
			'fk__mem_id' => $_mem['_mem_id']
		]);

		$o_setting = new _setting();
		$product_name = $o_setting->by_key( 'product_name' );
		$app_domain = $o_setting->by_key( 'app_domain' );

		$_co = new _co();
		$co_domain = $_co->_co( '_co_domain' );

		global $_tpl;
		$_tpl->assign( 'product_name', $product_name );
		$_tpl->assign( 'https', $_SERVER['HTTPS'] ? 'https' : 'http' );
		$_tpl->assign( 'app_domain', $co_domain . '.' . $app_domain );
		$_tpl->assign( 'recipient_name', $_mem['_mem_fname'] );
		$_tpl->assign( 'reset_token', $reset['_mem_reset_token'] );

		$o__comm = new _comm();
		$sent = $o__comm->email([
			'recipient' => $_mem['_mem_email'],
			'template' => 'email/magic_link',
			'subject' => $product_name . ' Magic Link',
		]);

		if( !$sent )
		{
			$this->fail( $this->get_error_msg() );
			return FALSE;
		}

		$this->success( 'magic_link_sent' );
		return $sent;
	}

	/**
	 * Given a valid token, a new token is generated. Always exits
	 *
	 * @return void
	 */
	public function refresh_token() : void
	{
		$o_token = new _auth_token();
		$token = $o_token->get_token();

		if( $token )
		{
			$auth_token = $o_token->get_by_col([ '_auth_token' => $token ]);
			if( $auth_token )
			{
				$new_token = $o_token->generate_token( $auth_token['fk__mem_id'], 'password' );
				if( $new_token )
				{
					header( 'auth_token: ' . $new_token['_auth_token'] );
					header( 'auth_token_expires: ' . $new_token['_auth_token_expires'] );
					header( 'auth_token_checksum: ' . $this->hash( $token . $new_token['_auth_token'] ) );
					header( 'HTTP/1.1 200 Auth Token Refreshed', TRUE, 200 );
				}
			}
		}

		exit;
	}

	/**
	 * auth() verifies an existing token, then checks to see if the requested path
	 * is a public path. If there is a token, it then returns the token array.
	 * If not, it returns FALSE and an 'unverified token' log msg.
	 *
	 * @param array $vars [ '_mem_login' => '', '_mem_password' => '' ]
	 * @return string|boolean An auth_token if successful, FALSE if not
	 */
	public function auth() : array|bool
	{
		$this->log_msg( '_auth->auth()' );

		$o_token = new _auth_token();
		$auth_token = $o_token->verify_token();
		$this->log_data([ 'auth_token' => $auth_token ]);

		if( $auth_token )
		{
			$this->log_msg( 'authenticated' );
			$this->success( 'valid_auth_token' );
			return $auth_token;
		}

		$this->log_msg( 'unverified_token' );
		$this->fail( 'token_expired' );
		return FALSE;
	}

	/**
	 * Generates token if login and password are valid
	 *
	 * @return array|boolean token data if successful, FALSE on error
	 */
	public function password() : array|bool
	{
		$this->log_data([ '_mem_login' => _POST['_mem_login'] ]);

		$o_token = new _auth_token();
		$curr_token = $o_token->verify_token();

		$this->log_data([ 'curr_token' => $curr_token ]);

		if( $curr_token )
		{
			$this->log_msg( 'valid_token_already' );
			header( 'auth_token: ' . $curr_token['_auth_token'] );
			header( 'auth_token_expires: ' . $curr_token['_auth_token_expires'] );
			header( 'auth_token_already_valid: 1' );

			header(  $_SERVER["SERVER_PROTOCOL"] . "200 Access token already valid", TRUE, 200 );
			return TRUE;
		}

		if( _POST['_mem_login'] && _POST['_mem_password'] )
		{
			$this->log_msg( 'has_login_creds' );
			$_mem = $this->get_by_col([ '_mem_login' => _POST['_mem_login'] ], FALSE, TRUE, [], "*" );
			$this->log_data([ '_mem' => $_mem ]);
			if( $_mem['fk__mem_id'] )
			{
				$this->log_msg( '_mem_found' );
				if( !password_verify( _POST['_mem_password'], $_mem['_mem_password'] ) )
				{
					$this->log_msg( 'invalid_password' );
					$this->fail( 'invalid_password' );
					return FALSE;
				}

				$o_token = new _auth_token();
				$token = $o_token->generate_token( $_mem['fk__mem_id' ] );

				$this->log_data([ 'generated_token' => $token ]);

				header( 'auth_token: ' . $token['auth_token'] );
				header( 'auth_token_expires: ' . $token['expires'] );
				header( 'auth_token_generated: 1' );
				header( $_SERVER["SERVER_PROTOCOL"] . " 200 Authenticated", TRUE, 200 );

				$this->log_msg( 'token_generated' );
				$this->success( 'token_generated' );
				return $token;
			}
			else
			{
				$this->log_msg( 'login_not_found' );
				$this->fail( 'login_not_found' );
				return FALSE;
			}
		}

		$this->log_msg( 'missing_credentials' );
		$this->fail( 'missing_credentials' );
		return FALSE;
	}


	/**
	 * Returns an array of all _public_paths, either the entire rows or just the paths themselves.
	 *
	 * @param boolean $values_only TRUE returns only the paths.
	 * @return array paths or _public_paths
	 */
	protected function get_public_paths( bool $values_only = TRUE ) : array
	{
		$q = "SELECT * FROM _public_path WHERE _public_path_active = 1 AND _public_path_del IS NULL AND _public_path_arch IS NULL";
		$sth = $this->query( $q );

		$paths = [];
		while( $row = $sth->fetch() )
		{
			if( $values_only )
			{
				$paths[] = $row['_public_path'];
			}
			else
			{
				$paths[$row['_public_path_id']] = $row;
			}
		}

		return $paths;
	}
}
