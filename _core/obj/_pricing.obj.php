<?php

/**
 *	_pricing auto-generated
 */

class _pricing extends _obj
{
	public function __construct()
	{
		parent::__construct( '_pricing' );
		$this->log_chan( '_pricing' )->log_lvl( 'error' );
	}

	public function get_details( int $plan_id ) : array|bool
	{
		$plan = $this->get_by_col([ '_pricing_id' => $plan_id ]);
		if( FALSE === $plan )
		{
			$this->fail( $this->get_error_msg() );
			return FALSE;
		}

		if( !$plan )
		{
			$this->fail( 'no_such_pricing_id' );
			return FALSE;
		}

		$o__pricing_module = new _pricing_module();
		$modules = $o__pricing_module->get_by_col([ 'fk__pricing_id' => $plan['_pricing_id'] ], TRUE );
		if( FALSE === $modules )
		{
			$this->fail( $this->get_error_msg() );
			return FALSE;
		}
		$plan['modules'] = $modules;

		$this->success( 'plan_details_fetched' );
		return $plan;
	}
}
