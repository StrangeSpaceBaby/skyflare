<?php

class _hq extends _obj
{
	public function __construct()
	{
		parent::__construct( '' );
	}

	/**
	 * Saves json file to path parameter
	 *
	 * @param string $path path to new file
	 * @param array $content array of content to jsonify
	 * @return void
	 */
	protected function to_json_file( string $path, array $content ) : void
	{
		file_put_contents( $path, json_encode( $content, JSON_PRETTY_PRINT ) ) or die( p( error_get_last() ) );
	}

	/**
	 * Versions database for ready commit
	 *
	 * @return boolean Always TRUE
	 */
	public function version_db() : bool
	{
		$versions_dir = CONF . "/db/versions";

		$entries = scandir( $versions_dir );
		$version = 1;
		foreach( $entries as $entry )
		{
			if( str_starts_with( $entry, '.' ) || !is_dir( $entry ) )
			{
				continue;
			}
			
			if( $version < (int) $entry )
			{
				$version = $entry < 10 ? "0" . $entry : $entry;
			}
		}

		$v_dir = $versions_dir . "/" . $version . "/";
		$v_schema = $v_dir . "schema/";

		mkdir( $v_dir ) or die( print_r( error_get_last(), TRUE ) );
		mkdir( $v_schema );
		mkdir( $v_dir . "migration/" );

		$sth = $this->query( "SELECT * FROM information_schema.SCHEMATA WHERE SCHEMA_NAME = ?", [ $this->dbname ]);
		$schemata = $sth->fetch();
		$this->to_json_file( $v_schema . "/database.json", $schemata );

		$sth = $this->query( "SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = ?", [ $this->dbname ]);
		while( $table = $sth->fetch() )
		{
			p( $table['TABLE_NAME'] );
			mkdir( $v_schema . $table['TABLE_NAME'] );
			$this->to_json_file( $v_schema . $table['TABLE_NAME'] . "/meta.json", $table );

			$col_sth = $this->query( "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?", [ $this->dbname, $table['TABLE_NAME'] ] );
			while( $col = $col_sth->fetch() )
			{
				$this->to_json_file( $v_schema . $table['TABLE_NAME'] . "/" . $col['COLUMN_NAME'] . ".json", $col );
			}
		}

		$this->success( 'versioned' );
		return TRUE;
	}
}
