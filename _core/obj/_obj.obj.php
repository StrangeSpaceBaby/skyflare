<?php

use Ulid\Ulid;

/**
 *	_obj is a general object that can do all core SLED functions: select(), list(), edit(), delete().
 *	Various aliases exist for these core functions such as get_by_id() which is a particular select() function, etc.
 *
 *	Accepts a table name and sets the table for all the class operations.
 *	@param   string	$table	Table name to set the object for
 */

class _obj extends _da
{
	protected string $table = '';
	protected string $table_id = '';
	protected string $table_ulid = '';
	protected array $table_explain = [];
	public string $last_query = '';
	public array $last_bound = [];
	protected int $_co_id = 0;
	protected ?string $_co_ulid = '';
	protected ?object $data_obj = NULL;

	public function __construct( string $table )
	{
		parent::__construct();
		$this->log_chan( $table );

		if( !$table )
		{
			throw new InvalidArgumentException( 'no table passed to _obj' );
		}

		$this->table( $table );

		global $_co;
		if( $_co )
		{
			$this->_co_id = $_co->_co( '_co_id' );
			$this->_co_ulid = $_co->_co( '_co_ulid' );
		}
	}

	/**
	 * Checks whether a passed name of a file belongs to the _core or app space
	 *
	 * @param string $check
	 * @return boolean
	 */
	public function is_core( string $check ) : bool
	{
		if( str_starts_with( $check, '_' ) )
		{
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Not currently in use. Probably will rely on get_by_col for functionality
	 *
	 * @param array $filters
	 * @param array $opts
	 * @return void
	 */
	public function search( array $filters, array $opts ) : void
	{
		p( 'search' );
		p( $filters );
		p( $opts );
	}

	/**
	 * Toggles active on passed id for the $this->table
	 *
	 * @TODO make this make sense Needs to return the new toggle state and unset archied, deleted on toggle active = 1
	 * @param integer $id
	 * @return boolean TRUE on toggle, FALSE on error
	 */
	public function toggle_active( int $id ) : bool
	{
		$params = [ "{$this->table_ulid}" => $id ];
		$q = "UPDATE {$this->table} SET {$this->table}_active = !{$this->table}_active WHERE {$this->table}_del IS NULL AND {$this->table_ulid} = :{$this->table_ulid}";
		if( !ULID_AS_ID )
		{
			$q = "UPDATE {$this->table} SET {$this->table}_active = !{$this->table}_active WHERE {$this->table}_del IS NULL AND {$this->table_id} = :{$this->table_id}";
			$params = [ "{$this->table_id}" => $id ];
		}
		if( $this->has_fk__co_id() )
  		{
  			$q .= " AND fk__co_id = :fk__co_id";
  			$params['fk__co_id'] = $this->_co_id;
  		}

		$sth = $this->query( $q, $params );

  		if( '00000' != $sth->errorCode() )
  		{
  			$this->fail( $sth->errorInfo() );
  			return FALSE;
  		}

  		$this->success( 'deleted' );
  		return TRUE;
	}

	 /**
	  * delete() marks a row for deletion with a NOW() timestamp. A cron will collect all the garbage
	 *	and delete them every day right after the nightly backup.
	  *
	  * @param integer|string $id Either auto_increment or ulid depending on ULID_AS_ID value
	  * @return boolean FALSE if the query fails (but the QueryException should be thrown way before this), TRUE otherwise
	  */
	 public function delete( int|string $id ) : bool
  	{
  		if( is_array( $id ) )
  		{
  			$id = array_shift( $id );
  		}

  		$params = array( $this->table_id => $id );
  		$q = "UPDATE {$this->table} SET {$this->table}_del = NOW(), {$this->table}_active = 0 WHERE {$this->table}_del IS NULL AND {$this->table_ulid} = :{$this->table_ulid}";
		if( is_int( $id ) )
		{
			$q = "UPDATE {$this->table} SET {$this->table}_del = NOW(), {$this->table}_active = 0 WHERE {$this->table}_del IS NULL AND {$this->table_id} = :{$this->table_id}";
		}

  		if( $this->has_fk__co_id() )
  		{
  			$q .= " AND fk__co_id = :fk__co_id";
  			$params['fk__co_id'] = $this->_co_id;
  		}

  		$sth = $this->query( $q, $params );

  		if( '00000' != $sth->errorCode() )
  		{
  			$this->fail( $sth->errorInfo() );
  			return FALSE;
  		}

  		$this->success( 'deleted' );
  		return TRUE;
  	}

	/**
	 * Executes DELETE FROM on passed row id for $this->table
	 *
	 * @param integer $id
	 * @return boolean TRUE on delete, FALSE on error
	 */
	protected function real_delete( int $id ) : bool
 	{
 		if( is_array( $id ) )
 		{
 			$id = array_shift( $id );
 		}

 		$params = array( $this->table_id => $id );
 		$q = "DELETE FROM {$this->table} WHERE {$this->table_id} = :{$this->table_id} ";
 		if( $this->has_fk__co_id() )
 		{
 			$q .= " AND fk__co_id = :fk__co_id";
 			$params['fk__co_id'] = $this->_co_id;
 		}

 		$sth = $this->query( $q, $params );

 		if( '00000' != $sth->errorCode() )
 		{
 			$this->fail( $sth->errorInfo() );
 			return FALSE;
 		}

 		$this->success( 'real_deleted' );
 		return TRUE;
 	}

	/**
	 * Sets active = 1 where a row has a delete timestamp, and set _del = NULL
	 *
	 * @param integer $id
	 * @return boolean TRUE on undelete, FALSE on error
	 */
	public function undelete( int $id ) : bool
	{
		if( is_array( $id ) )
		{
			$id = array_shift( $id );
		}

		$params = array( $this->table_id => $id );
		$q = "UPDATE {$this->table} SET {$this->table}_del = NULL, {$this->table}_active = 1 WHERE {$this->table_id} = :{$this->table_id}";
		if( $this->has_fk__co_id() )
		{
			$q .= " AND fk__co_id = :fk__co_id";
			$params['fk__co_id'] = $this->_co_id;
		}

		$sth = $this->query( $q, $params );

		if( '00000' != $sth->errorCode() )
		{
			$this->fail( $sth->errorInfo() );
			return FALSE;
		}

		$this->success( 'undeleted' );
		return TRUE;
	}

	/**
	 *	list() retrieves all rows from the table, optionally including
	 *	deleted and archived rows through the $vars argument. The return key
	 *	can also be set in the $vars. The query is automatically scoped to the subscriber.
	 *	@param   array	$vars	Options for which rows to include and how to return the results
	 *	@return  array	The result of $this->query()
	 */
	public function list( array $vars = [] ) : array|bool
	{
		$select_cols = [];

		if( $vars['include_del'] )
		{
			$select_cols[$this->table . '_del'] = '!NULL';
		}

		if( $vars['include_arch'] )
		{
			$select_cols[$this->table . '_arch'] = '!NULL';
		}

		if( !$vars['return_key'] )
		{
			$vars['return_key'] = $this->table_id;
		}

		$this->paginate();
		$rows = $this->get_by_col( $select_cols, TRUE, TRUE, $this->data_obj->full_join(), $this->data_obj->select_cols() );

		if( FALSE === $rows )
		{
			$this->fail( 'could_not_list_' . $this->table );
			return FALSE;
		}

		$list = array();
		while( $row = array_shift( $rows ) )
		{
			$list[$row[$vars['return_key']]] = $row;
		}

		$this->success( 'list_fetched' );
		return $list;
	}

	/**
	 *	save() automagically creates a proper query and bind array for saving
	 *	a new or existing record.
	 *	@param   array 	$vars	The keyed array of column names and the new values
	 *	@return  bool	table_id if query is successful, FALSE otherwise
	 */

	public function save( array $vars ) : int|bool
	{
		$this->log_data( $vars, FALSE )->log_msg( 'saving vars' );

		if( !$vars[$this->table_id] )
		{
			unset( $vars[$this->table_id] );
		}

		if( !$vars[$this->table_ulid] )
		{
			unset( $vars[$this->table_ulid] );
		}

		if( $this->data_obj )
		{
			$field = $this->table_ulid;
			if( $this->data_obj->col( $field ) )
			{
				if( !$vars[$this->table_id] )
				{
					$vars[$field] = $this->generate_ulid();
				}
				else
				{
					unset( $vars[$field] );
				}
			}
		}

		// should do some validation checking here as well
		list( $q, $sane_vars ) = $this->auto_query( $vars );
		$this->log_data( $q, FALSE )->log_msg( '_obj q' );
		$this->log_data( $sane_vars, FALSE )->log_msg( '_obj_sane_vars' );

		try
		{
			$this->query( $q, $sane_vars );
		}
		catch( QueryException $qe )
		{
			$this->log_data( $qe )->log_msg( '_obj->save QueryException' );

			$exc = json_decode( $qe->getMessage(), JSON_OBJECT_AS_ARRAY );
			$msg = "Unknown query error";
			if( '23000' == $exc['pdo']['errorInfo'][0] )
			{
				$msg = 'Duplicate Unique ID';
			}
			$this->fail( $msg );
			return FALSE;
		}

		if( !$vars[$this->table_id] )
		{
			$vars[$this->table_id] = $this->last_insert_id();
		}

		$this->success( 'saved' );
		return $vars[$this->table_id];
	}

	/**
	 * Select row(s) by multiple scopes
	 *
	 * @param array $cols_and_vals
	 * @param boolean $enforce_multi_array
	 * @param boolean $exclude_inactive
	 * @param array $add_joins
	 * @param string $export_cols
	 * @param string $order_by
	 * @param int $result_limit
	 * @return array|boolean
	 */
	public function get_by_col
	(
		array $cols_and_vals = array(),
		bool $enforce_multi_array = FALSE,
		bool $exclude_inactive = TRUE,
		array $add_joins = array(),
		string $export_cols = NULL,
		string $order_by = '',
		int $result_limit = NULL
	) : array|bool
 	{
		$params = array();
		if( !$export_cols )
		{
			if( $this->data_obj )
			{
				$export_cols = $this->data_obj->select_cols( 'string' );
			}
		}

		if( !$add_joins && NULL !== $add_joins )
		{
			if( $this->data_obj )
			{
				$add_joins = $this->data_obj->full_join();
			}
		}

		if( $cols_and_vals )
		{
			foreach( $cols_and_vals as $col => $val )
			{
				$table = $this->table;
				if( 'fk__co_id' != $col )
				{
					if( str_contains( $col, '::' ) )
					{
						list( $table, $col ) = explode( '::', $col, 2 );
						$cols_and_vals[$col] = $val;
					}

					$column = preg_replace( "/[^a-z_0-9\/]/", '', $col );
					if( NULL !== $val && '!NULL' !== $val && is_array( $val ) && 0 != $val )
					{
						$placeholders = [];
						foreach( $val as $key => $value )
						{
							$placeholders[':'.$col.'_'.$key] = $value;
						}

						$params["`{$table}`.`{$column}` IN ( " . implode( ',', array_keys( $placeholders ) ) . " )"] = $placeholders;
						unset( $cols_and_vals[$col] );
						$cols_and_vals = array_merge( $cols_and_vals, $placeholders );
					}
					else
					{
						switch( $val )
						{
							case 0:
								$params["`{$table}`.`{$column}` = :{$column}"] = 0;
								break;
							case NULL === $val:
								$params["`{$table}`.`{$column}` IS NULL"] = '';
								unset( $cols_and_vals[$col] );
								break;
							case '!NULL':
								$params["`{$table}`.`{$column}` IS NOT NULL"] = '';
								unset( $cols_and_vals[$col] );
								break;
							case str_starts_with( $val, '%' ):
							case str_ends_with( $val, '%' ):
								$params["`{$table}`.`{$column}` LIKE :{$column}"] = trim( $val );
								break;
							case str_starts_with( $val, '<=' ):
								$params["`{$table}`.`{$column}` <= :{$column}"] = trim( substr( $val, 2 ) );
								break;
							case str_starts_with( $val, '<' ):
								$params["`{$table}`.`{$column}` < :{$column}"] = trim( substr( $val, 1 ) );
								break;
							case str_starts_with( $val, '>=' ):
								$params["`{$table}`.`{$column}` >= :{$column}"] = trim( substr( $val, 2 ) );
								break;
							case str_starts_with( $val, '>' ):
								$params["`{$table}`.`{$column}` > :{$column}"] = trim( substr( $val, 1 ) );
								break;
							case str_starts_with( $val, 'BETWEEN ' ):
								$new_val = str_replace( 'BETWEEN ', '', $val );
								list( $start_date, $end_date ) = explode( ' AND ', $new_val );

								if( !$start_date || !$end_date )
								{
									$this->fail( 'missing_date_for_BETWEEN: ' . $start_date . ' ' . $end_date );
									return FALSE;
								}

								try
								{
									$start_date = new DateTime( trim( $start_date ) );
									$end_date = new DateTime( trim( $end_date ) );
								}
								catch( Exception $e )
								{
									$this->fail( 'invalid_start_or_end_dates_for_BETWEEN' );
									return FALSE;
								}

								$params["`{$table}`.`{$column}` BETWEEN '" . $start_date->format( 'Y-m-d H:i:s' ) . "' AND '" . $end_date->format( 'Y-m-d H:i:s' ) . "'"] = '';
								unset( $cols_and_vals[$col] );
								break;
							case str_starts_with( $val, '!' ):
								$new_val = substr( $val, 1 );
								$params["`{$table}`.`{$column}` != :{$column}"] = $new_val;
								$cols_and_vals[$col] = $new_val;
								break;
							default:
								$params["`{$table}`.`{$column}` = :{$column}"] = $val;
								break;
						}
					}
				}
			}

			foreach( $cols_and_vals as $col => $val )
			{
				if( str_contains( $col, '::' ) )
				{
					unset( $cols_and_vals[$col] );
				}
			}

		}

		$joins = array();
		if( $add_joins )
		{
			foreach( $add_joins as $join_key => $join )
			{
				$id = str_replace( 'fk_', '', $join_key );
				if( $join['join_on'] )
				{
					$id = $join['join_on'];
				}

				if( !$join['type'] )
				{
					$join['type'] = 'LEFT';
				}

				$to_join = $join['type'] . " JOIN `{$join['table']}` ";
				if( !$join['join_to'] )
				{
					$join['join_to'] = $this->table;
				}

				if( $join['join_as'] )
				{
					$join_column = $join['join_column'] ? $join['join_column'] : $id;
					$to_join .= "AS {$join['join_as']} ON `{$join['join_as']}`.`{$join_column}` = `{$join['join_to']}`.`{$join_key}`";
				}
				else
				{
					$to_join .= "ON `{$join['table']}`.`{$id}` = `{$join['join_to']}`.`{$join_key}`";
				}
				$joins[] = $to_join;
			}
		}

		$joins = implode( " ", $joins );

		if( $exclude_inactive )
		{
			$q = "SELECT {$export_cols} FROM {$this->table} {$joins} WHERE {$this->table}.{$this->table}_active = 1 ";
		}
		else
		{
			$q = "SELECT {$export_cols} FROM {$this->table} {$joins} WHERE 1 ";
		}

		if( $this->has_fk__co_id() )
		{
			$params["`{$this->table}`.`fk__co_id` = :fk__co_id"] = $this->_co_id;
			$cols_and_vals['fk__co_id'] = $this->_co_id;
		}

		$q .= " AND " . implode( " AND ", array_keys( $params ) );

		if( $order_by )
		{
			$order = str_replace( ';', '', $order_by );
			$order = str_replace( "'", '', $order );
			$order = str_replace( '"', '', $order );

			$q .= " ORDER BY " . $order;
		}

		if( $result_limit )
		{
			$limits = explode( ",", $result_limit );
			foreach( $limits as $limit )
			{
				if( !is_numeric( $limit ) )
				{
					$this->fail( 'Invalid limit clause' );
					return FALSE;
				}
			}

			$q .= " LIMIT " . implode( ",", $limits );
		}

 		try
 		{
			$this->last_query = $q;
			$this->last_bound = $cols_and_vals;
 			$sth = $this->query( $q, $cols_and_vals );
			$result = array();
			while( $row = $sth->fetch() )
			{
				$result[$row[$this->table_id]] = $row;
			}

			$this->success( 'get_by_col_success' );

			if( $enforce_multi_array )
			{
				return $result;
			}

 			return 1 == count( $result ) ? array_shift( $result ) : $result;
 		}
 		catch( QueryException $qe )
 		{
			$this->fail( 'query_failure' );
 			return FALSE;
 		}
 	}

	/**
	 *	get_by_id() gets one row of data using the provided auto increment
	 *	id for a row in the associated table.  This is a wrapper to get_by_col()
	 *	by supplying the table_id and the $id.
	 *
	 * @param integer|string $id auto_increment or ulid of associated table
	 * @return array|boolean array from get_by_col or FALSE on error
	 */
	public function get_by_id( int|string $id ) : array|bool
	{
		if( is_int( $id ) )
		{
			$cols = [
				$this->table_id => $id
			];
		}
		else
		{
			$cols = [
				$this->table_ulid => $id
			];
		}

		$this->log_data( $cols )->log_msg( 'get_by_id' );
		return $this->get_by_col( $cols, FALSE, FALSE, $this->data_obj->full_join(), $this->data_obj->select_cols() );
	}

	/**
	 *	table sets $this->table and $this->table_id as well as the data object
	 *	@param	string	$table the complete table name
	 *	@return	object|bool	$this or FALSE on error
	 */
	protected function table( string $table ) : object|bool
	{
		$this->log_data( $table )->log_msg( '_obj table to set ' . $table );

		if( !$table )
		{
			$this->log_msg( 'returning false from _obj->table()' );
			return FALSE;
		}

		$this->table = $table;
		$this->table_id = $table . '_id';
		$this->table_ulid = $table . '_ulid';
		$this->table_explain = array();

		$data_obj_name = $table . "_data";
		if( defined( "OBJ_DATA_APP" ) && defined( "OBJ_DATA_CORE" ) )
		{
			$data_obj_file = OBJ_DATA_APP;
			if( $this->is_core( $table ) )
			{
				$data_obj_file = OBJ_DATA_CORE;
			}
			$data_obj_file .= "{$data_obj_name}.obj.php";

			if( file_exists( $data_obj_file ) )
			{
				require_once( $data_obj_file );
				$this->data_obj = new $data_obj_name();
			}
		}

		return TRUE;
	}

	/**
	 * @deprecated
	 * @return string
	 */
	public function generate_uuid() : string
	{
		return $this->generate_ulid();
	}

	/**
	 * Returns a lowercased valid ulid()
	 *
	 * @return string
	 */
	public function generate_ulid() : string
	{
		return Ulid::generate( TRUE );
	}

	/**
	 *	Simple function to hash a password uniformly
 	 *	@param   string	$password
	 *	@return  string	bcrypt hashed value of $password
	 */

	public function encrypt_password( string $password ) : string
	{
		return password_hash( $password, PASSWORD_BCRYPT );
	}

	/**
	 * Returns a SHA-512 hash.
	 *
	 * @param string $to_hash
	 * @return string
	 */
	public function hash( string $to_hash ) : string
	{
		return hash( 'sha512', $to_hash );
	}

	/**
	 *	Used for generating short uniques for non-cryptographically necessary codes
	 *
	 *	@copyright 2008 Kevin van Zonneveld (https://kevin.vanzonneveld.net)
	 *	@license   https://www.opensource.org/licenses/bsd-license.php New BSD Licence
	 *	@link	https://kevin.vanzonneveld.net/
	 *	@param mixed   $in   String or long input to translate
	 *	@param boolean $to_num  Reverses translation when true
	 *	@param mixed   $pad_up  Number or boolean padds the result up to a specified length
	 *	@param string  $pass_key Supplying a password makes it harder to calculate the original ID
	 *	@return mixed string or long
	 */
	function alphaID( string $in, bool $to_num = false, bool $pad_up = false, string $pass_key = null) : string
	{
		$out   =   '';
		$index = 'bcdfghjklmnpqrstuvwxyz1234567890BCDFGHJKLMNPQRSTUVWXYZ';
		$base  = strlen($index);

		if( $pass_key !== null )
		{
			// Although this function's purpose is to just make the
			// ID short - and not so much secure,
			// with this patch by Simon Franz (https://blog.snaky.org/)
			// you can optionally supply a password to make it harder
			// to calculate the corresponding numeric ID

			for( $n = 0; $n < strlen($index); $n++ )
			{
				$i[] = substr($index, $n, 1);
			}

			$pass_hash = hash('sha256',$pass_key);
			$pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

			for( $n = 0; $n < strlen($index); $n++ )
			{
				$p[] = substr($pass_hash, $n, 1);
			}

			array_multisort($p, SORT_DESC, $i);
			$index = implode($i);
		}

		if ($to_num) {
			// Digital number	<<--  alphabet letter code
			$len = strlen($in) - 1;

			for ($t = $len; $t >= 0; $t--) {
				$bcp = bcpow($base, $len - $t);
				$out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
			}

			if (is_numeric($pad_up)) {
				$pad_up--;

				if ($pad_up > 0) {
					$out -= pow($base, $pad_up);
				}
			}
		} else {
			// Digital number  -->>  alphabet letter code
			if (is_numeric($pad_up)) {
				$pad_up--;

				if ($pad_up > 0) {
					$in += pow($base, $pad_up);
				}
			}

			for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
				$bcp = bcpow($base, $t);
				$a   = floor($in / $bcp) % $base;
				$out = $out . substr($index, $a, 1);
				$in  = $in - ($a * $bcp);
			}
		}

		return $out;
	}

	/**
	 *	__debugInfo removes sensitive information such as passwords and database
	 *	connection info so that object printing doesn't give away the store.
	 *	@return	array sanitized get_object_vars( $this )
	 */
	public function __debugInfo() : array
	{
		$vars = get_object_vars( $this );
		unset( $vars['dsn'] );
		unset( $vars['dbuser'] );
		unset( $vars['dbpass'] );
		unset( $vars['dbhost'] );
		unset( $vars['dbname'] );
		unset( $vars['db'] );
		unset( $vars['table'] );
		unset( $vars['table_id'] );

		return $vars;
	}
}
