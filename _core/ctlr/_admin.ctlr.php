<?php

class _admin_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_admin' );
	}

	/**
	 * Calls _admin_obj->auto_create() to scan the db and create ctlrs, objs, pages, etc.
	 *
	 * @return void
	 */
	public function auto_create() : void
	{
		$this->obj->auto_create();
	}

	/**
	 * Gets an array of all tables in the db
	 *
	 * @return array|boolean array of table details or FALSE on error
	 */
	public function get_tables() : array|bool
	{
		$list = $this->obj->get_tables();
		if( FALSE !== $list )
		{
			$tables = [];
			if( $list )
			{
				foreach( $list as $table )
				{
					$tables[$table]['table_name'] = $table;
				}
			}

			$this->success( 'tables_fetched' );
			return $tables;
		}

		$this->fail( 'tables_not_fetched' );
		return FALSE;
	}

	/**
	 * Gets a list of all _admin_obj in an array
	 *
	 * @return array|boolean array of admin objects or FALSE on error
	 */
	public function get_objs() : array|bool
	{
		$list = $this->obj->list();
		if( FALSE !== $list )
		{
			$this->success( 'objs_fetched' );
			return $list;
		}

		$this->fail( 'objs_not_fetched' );
		return FALSE;
	}

	/**
	 * Creates new table from POST values
	 *
	 * @return boolean Always returns true when creating table, obj, ctlr, etc.
	 */
	public function create_table() : bool
	{
		if( !_POST['_admin_obj_table'] )
		{
			$this->fail( 'no_table_name_provided' );
			return FALSE;
		}

		$created = $this->obj->create_table( _POST['_admin_obj_table'] );
		if( FALSE !== $created )
		{
			$this->success( 'table_created' );
			return $created;
		}

		$this->fail( 'table_not_created' );
		return FALSE;
	}

	/**
	 * Maybe deprecated?
	 *
	 * @deprecated
	 * @return boolean TRUE on creation, FALSE on error
	 */
	public function create_obj() : bool
	{
		$exists = $this->obj->get_by_col([ '_admin_obj_name' => _POST['_admin_obj_name'] ]);
		if( $exists && FALSE !== $exists )
		{
			$this->fail( 'obj_exists' );
			return FALSE;
		}

		if( _POST['_admin_obj_table'] )
		{
			$created = $this->obj->create_table( _POST['_admin_obj_table'] );
		}
		else
		{
			$created = $this->obj->save( _POST );
		}

		if( FALSE !== $created )
		{
			$this->success( 'obj_created' );
			return $created;
		}

		$this->fail( 'obj_not_created' );
		return FALSE;
	}

}
