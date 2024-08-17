<?php

$_api = new _api();

$_co = new _co();
if( !$_co->_co( '_co_id' ) )
{
	// The company was not found
	header( 'HTTP/1.1 422 Unprocessable Entity - Not a company', TRUE, 422 );
	exit;
}

$_perm = new _perm();
$_role = new _role();
$_mem = new _mem();
$_setting = new _setting();
$_tpl = new _tpl();
