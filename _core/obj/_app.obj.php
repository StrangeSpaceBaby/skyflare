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
		$this->log_chan( '_app' );

		$this->api = new _api();

		$this->log_data([ 'requested_path' => $_GET['sky_request'] ]);

		if( $_GET['sky_request'] )
		{
			$this->requested_path = $_GET['sky_request'];
		}

		$this->start_app();
		$this->serve_path();
	}

	private function serve_path()
	{
		$this->log_msg( 'Serving path' );

		// No need to check if controller exists because if it doesn't exist, we won't get here
		$ctlr_name = $this->ctlr . '_ctlr';
		$this->log_msg( "serving {$ctlr_name}->{$this->method}" );

		$reflectedClass = new ReflectionClass( $ctlr_name );
		if( !$reflectedClass->hasMethod( $this->method ) )
		{
			throw new InvalidArgumentException( 'Class does not have method' );
		}

		$ctlr = new $ctlr_name();
		$this->log_data([ $ctlr ], FALSE )->log_msg( 'instantiated ctlr' );

		$reflectedMethod = new ReflectionMethod( $ctlr_name, $this->method );

		// Need to check params for ULIDs to convert to IDs
		// Automatically sanitizes _POST and _GET, replace ULIDs with IDs where possible
		$o_safe_map = new _safe_map();

		if( $_POST )
		{
			$o_safe_map->convert_post_ulids();
		}

		$this->log_data( $this->args )->log_msg( 'app obj args' );
		if( $this->args && !in_array( $this->ctlr, ['_page', '_tpl'] )  )
		{
			$this->args = $o_safe_map->convert_get_ulids( $ctlr->get_table_name(), $this->args );
		}

		$methodParams = $reflectedMethod->getParameters();
		if( $methodParams )
		{
			foreach( $methodParams as $arg )
			{
			}
		}

		$result = $reflectedMethod->invoke( $ctlr, $this->args );

		if( $ctlr->failed() )
		{
			$this->api->fail( $ctlr->get_error_msg() );
		}
		else
		{
			$this->api->success( $ctlr->get_error_msg() );
		}

		$this->api->data( $o_safe_map->convert_ids_to_ulids( $result ) )->send();
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

		if( !$this->is_authed() && !$this->has_path_access() )
		{
			$this->log_msg( '!authed, !path_access & !/_auth/password ' . $this->requested_path );
			header(  $_SERVER["SERVER_PROTOCOL"] . "401 Path denied {$this->requested_path}", TRUE, 401 );
			$www_authenticate_msg = "WWW-Authenticate: {$this->requested_path}. ";
			$www_authenticate_msg .= ( !$_POST['_mem_login'] || !$_POST['_mem_password'] ) ? "Incomplete credentials" : "Invalid credentials";
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

		$this->log_data( $uri )->log_msg( 'uri' );
		$this->ctlr		= array_shift( $uri );
		$this->method	= array_shift( $uri );
		
		if( 1 == count( $uri ) )
		{
			$this->args = array_shift( $uri );
		}
		else
		{
			$this->args = $uri;
		}

		$this->log_data([ 'ctlr' => $this->ctlr, 'method' => $this->method, 'args' => $args ]);

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
		$o_auth = new _auth();

		$token = $o_auth->auth();
		$this->log_data([ $token ]);

		if( $token['fk__mem_id'] )
		{
			$this->authed__mem_id = $token['fk__mem_id'];
			$this->token = $token['_auth_token'];
			$this->token_expires = $token['_auth_token_expires'];
		}

		return $this->is_authed();
	}

	private function check_path_access() : bool
	{
		$o_public_path = new _public_path();
		$this->path_access = $o_public_path->is_public_path( $this->requested_path );
		$this->path_access ?? $this->log_msg( 'public path access' );
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