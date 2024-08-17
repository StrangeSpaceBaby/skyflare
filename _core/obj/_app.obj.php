<?php

class _app extends _fail
{

	protected string $requested_path = '/page/index';
	protected string $path;
	protected array|bool $path_access = FALSE;
	protected int|bool $authed__mem_id;

	public string $ctlr;
	public string $method;
	public array|string $args;
	public string $token;
	public string $token_expires;

	public function __construct()
	{
		if( _GET['request'] )
		{
			$this->request = _GET['request'];
		}

		$this->start_app();
	}

	private function start_app()
	{
		$this->parse_requested_path();
		$this->check_auth();
		$this->check_path_access();

		if( !$this->is_authed() && !$this->has_path_access() )
		{

		}
	}

	private function parse_requested_path()
	{
		$uri = array_filter( explode( "/", $this->requested_path ) );

		if( defined( 'SUBDOMAIN_SCOPE' ) && !SUBDOMAIN_SCOPE )
		{
			$subdomain = array_shift( $uri ); // This has already been checked in _co->__construct in the init we just need to remove it
		}

		$this->ctlr		= array_shift( $uri );
		$this->method	= array_shift( $uri );
		$this->args		= $uri;

		if( is_array( $args ) && 1 == count( $args ) )
		{
			$args = array_shift( $args );
		}

		$this->path = $this->ctlr . "/" . $this->method;

		return TRUE;		
	}

	private function check_auth()
	{
		$o_auth = new _auth();

		$token = $o_auth->auth();
		if( $token['fk__mem_id'] )
		{
			$this->authed__mem_id = $token['fk__mem_id'];
			$this->token = $token['_auth_token'];
			$this->token_expires = $token['_auth_token_expires'];
		}

		return $this->is_authed();
	}

	private function check_path_access()
	{
		$o_public_path = new _public_path();
		if( !$this->path_access == $o_public_path->is_public_path( $this->path ) )
		{
			$this->path_access = (new _perm())->verify_path_access( $this->path, (new _mem())->me()['roles'] );
		}
	}
	
	public function is_authed() : string|bool
	{
		return $this->token;
	}

	public function has_path_access()
	{
		return $this->path_access;
	}
}