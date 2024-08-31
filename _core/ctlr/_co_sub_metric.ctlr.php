<?php

class _co_sub_metric_ctlr extends _ctlr
{
	public function __construct()
	{
		// the ctlr name name is used to set
		// the log channel and to instantiate $this->obj
		parent::__construct( '_co_sub_metric' );
	}
}
