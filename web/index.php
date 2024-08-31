<?php

/**
 * Move most of this to an _api hoist function
 */

// Set default error level for logging and reporting
const LOG_LEVEL = 'error';

require_once( '../init/init.php' );

// Creates a log for this overall process
$log = new _log();

// Starts app, no need to call anything else.
$app = new _app();

$_tpl->assign( '_co', (new _co())->_co() );
$_tpl->assign( 'me', (new _mem())->me() );

exit;

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

$_api->send();
