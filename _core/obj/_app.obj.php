<?php

class _app extends _fail
{
	protected string $requested_path	= '/page/index';	// default path. Maybe should be set in init
	protected string $path				= ''; 				// The parsed path for use within sky
	protected array|bool $path_access	= [];				// Assume not allowed, require postiive access grant
	protected int|bool $authed__mem_id	= 0;				// The eventually authenticated user
	protected object $api;

	protected string $ctlr 				= '';				// Requested controller parsed from reqested_path
	protected string $method 			= '';				// Controller method parsed from requested_path
	protected array|string $args 		= '';				// Arguments on the url
	protected string $token				= '';				// Token as determined by check_auth()
	protected string $token_expires		= '';				// Separated from token array returned from check_auth

	public function __construct()
	{
		parent::__construct();
		$this->log_chan( 'app' );

		$this->api = new _api();

		$this->log_data([ 'requested_path' => _GET['sky_request'] ]);

		if( _GET['sky_request'] )
		{
			$this->requested_path = _GET['sky_request'];
		}

		$this->start_app();
		$this->serve_path();
	}

	private function serve_path()
	{
		$this->log_msg( 'Serving path' );
		exit;
	}

	private function start_app() : bool
	{
		$this->log_msg( 'starting app' );

		if( !$this->parse_requested_path() )
		{
			$this->fail( 'path could not be parsed' );
			return FALSE;
		}

		if( $this->check_path_access() )
		{
			/*
				check_path_access already checks for public path
				or the existence of a valid token for non-public paths.
				So, check auth may not return anything if the path is public
			*/
			$this->check_auth();
		}

		if( !$this->is_authed() && !$this->has_path_access() && '_auth/password' != $this->requested_path )
		{
			$this->log_msg( '!authed, !path_access & !/_auth/password ' . $this->requested_path );
			header(  $_SERVER["SERVER_PROTOCOL"] . "401 Path denied {$this->requested_path}", TRUE, 401 );
			$www_authenticate_msg = "WWW-Authenticate: {$this->requested_path}. ";
			$www_authenticate_msg .= ( !_POST['_mem_login'] || !_POST['_mem_password'] ) ? "Incomplete credentials" : "Invalid credentials";
			header( $www_authenticate_msg );
			exit;
		}

		$this->log_msg( 'app started' );
		$this->success( 'app started' );
		return TRUE;
	}

	private function parse_requested_path() : bool
	{
		$this->log_msg( 'parsing request path' );

		$uri = array_filter( explode( "/", $this->requested_path ) );

		if( defined( 'SUBDOMAIN_SCOPE' ) && !SUBDOMAIN_SCOPE )
		{
			$subdomain = array_shift( $uri ); // This has already been checked in _co->__construct in the init we just need to remove it
			$this->log_msg( 'SUBDOMAIN_SCOPE TRUE ' . $subdomain );
		}

		$this->ctlr		= array_shift( $uri );
		$this->method	= array_shift( $uri );
		$this->args		= $uri;

		$this->log_data([ 'ctlr' => $this->ctlr, 'method' => $this->method, 'args' => $args]);

		if( is_array( $args ) && 1 == count( $args ) )
		{
			$args = array_shift( $args );
		}

		$this->path = $this->ctlr . "/" . $this->method;

		$this->log_data([ 'path' => $this->path ])->log_msg( 'requested_path parsed' );

		return TRUE;		
	}

	private function check_auth() : string
	{
		$this->log_msg( 'app->check_auth()' );

		$o_auth = new _auth();

		$token = $o_auth->auth();
		$this->log_data([ $token ]);

		if( $token['fk__mem_id'] )
		{
			$this->authed__mem_id = $token['fk__mem_id'];
			$this->token = $token['_auth_token'];
			$this->token_expires = $token['_auth_token_expires'];
		}

		$this->log_msg( 'authed: ' . $this->is_authed() );
		return $this->is_authed();
	}

	private function check_path_access() : bool
	{
		$o_public_path = new _public_path();
		$this->path_access == $o_public_path->is_public_path( $this->path );
		if( !$this->path_access )
		{
			$this->path_access = (new _perm())->verify_path_access( $this->path );
		}

		if( $this->path_access )
		{
			$this->success( 'path access granted' );
			return TRUE;
		}

		$this->fail( 'path access denied' );
		return FALSE;
	}
	
	public function is_authed() : string|bool
	{
		return $this->token;
	}

	public function has_path_access() : array|bool
	{
		return $this->path_access;
	}
}