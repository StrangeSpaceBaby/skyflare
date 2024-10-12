<?php

class _hq_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_hq' );
	}

	/**
	 * Calls obj's version_db which has its own output.
	 *
	 * @return void
	 */
	public function version_db() : void
	{
		$this->obj->version_db();
	}

	/**
	 * Using the config.json file, determines what tables and data need to be versioned.
	 *
	 * @internal This should not be used by anything other than application maintainers prior to commiting changes
	 * @return void
	 */
	public function ready_commit() :void
	{
		if( $_SERVER['IS_PROD'] )
		{
			p( 'production servers cannot ready_commit' );
			exit;
		}

		$dir = CONF . "\db";
		p( $dir );
		chdir( $dir );
		$config = json_decode( file_get_contents( $dir . '/config.json' ), TRUE );

		if( !$config['compare_db'] )
		{
			p( 'compare_db not supplied in config' );
			exit;
		}

		$new_version = $config['version'] + 1;
		if( 10 > $new_version )
		{
			$new_version = '0' . $new_version;
		}

		if( $config['skip_tables'] )
		{
			if( $config['skip_data'] )
			{
				$config['skip_data'] = array_unique( array_filter( array_merge( $config['skip_data'], $config['skip_tables'] ) ) );
			}
			else
			{
				$config['skip_data'] = $config['skip_tables'];
			}

			if( $config['skip_schema'] )
			{
				$config['skip_schema'] = array_unique( array_filter( array_merge( $config['skip_schema'], $config['skip_tables'] ) ) );
			}
			else
			{
				$config['skip_schema'] = $config['skip_tables'];
			}
		}

		$connex = "C:\\xampp\\mysql\\bin\\mysqldump -u {$_SERVER['DB_USER']} --password={$_SERVER['DB_PASS']} --compact {$_SERVER['DB_NAME']} ";

		$schema_only = $connex . " --no-data ";
		if( $config['skip_schema'] )
		{
			$schema_only .= " --ignore-table={$_SERVER['DB_NAME']}." . implode( " --ignore-table={$_SERVER['DB_NAME']}.", $config['skip_schema'] );
		}

		if( !file_exists( "{$dir}/{$new_version}" ) )
		{
			mkdir( "{$dir}/{$new_version}" );
		}

		chdir( $dir . "/{$new_version}" );
		p( "creating dumps for version {$new_version}" );

		p( 'Dumping schema first' );
		p( $schema_only . " > {$dir}/$new_version/{$new_version}-schema.sql" );
		p( system( $schema_only . " > {$dir}/$new_version/{$new_version}-schema.sql" ) );

		$data_only = $connex . " --no-create-info ";
		if( $config['skip_data'] )
		{
			$data_only .= " --ignore-table={$_SERVER['DB_NAME']}." . implode( " --ignore-table={$_SERVER['DB_NAME']}.", $config['skip_data'] );
		}

		p( 'Dumping data next' );
		p( $data_only . " > {$dir}/$new_version/{$new_version}-data.sql" );
		p( system( $data_only . " > {$dir}/$new_version/{$new_version}-data.sql" ) );


		exit;
	}
}
