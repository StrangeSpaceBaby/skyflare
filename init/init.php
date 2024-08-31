<?php

error_reporting( E_ALL & ~E_WARNING & ~E_DEPRECATED & ~E_NOTICE );
ini_set( 'display_errors', 1 );

function err( $error_num, $error_string, $error_file, $error_line )
{
	$msg = json_encode([ 'error_num' => $error_num, 'error_string' => $error_string, 'error_file' => $error_file, 'error_line' => $error_line ]);

	if( 8 == $error_num || 2 == $error_num )
	{
		return FALSE;
	}

	// Log to error log until the master logger object is available
	global $_fail;
	if( $_fail )
	{
		$_fail->log([ 'type' => 'error', 'chan' => 'error', 'msg' => 'uncaught_error', 'context' => [ 'error_num' => $error_num, 'error_string' => $error_string, 'error_file' => $error_file, 'error_line' => $error_line ] ]);
	}
	else
	{
		error_log( $msg );
	}
}

set_error_handler( 'err' );

$path = dirname( __FILE__ );

$config = json_decode( file_get_contents( $path . '/init.json' ), TRUE );

$parts = explode( DIRECTORY_SEPARATOR, $path );
array_pop( $parts );
$path = implode( DIRECTORY_SEPARATOR, $parts );

require_once( $path . '/init/defines.php' );
require_once( OBJ_CORE . 'exception/exceptions.php' );

define( 'SUBDOMAIN_SCOPE', $config['subdomain_scope'] );

require_once( VENDOR . 'autoload.php' );

spl_autoload_register(
	function ( $class_name )
	{
		switch( $class_name )
		{
			case '_ctlr':
				$filename = CTLR_CORE . '_ctlr.ctlr.php';
				break;
			case '_ctlr' != $class_name && str_ends_with( $class_name, '_ctlr' ):
				$filename = str_starts_with( $class_name, '_' ) ? CTLR_CORE : CTLR_APP;
				$filename .= str_replace( '_ctlr', '', $class_name ) . '.ctlr.php';
				break;
			case '_obj_data' != $class_name && str_ends_with( $class_name, '_data' ):
				$filename = str_starts_with( $class_name, '_' ) ? OBJ_DATA_CORE : OBJ_DATA_APP;
				$filename .= str_replace( '_data', '', $class_name ) . '.data.php';
				break;
			default:
				$filename = str_starts_with( $class_name, '_' ) ? OBJ_CORE : OBJ_APP;
				$filename .= $class_name . ".obj.php";
				break;
		}

		require_once( $filename );
	}
);

$_fail = new _fail();

if( $handle = opendir( INIT . 'lib' ) )
{
	while( FALSE !== ( $entry = readdir( $handle ) ) )
	{
		if( "." != substr( $entry, 0, 1 ) )
		{
			require_once( INIT . 'lib/' . $entry );
		}
	}

	closedir( $handle );
}
