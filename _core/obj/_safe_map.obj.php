<?php

use voku\helper\AntiXSS;

class _safe_map extends _da
{
	private mixed $to_sanitize = [];
	private object $antiXSS;

	public function __construct( mixed $to_sanitize = [] )
	{
		parent::__construct();
		$this->log_chan( '_safe_map' )->log_lvl( 'error' );

		$this->to_sanitize = $to_sanitize;
		$this->antiXSS = new AntiXSS();

		$this->sanitize_post();
		$this->sanitize_get();
	}

	public function sanitize_post() : void
	{
		if( $_POST )
		{
			$this->log_msg( 'sanitizing POST' );
			foreach( $_POST as $k => $val )
			{
				$_POST[$k] = filter_input( INPUT_POST, $k, FILTER_SANITIZE_SPECIAL_CHARS );
				$_POST[$k] = $this->antiXSS->xss_clean( $_POST[$k] );
			}
		}
	}

	public function convert_post_ulids()
	{
		if( $_POST )
		{
			$this->log_msg( 'converting $_POST ULIDs' );
			$check_keys = [];
			foreach( $_POST as $key => $val )
			{
				switch( $key )
				{
					case str_starts_with( $key, 'fk_') :
						// These should all be foreign keys in Sky
						$check_keys[$key] = $val;
						break;
					case str_ends_with( $key, '_id' ) :
						// These may or may not be foreign keys, but are going to be gathered to check
						$check_keys[$key] = $val;
						break;
				}
			}

			if( $check_keys )
			{
				// This ensures that even if a column ends in _id but isn't a table id or table ulid, it won't be queried for its corresponding ulid column
				$query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '{$_SERVER['DB_NAME']}' AND COLUMN_NAME IN ( " . str_repeat( '?', count( array_keys( $check_keys ) ) ) . " )";
				$sth = $this->query( $query, array_keys( $check_keys ) );
				$valid_keys = [];
				while( $col = $sth->fetch() )
				{
					$key = $col['COLUMN_NAME'];
					if( $check_keys[$key] )
					{
						$valid_keys[$key]['value'] = $check_keys[$key];
						// To get the table name
						$table = str_replace( '_id', '', $key );
						$table = str_replace( 'fk_', '', $table );
						$valid_keys[$key]['table'] = $table;
					}
				}

				if( $valid_keys )
				{
					foreach( $valid_keys as $col_name => $col )
					{
						$table = $col['table'];
						$val = $col['value'];
						$query = "SELECT `{$table}_id` AS table_id FROM `{$table}` WHERE `{$table}_ulid` = ?";
						$sth = $this->query( $query, [ $val ]);
						$id = $sth->fetch();
						$_POST[$col_name] = $id['table_id'];
					}
				}
			}
		}
	}

	public function sanitize_get() : void
	{
		if( $_GET )
		{
			$this->log_msg( 'sanitizing GET' );
			foreach( $_GET as $k => $val )
			{
				$_GET[$k] = filter_input( INPUT_GET, $k, FILTER_SANITIZE_SPECIAL_CHARS );
				$_GET[$k] = $this->antiXSS->xss_clean( $_GET[$k] );
			}
		}
	}

	public function convert_get_ulids( $table, $get_vals = [] )
	{
		if( $get_vals )
		{
			$this->log_msg( 'converting $_GET ULIDs' );
			if( !is_array( $get_vals ) )
			{
				$get_vals = array( $get_vals );
			}

			// For gets, since they don't have keys, we need to check all get values for ulid values
			$new_get = [];
			foreach( $get_vals as $val )
			{
				$query = "SELECT `{$table}_id` AS table_id FROM `{$table}` WHERE `{$table}_ulid` = ?";
				$sth = $this->query( $query, [ $val ]);
				$id = $sth->fetch()['table_id'];
				$new_get[] = $id ? $id : $val;
			}

			$get_vals = $new_get;
			if( 1 == count( $get_vals ) )
			{
				$get_vals = array_shift( $get_vals );
			}
		}

		return $get_vals;
	}

	public function convert_ids_to_ulids( array|string $data ) : array|string
	{
		if( !$data )
		{
			return [];
		}

		if( is_array( $data ) )
		{
			foreach( $data as $key => $val )
			{
				if( is_array( $val ) )
				{
					$data[$key] = $this->replace_id_with_ulid( $val );
				}
				else
				{
					switch( $key )
					{
						case str_starts_with( $key, 'fk_' ):
							$check_id = str_replace( 'fk_', '', $key );
							if( $array[$check_id] )
							{
								$array[$key] = $array[$check_id];
								unset( $array[$check_id] );
							}
							break;
						case str_ends_with( $key, '_id' ):
							$check_ulid = str_replace( '_id', '_ulid', $key );
							if( $array[$check_ulid] )
							{
								$array[$key] = $array[$check_ulid];
								unset( $array[$check_ulid] );
							}
							break;
					}
				}
			}

			return $data;
		}
		else
		{
			return $data;
		}
	}

	private function replace_id_with_ulid( array $array ) : array
	{
		foreach( $array as $key => $val )
		{
			if( is_array( $val ) )
			{
				$array[$key] = $this->replace_id_with_ulid( $val );
			}
			else
			{
				switch( $key )
				{
					case str_starts_with( $key, 'fk_' ):
						$check_id = str_replace( 'fk_', '', $key );
						if( $array[$check_id] )
						{
							$array[$key] = $array[$check_id];
							unset( $array[$check_id] );
						}
						break;
					case str_ends_with( $key, '_id' ):
						$check_ulid = str_replace( '_id', '_ulid', $key );
						if( $array[$check_ulid] )
						{
							$array[$key] = $array[$check_ulid];
							unset( $array[$check_ulid] );
						}
						break;
				}
			}
		}

		return $array;
	}
}