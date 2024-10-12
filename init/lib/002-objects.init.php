<?php

// Reject bad tenant scopes
$_co = new _co();
if( !$_co->_co( '_co_id' ) )
{
	// The company was not found
	header( 'HTTP/1.1 422 Unprocessable Entity - Not a company', TRUE, 422 );
	exit;
}