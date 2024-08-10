<?php

/**
 * Move most of this to an _api hoist function
 */

// Set default error level for logging and reporting
const LOG_LEVEL = 'error';

require_once( '../init/init.php' );

$log = new _log();

if( !$_REQUEST['request'] )
{
	$_REQUEST['request'] = '/page/dashboard';
}

$uri = array_filter( explode( "/", $_REQUEST['request'] ) );

if( !SUBDOMAIN_SCOPE )
{
	$subdomain = array_shift( $uri ); // This has already been checked in _co->__construct we just need to remove it
}

$ctlr = array_shift( $uri );
$func = array_shift( $uri );
$args = $uri;

if( is_array( $args ) && 1 == count( $args ) )
{
	$args = array_shift( $args );
}

$path = $ctlr . "/" . $func;

// Token can be TRUE if the path is public
$token = $_auth->auth([ 'ctlr' => $ctlr, 'func' => $func, 'path' => $path ]);

$me = [];
if( $token['fk__mem_id'] )
{
	$me = $_mem->init_me();
}

$co = $_co->_co();

$_tpl->assign( '_co', $co );
$_tpl->assign( 'me', $me );

$_perm = new _perm();
$o_public_path = new _public_path();
$public_path = $o_public_path->is_public_path( $path );

$path_allowed = FALSE;
if( !$public_path )
{
	$path_allowed = $_perm->verify_path_access( $path, $me['roles'] );
}

if( !$token && !$path_allowed && !$public_path && '/page/auth-login' != $path )
{
    // Redirect to log them in
    header( "Location: /page/auth-login" );
    exit;
}

if( $token && !$path_allowed && !$public_path )
{
	header( 'HTTP/1.1 401 Invalid path: ' . $_REQUEST['request'], TRUE, 401 );
	if( 'page' == $ctlr )
	{
		$_tpl->assign( 'message', 'Invalid Path: ' . $_REQUEST['request'] );
		print $_tpl->parse( TPL_CORE . 'error/_401.html' );
		exit;
	}
	exit;
}

$settings = $_setting->list([ 'return_key' => '_setting_id' ]);
$set_list = [];
if( $settings )
{
	$set_list = array_column( $settings, '_setting_value', '_setting_key' );
}

if( 'page' == $ctlr )
{
	$page_script = '';
	$page_tpl = '';
	if( str_starts_with( $func, '_' ) )
	{
		$page_script = PAGE_CORE . $func . '.php';
		$page_tpl = TPL_CORE . '/page/' . $func . '.html';
	}
	else
	{
		$page_script = PAGE_APP . $func . '.php';
		$page_tpl = TPL_APP . '/page/' . $func . '.html';
	}

	try
	{
		if( !file_exists( $page_script ) )
		{
			throw new Exception( 'page_does_not_exist: ' . $page_script );
		}
		else
		{
			require_once( $page_script );
			print $_tpl->parse( $page_tpl );
		}
	}
	catch( Exception $e )
	{
		$_tpl->assign( 'message', $e->getMessage() );
		print $_tpl->parse( TPL_CORE . 'error/_404.html' );
	}

	exit;
}

require_once( CTLR_CORE . '_ctlr.ctlr.php' );

$ctlr_exists = 0;
if( str_starts_with( $ctlr, '_' ) )
{
	if( $ctlr_exists = file_exists( CTLR_CORE . $ctlr . '.ctlr.php' ) )
	{
		require_once( CTLR_CORE . $ctlr . '.ctlr.php' );
	}
	else
	{
		header( $ctlr . ' Resource Not Found ', TRUE, 404 );
		exit;
	}
}
else
{
	if( $ctlr_exists = file_exists( CTLR_APP . $ctlr . '.ctlr.php' ) )
	{
		require_once( CTLR_APP . $ctlr . '.ctlr.php' );
	}
	else
	{
		header( $ctlr . ' Resource Not Found ', TRUE, 404 );
		exit;
	}
}

if( $ctlr_exists )
{
	$ctlr_name = $ctlr . '_ctlr';
	$ctlr = new $ctlr_name();
	if( $ctlr )
	{
		$result = $ctlr->$func( $args );

		if( $ctlr->failed() )
		{
            $_api->fail( $ctlr->get_error_msg() );
		}
		else
		{
            $_api->success( $ctlr->get_error_msg() );
		}

		$_api->data( $result );
	}
}
else
{
	$_co->log([ 'chan' => 'ctlr', 'type' => 'error', 'msg' => 'ctlr_missing', 'context' => $ctlr ]);
	exit;
}

$_api->send();
