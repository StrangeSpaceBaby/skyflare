<?php

/**
 *	da is a PHP PDO wrapper to handle some special cases.  However, the da is
 *	inherited by all objects so the full PDO is available under $class->db.
 *	Most of these functions should be protected functions to avoid inadvertant contamination
 *	by erroneous object calls.
 */

class _da extends _fail
{
	private bool $allow_co_override = FALSE;
	private bool $paginate = FALSE;
	private string $dsn;
	protected string $dbuser;
	protected string $dbpass;
	protected string $dbname;
	private int $default_result_count;
	private int $page;
	private int $count;
	protected object $db;

	/**
	 *	__construct automatically tries to connect to the database using the special $_SERVER vars ($_SERVER[DB*]).
	 *	For greatest safety, these values should be set in the apache conf and then the web directory should be
	 *	AllowOverride None so that .htaccess files can't change this information.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->connect();
	}

	/**
	 *	has_fk__co_id() returns true if the table explanation includes a column fk__co_id. This allows for queries to
	 *	be automatically scoped to the subscriber id and overwritten in the case of nefariousness.
	 *	@return  boolean	TRUE if $this->explain_table()['fk__co_id'], FALSE otherwise.
	 */

	public function has_fk__co_id() : bool
	{
		$cols = $this->explain_table();

		return $cols['fk__co_id'] ? TRUE : FALSE;
	}

	/**
	 * Allows for the ability to override the _co inclusion.  Used for _co_registration
	 *
	 * @param boolean $override if TRUE, set the member variable allow_co_override
	 * @return object $this
	 */
	protected function allow_co_override( bool $override = TRUE ) : object
	{
		$this->allow_co_override = $override;

		return $this;
	}

	/**
	 *	auto_query() is a workhorse. By giving an array of associative data
	 *	where the keys are the column names of the table, auto_query()
	 *	intelligently loops through the values and constructs the correct
	 *	placeholders and bind array for update or insertion.
	 *	@param   array	$vars	The associative array whose keys are the column names of the table
	 *	@return  bool|array	FALSE if no table, An array of the query and the sanitized vars (excludes non-table column keys)
	 */
	public function auto_query( array $vars ) : bool|array
	{
		$this->log_data( $vars )->log_msg( '_obj auto_query vars ' . $this->table );

		if( !$this->table )
		{
			$this->fail( 'this_table_not_found' );
			return FALSE;
		}

		$cols = $this->explain_table();

		if( $cols['fk__co_id'] )
		{
			if( !$this->allow_co_override )
			{
				$vars['fk__co_id'] = $this->_co_id;
			}
		}

		$this->log_data( $vars )->log_msg( '_obj auto_query vars ' . __LINE__ );

		$params = array();
		$now = new DateTime();
		if( !$vars[$this->table_id] )
		{
			$q = "INSERT INTO {$this->table} SET ";
			$vars[$this->table . '_new'] = $now->format( 'Y-m-d H:i:s.u' );
			$vars[$this->table . '_edit'] = $now->format( 'Y-m-d H:i:s.u' );
		}
		else
		{
			$q = "UPDATE {$this->table} SET ";
			unset( $vars[$this->table . '_new'] );
			$vars[$this->table . '_edit'] = $now->format( 'Y-m-d H:i:s.u' );
		}

		$this->log_data( $q )->log_msg( '_obj auto_query q pre vars' );

		foreach( $vars as $key => $val )
		{
			if( $key == $this->table_id )
			{
				// We don't need to process the table_id value as a parameter for update
				// And shouldn't be present for a save on an auto increment column
				// Don't unset, otherwise it will be lost for scoping below.
				continue;
			}

			if( $cols[$key] )
			{
				switch( $val )
				{
					case '(--)' == $vars[$key]:
						$params[] = "{$key} = {$key} - 1";
						unset( $vars[$key] );
						break;
					case '(++)' == $vars[$key]:
						$params[] = "{$key} = {$key} + 1";
						unset( $vars[$key] );
						break;
					case '(NOW)':
					case '(CURRENT_TIMESTAMP)':
						$params[] = "{$key} = CURRENT_TIMESTAMP()";
						unset( $vars[$key] );
						break;
					default:
						$params[] = "{$key} = :{$key}";
						break;
				}
			}
			else
			{
				unset( $vars[$key] );
			}
		}

		$this->log_data( $params )->log_msg( '_obj auto_query params' );
		$this->log_data( $q )->log_msg( '_obj auto_query q' );

		$q .= implode( ',', $params );

		if( $vars[$this->table_id] )
		{
			$q .= " WHERE 1";
			// Update so we have to scope
			if( $cols['fk__co_id'] )
			{
				$q .= " AND fk__co_id = {$this->_co_id}";
			}

			$q .= " AND {$this->table_id} = :{$this->table_id}";
		}

		$this->allow_co_override( FALSE );
		return array( $q, $vars );
	}


	/**
	 * explain_table() does what it says on the tin. It caches the table
	 * explanation in a member var which saves on roundtrips to the database
	 * for every auto_query or expanation event.
	 *
	 * @param string $table table name
	 * @param boolean $force_explain refreshes the table explain
	 * @return array an array of table columns
	 */
	protected function explain_table( string $table = '', bool $force_explain = FALSE ) : array
	{
		if( !$table && $this->table )
		{
			$table = $this->table;
		}

		if( !$table )
		{
			return [];
		}

		if( !$this->table_explain[$table] || $force_explain )
		{
			$q = "EXPLAIN `{$table}`";
			$orig_paginate = $this->paginate;

			$this->paginate = 0;
			$sth = $this->query( $q );
			$this->paginate = $orig_paginate;

			$cols = array();
			while( $col = $sth->fetch() )
			{
				$cols[$col['Field']] = $col['Type'];
			}

			$this->table_explain[$table] = $cols;
		}

		return $this->table_explain[$table];
	}

	/**
	 * last_insert_id() is a wrapper to PDO::lastInsertId()
	 *
	 * @return integer The auto increment id of the most recently executed statement handle
	 */
	protected function last_insert_id() : int
	{
		return $this->db->lastInsertId();
	}

	/**
	 * connect() handles the PDO connection to the database. First it calls parse_connex() and then it attempts connection.
	 *
	 * @return void
	 */
	private function connect() : void
	{
		$this->parse_connex();

		try
		{
			$this->db = new PDO( $this->dsn, $this->dbuser, $this->dbpass,
				array(
					   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
					   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					   PDO::MYSQL_ATTR_FOUND_ROWS => TRUE
				)
 			);
		}
		catch( PDOException $e )
		{
			$this->log([ 'chan' => 'da', 'type' => 'error', 'msg' => 'connect_failed', 'context' => $this->dsn ]);
			exit;
		}
	}

	/**
	 *	parse_connex() accesses $_SERVER[DB_*] for connection details, builds
	 *	a dsn and assigns all of these to member vars for use by connect().
	 *	@return object $this
	 */
	private function parse_connex() : object
	{
		$this->dsn = "mysql:host={$_SERVER['DB_HOST']};dbname={$_SERVER['DB_NAME']}";
		$this->dbuser = $_SERVER['DB_USER'];
		$this->dbpass = $_SERVER['DB_PASS'];
		$this->dbname = $_SERVER['DB_NAME'];

		return $this;
	}

	/**
	 * Toggles the paginate member var
	 *
	 * @param boolean $action value of paginate
	 * @return boolean new paginate value
	 */
	public function paginate( bool $action = TRUE ) : bool
	{
		$action ? $this->paginate = TRUE : $this->paginate = FALSE;
		$this->set_pagination();

		return $this->paginate;
	}

	/**
	 * Sets pagination params for select results
	 *
	 * @return boolean
	 */
	protected function set_pagination() : bool
	{
		$this->default_result_count = 25;

		if( FALSE !== strpos( $_SERVER['REQUEST_URI'], '?' ) )
		{
			$paginate = explode( '?', $_SERVER['REQUEST_URI'] )[1];
			$paginate = explode( '&', $paginate );
			foreach( $paginate as $param )
			{
				list( $k, $v ) = explode( '=', $param, 2 );
				switch( $k )
				{
					case 'page':
						$this->page = (int) $v;
						break;
					case 'count':
						$this->count = (int) $v;
						break;
				}
			}

			if( !$this->count )
			{
				$this->count = $this->default_result_count;
			}
		}
		else
		{
			$this->paginate = 0;
		}

		return TRUE;
	}

	/**
	 * query() masks PDO::query(). If you need the full functionality of PDO::query,
	 * use $this->db->query() instead. Query will automatically prepare and query
	 * with the supplied $bind and return the statement handle. Otherwise it
	 * throws a QueryException for capture.  Errors are logged to the da log.
	 *
	 * @param string $query The query string properly formed and ready for execution
	 * @param array $bind Properly formed array of bind values. Properly formed means associative array for :placeholders or indexed array for ? placeholders.
	 * @return object $sth
	 */
	public function query( ?string $query, ?array $bind = [] ) : ?object
	{
		if( $this->paginate )
		{
			if( $this->page )
			{
				$lower = ((( $this->page - 1 ) * $this->count ) - 1);
				if( $lower < 0 )
				{
					$lower = 0;
				}
				
				$query .= " LIMIT " . $lower . ', ' . ( $this->count );
			}
		}

		try
		{
			$sth = $this->db->prepare( $query );
			$sth->execute( $bind );

			$this->last_query = $query;
			$this->last_bound = $bind;
		}
		catch( ValueError $ve )
		{
			$this->log([ 'chan' => 'da', 'type' => 'error', 'msg' => 'query_failed - ' . $ve->getMessage(), 'context' => [ 'query' => $query, 'bind' => $bind ] ]);
		}
		catch( PDOException $p )
		{
			$this->log([ 'chan' => 'da', 'type' => 'error', 'msg' => 'query_failed - ' . $p->getMessage(), 'context' => [ 'query' => $query, 'bind' => $bind ] ]);
			throw new QueryException( json_encode( array( 'query' => $query, 'bind' => $bind, 'pdo' => $p ) ) );
		}

		return $sth;
	}

	/**
	 * prep() is a wrapper for PDO::prepare. This should probably be an actual wrapper instead of a replacement.
	 *
	 * @param string $query The properly formed query to PDO::prepare
	 * @return object|boolean FALSE on PDOException, PDO::StatementHandle on success
	 */
	public function prep( string $query ) : object|bool
	{
		try
		{
			$sth = $this->db->prepare( $query );
			return $sth;
		}
		catch( PDOException $p )
		{
			$this->fail( 'prepare_failed' );
			$this->log([ 'chan' => 'da', 'type' => 'error', 'msg' => 'prepare_failed', 'context' => [ $query, $p ] ]);
			return FALSE;
		}
	}
}
