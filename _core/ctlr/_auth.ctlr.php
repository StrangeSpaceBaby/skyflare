<?php

/**
 *	the auth_ctlr manages the interface for authentication. Authentication type can be password or resource.
 */

class _auth_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_auth' );
        $this->log_chan( '_auth' )->log_lvl( 'error' );
	}

    public function magic_link()
    {
        $email = _POST['_mem_login'];
		$magic_link_sent = $this->obj->send_magic_link( $email );
		if( !$magic_link_sent )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'A magic link has been sent to your email inbox.' );
		return $email;
    }

	/**
	 * Determines whether that current user is authenticated
	 *
	 * @param string $path The passed path from the index controller
	 * @return array|boolean token array or FALSE on error
	 */
	public function auth( string $path ) : array|bool
	{
		$authenticated = $this->obj->auth( $path );
		if( $authenticated )
		{
			$this->success( 'authenticated' );
			return $authenticated;
		}

		$this->fail( 'not_authenticated' );
		return FALSE;
	}

	/**
	 * Attempts to authenticate using _POST login and password
	 *
	 * @return array|boolean token array or FALSE on error
	 */
	public function password() : array|bool
	{
		$token = $this->obj->password();
		if( $token )
		{
			$this->success( 'password_auth_granted' );
			return $token;
		}

		$this->fail( $this->obj->get_error_msg() );
		return FALSE;
	}

	/**
	 * Authenticates user using valid token
	 * and then generates new token and returns it
	 *
	 * @return array|boolean token array or FALSE on error
	 */
	public function refresh_token() : array|bool
	{
		$token = $this->obj->refresh_token();
		if( $token )
		{
			$this->success( 'auth_token_refreshed' );
			return $token;
		}

		$this->fail( 'auth_token_not_refreshed' );
		return FALSE;
	}

	/**
	 * Expires all tokens for authenticated user and redirects to the root path
	 * then exits
	 *
	 * @return void
	 */
	public function logout() : void
	{
		$o_token = new _auth_token();
		$o_token->expire_all_tokens();

		header( 'auth_token: ' );
		header( 'auth_token_expires: ' );
		header( 'HTTP/1.1 200 Logged out', TRUE, 200 );
		header( 'Location: /' );
		exit;
	}
}
