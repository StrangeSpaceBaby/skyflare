<?php

/**
 *	_pricing_ctlr auto-generated
 */

class _pricing_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_pricing' );
	}

	public function get_details( int $plan_id ) : array|bool
	{
		$plan = $this->obj->get_details( $plan_id );
		if( FALSE === $plan )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'plan_details_fetched' );
		return $plan;
	}
}
