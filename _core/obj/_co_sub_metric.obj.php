<?php

class _co_sub_metric extends _obj
{
	public function __construct()
	{
		// the obj name name is used to set
		// the log channel and the table for
		// the obj to work with. Change this
		// if the obj works with another table
		parent::__construct( '_co_sub_metric' );
	}
}
