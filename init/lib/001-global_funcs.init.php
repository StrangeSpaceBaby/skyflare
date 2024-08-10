<?php

function p( $print, $force_print = FALSE )
{
	if( !$_SERVER['IS_DEV'] )
	{
		return FALSE;
	}

	if( _cli() )
	{
		print_r( $print );
		print "\n";
	}
	else
	{
		print "<pre>";
		print_r( $print );
		print "</pre>\n";
	}
}

function _cli()
{
	if( !$_SERVER['REMOTE_ADDR'] && !$_SERVER['HTTP_USER_AGENT'] && count( $_SERVER['argv'] ) )
	{
		return TRUE;
	}

	return FALSE;
}
