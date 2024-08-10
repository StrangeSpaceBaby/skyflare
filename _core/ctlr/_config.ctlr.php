<?php

class _config_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_config' );
	}

	/**
	 * Returns an array of config options for the passed id.
	 *
	 * @TODO name is wrong and the logic is too bare. Also, calls get_by_col directly on the obj
	 * @param integer $config_id auto increment id of the desired row
	 * @return array|boolean
	 */
	public function edit( int $config_id ) : array|bool
	{
		$config = $this->obj->get_by_col([ '_config_id' => $config_id ]);
		if( FALSE === $config )
		{
			$this->fail( 'could_not_edit_config' );
			return FALSE;
		}

		$this->success( 'config_fetched_for_editing' );
		return $config;
	}
}
