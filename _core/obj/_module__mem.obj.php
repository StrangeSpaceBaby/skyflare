<?php
class _module__mem extends _obj
{
	public function __construct()
	{
		parent::__construct( '_module__mem' );
	}

	/**
	 * Returns _module_mem row for passed _mem_id if found
	 *
	 * @param integer $_mem_id
	 * @return array|boolean _module_mem row, FALSE on error
	 */
	public function get_by__mem_id( int $_mem_id ) : array|bool
	{
		$module_mem = $this->get_by_col([ 'fk__mem_id' => $_mem_id ], TRUE, TRUE );
		if( FALSE === $module_mem )
		{
			$this->fail( 'db_error' );
			return FALSE;
		}

		$this->success( '_module_mem_fetched' );
		return $module_mem;
	}
}
