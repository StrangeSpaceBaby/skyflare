<?php

/**
 *	_ctlr is the common brain for all controllers.
 *	This ctlr manages all SLED requests for the associated object.
 *	Specific route controllers should extend this class.
 */

class _ctlr extends _fail
{
	protected object $obj;

	/**
	 *	The constructor takes an object name and optionally arguments. Typically these are passed in by the extending classes.
	 *	The associated object is automatically instantiated and returned to the caller.
	 *
	 * @param string $obj Name of the object such as _fail
	 * @param mixed $args Any arguments to be passed to the underlying object
	 */
	public function __construct( string $obj = '', mixed $args = NULL )
	{
		parent::__construct();

		$this->_obj( $obj, $args );
	}

	/**
	 * Toggles a row's _active column
	 *
	 * @param int|string $id auto_increment id or ulid
	 * @return int|boolean New toggled state or FALSE on error
	 */
	public function toggle_active( int|string $id ) : int|bool
	{
		$toggled = $this->obj->toggle_active( $id );
		if( FALSE === $toggled )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( $this->obj->get_error_msg() );
		return $toggled;
	}

	public function search( $args )
	{

	}

	/**
	 *	_obj instantiates the associated object with the controller.
	 *
	 * @param string $obj The string literal object name
	 * @param mixed $args An array or single variable, optional
	 * @return object $this	An instance of the ctlr object
	 */
	protected function _obj( string $obj, mixed $args = [] ) : object
	{
		if( $obj )
		{
			$this->obj = new $obj( $args );
		}

		return $this;
	}

	/**
	 *	fetch selects one row by id from the table
	 *	@param   integer	$id	The table id value of the object requested
	 *	@return  mixed	FALSE on failure, array of the object requested on success
	 */

	public function fetch( int $id ) : bool|array
	{
		$fetched = $this->obj->get_by_id( $id );

		if( !$fetched )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}
		else
		{
			$this->success( 'fetched' );
			return $fetched;
		}
	}

	/**
	 *	delete marks one row in the table as deleted
	 *
	 * @param string|integer $id ulid or id o the row to mark deleted
	 * @return boolean FALSE on failure, TRUE on success
	 */
	public function delete( string|int $id ) : bool
	{
		$deleted = $this->obj->delete( $id );

		if( !$deleted )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}
		else
		{
			$this->success( $this->obj->get_error_msg() );
			return TRUE;
		}
	}

	/**
	 *	save saves a single row to the table from the $_POST.
	 *	This function ignores any other request values to comply with the subset of RESTful API common practices
	 *	@return  bool	FALSE on failure, TRUE on success
	 */

	public function save() : bool
	{
		$saved = $this->obj->save( $_POST );
		if( !$saved )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}
		else
		{
			$this->success( $this->obj->get_error_msg() );
			return $saved;
		}
	}

	/**
	 *	list grabs all active rows from the table
	 *
	 * @param array $vars Options for what to include/exclude and how to return results
	 * @return array|boolean array of matching rows or FALSE on error
	 */
	public function list( array $vars = [] ) : array|bool
	{
		$list = $this->obj->list( $vars );

		if( FALSE === $list )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}
		else
		{
			$this->success( $this->obj->get_error_msg() );
			return $list;
		}
	}

	/**
	 * Checks whether a string is part of the core app
	 *
	 * @param string $check name of object, table, column or other
	 * @return string|boolean passed string or FALSE on error
	 */
	public function is_core( string $check ) : string|bool
	{
		$check = $this->obj->is_core( $check );

		if( FALSE === $check )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}
		else
		{
			$this->success( $this->obj->get_error_msg() );
			return $check;
		}
	}

	/**
	 * Parses the args that are passed to the controller and returns the args
	 * as either an array of key-value pairs or simply the path parts split
	 * on the separator
	 *
	 * @param array $args Passed arg array from index ontroller
	 * @param string $return_type requested format of the path
	 * @return array formatted array of arguments
	 */
	public function parse_args( array $args, string $return_type = 'assoc' ) : array
	{
		switch( $return_type )
		{
			case 'assoc':
			case 'associative':
				$to_parse = $args;
				while( $key = array_shift( $to_parse ) )
				{
					$return[$key] = array_shift( $to_parse );
				}
				break;
			case 'path':
				$return = implode( '/', $args );
				break;
		}

		return $return;
	}
}
