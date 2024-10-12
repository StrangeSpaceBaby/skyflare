<?php

/**
 * The defines are the constants which must be defined. Mostly,
 * they are directories and file locations. Since they are constants,
 * the order of creation is not important except where one constant
 * may need another constant to be defined prior to creation.
 */

$defines =
[
	'BASE' => $path . "/",
	'CORE' => [ "BASE", "_core" ],
	'CONF' => [ "BASE", "conf" ],
	'INIT' => [ "BASE", "init" ],
	'WEB' => [ "BASE", "web" ],
	'CRON' => [ "BASE", "cron" ],
	'KEYS' => [ "CONF", "keys" ],
	'LOG' => [ "BASE", "log" ],
	'VENDOR' => [ "BASE", "vendor" ],

	'ADMIN' => [ "CORE", "_admin" ],
	'CTLR_CORE' => [ "CORE", "ctlr" ],
	'OBJ_CORE' => [ "CORE", "obj" ],
	'OBJ_DATA_CORE' => [ "CORE", "obj/data" ],
	'PAGE_CORE' => [ "CORE", "page" ],
	'TPL_CORE' => [ "CORE", "tpl" ],

	'APP' => [ "BASE", "app" ],
	'CTLR_APP' => [ "APP", "ctlr" ],
	'OBJ_APP' => [ "APP", "obj" ],
	'OBJ_DATA_APP' => [ "APP", "obj/data" ],
	'PAGE_APP' => [ "APP", "page" ],
	'TPL_APP' => [ "APP", "tpl" ],
];

if( $config['defines'] )
{
	foreach( $config['defines'] as $define => $value )
	{
		$defines[$define] = $value;
	}
}

foreach( $defines as $define => $value )
{
	if( is_array( $value ) )
	{
		// if the value is an array, then it uses a previously defined
		// constant and must be constructed.
		$defined = array_shift( $value );
		$path = array_shift( $value );
		$interpolated = $defines[$defined];
		if( is_array( $interpolated ) )
		{
			$defined_path = $defines[array_shift($interpolated)] . array_shift( $interpolated );
		}
		else
		{
			$defined_path = $defines[$defined];
		}
		define( $define, $defined_path . "/" . $path . "/" );
	}
	else
	{
		// Otherwise if not an array, just override the whole constant's
		// value with the supplied value.
		define( $define, $value . "/" );
	}
}

// Not yet implemented. This will allow for using UUIDs for SLED operations
// to hide auto_increment IDs.
define( 'ULID_AS_ID', TRUE );
