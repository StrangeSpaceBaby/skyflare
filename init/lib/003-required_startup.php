<?php

use voku\helper\AntiXSS;

$antiXSS = new AntiXSS();

$_post = [];
$_get = [];

if( $_POST )
{
	$_post = $_POST;
	foreach( $_post as $k => $val )
	{
		$_post[$k] = filter_input( INPUT_POST, $k, FILTER_SANITIZE_SPECIAL_CHARS );
		$_post[$k] = $antiXSS->xss_clean( $_POST[$k] );
	}
}
define( '_POST', $_post );

if( $_GET )
{
	$_get = $_GET;
	foreach( $_get as $k => $val )
	{
		$_get[$k] = filter_input( INPUT_GET, $k, FILTER_SANITIZE_SPECIAL_CHARS );
		$_get[$k] = $antiXSS->xss_clean( $_GET[$k] );
	}
}
define( '_GET', $_get );

unset( $antiXSS );
