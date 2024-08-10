<?php

/**
 *	_module is a core object that provides all methods for managing and manipulating
 *	roles.
 */

class _module extends _obj
{
	public function __construct()
	{
		parent::__construct( '_module' );
	}

	/**
	 * Returns the default module or empty array
	 *
	 * @return array default_module = 1
	 */
	public function get_default_module() : array
	{
		$module = $this->get_by_col([ '_module_default' => 1 ]);

		return $module ? $module : [];
	}
}
