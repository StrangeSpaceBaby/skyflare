<?php

$autopopulate_ulids = 0;
if( $_SERVER['IS_DEV'] )
{
	$autopopulate_ulids = 1;
}

define( 'AUTOPOPULATE_ULIDS', $autopopulate_ulids );