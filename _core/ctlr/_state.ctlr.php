<?php

/**
 *	_state_ctlr auto-generated
 */

class _state_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_state' );
	}

	/**
	 * Returns states with fk__country_id of passed id
	 *
	 * @param integer $country_id
	 * @return array|boolean array of states on success, FALSE on error
	 */
	public function get_states_by_country_id( int $country_id ) : array|bool
	{
		$states = $this->obj->get_by_col(
			[ 'fk__country_id' => $country_id ],
			TRUE, TRUE,
			[
				'fk__country_id' =>
				[
					'table' => '_country',
					'join_as' => '_country'
				]
			],
			"_state_id, _state_name,_state_abbrev, _state_display_order, _country_id, _country_name, _country_abbrev"
		);

		if( FALSE !== $states )
		{
			$this->success( 'states_fetched' );
			return $states;
		}

		$this->fail( 'states_not_fetched' );
		return FALSE;
	}

	/**
	 * Should get states by country abbrev
	 *
	 * @deprecated
	 * @param string $country_abbrev
	 * @return void
	 */
	public function get_states_by_country_abbrev( string $country_abbrev ) : void
	{
		$states = $this->obj->get_by_col(
			[ '_country_abbrev' => $country_abbrev ],
			TRUE, TRUE,
			[
				'fk__country_id' =>
				[
					'table' => '_country',
					'join_as' => '_country'
				]
			],
			"_state_name,_state_abbrev, _state_display_order, _country_id, _country_name, _country_abbrev"
		);
	}
}
