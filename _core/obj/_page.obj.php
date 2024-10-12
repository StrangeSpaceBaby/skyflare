<?php

class _page extends _fail
{
	/**
	 * _page doesn't use the database at all
	 * so it is the only object that inherits from _fail
	 */
	public function __construct()
	{
		// the obj name name is used to set
		// the log channel and the table for
		// the obj to work with. Change this
		// if the obj works with another table
		parent::__construct( '_page' );
	}
}
