<?php

class _sub_plan_metric_ctlr extends _ctlr
{
	public function __construct()
	{
		// the ctlr name name is used to set
		// the log channel and to instantiate $this->obj
		parent::__construct( '_sub_plan_metric' );
	}
}
