<?php

/**
 *	_page_ctlr auto-generated
 */

class _page_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_page' );
	}

	public function __call() : void
	{
		$page = func_get_args();
		p( $page );
		exit;
	}
}
