<?php

$reset_token = $args;
if( is_array( $args ) )
{
	$reset_token = array_shift( $args );
}

switch( $reset_token )
{
	case '':

		break;
}

if( !$reset_token )
{
	$_tpl->assign( 'msg', 'Incomplete or broken link.' );
}

$_mem_reset = new _mem_reset();
$reset = $_mem_reset->valid_reset_token( $reset_token );
p( $reset );
exit;
