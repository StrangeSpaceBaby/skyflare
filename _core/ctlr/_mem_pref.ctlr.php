<?php

class _mem_pref_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_mem_pref' );
	}

	/**
	 * Determines if the user already has the pref and if so, removes it.
	 * If not, creates pref for _mem.
	 *
	 * @TODO Remove reliance on global $me, move logic to obj method
	 * @param array $args _mem_pref_group, _mem_pref_value
	 * @return integer|boolean _mem_pref_id on save, FALSE on error
	 */
	public function toggle( array $args ) : int|bool
	{
		global $me;

		$group = array_shift( $args );
		$value = array_shift( $args );
		$vars = [ 'fk__mem_id' => $me['_mem_id'], '_mem_pref_group' => $group, '_mem_pref_value' => $value ];
		$pref = $this->obj->get_by_col( $vars, FALSE, FALSE );

		if( FALSE === $pref )
		{
			$this->fail( 'could_not_verify_pref_prior_to_toggle' );
			return FALSE;
		}

		if( $pref['_mem_pref_id'] )
		{
			$saved = $this->obj->toggle_active( $pref['_mem_pref_id'] );
		}
		else
		{
			$saved = $this->obj->save( $vars );
		}

		if( !$saved )
		{
			$this->fail( 'could_not_toggle_pref ' );
			return FALSE;
		}

		$this->success( 'pref_toggled' );
		return $saved;
	}

	/**
	 * Can search either by group or by group and value and returns matching _mem_prefs for $me
	 *
	 * @TODO remove reliance on global $me
	 * @param string|array $args string of _mem_pref_Group or both group and value
	 * @return array|boolean array of _mem_prefs on select, FALSE on error
	 */
	public function get_prefs_by( string|array $args ) : array|bool
	{
		global $me;

		$search_cols = [];
		$group = $args; // If no value is supplied this will search all prefs by the group
		if( is_array( $args ) )
		{
			$group = $args[0];
			$val = $args[1];
			$search_cols['_mem_pref_value'] = $val;
		}

		$search_cols['_mem_pref_group'] = $group;
		$search_cols['fk__mem_id'] = $me['_mem_id'];

		$prefs = $this->obj->get_by_col( $search_cols, TRUE, TRUE );

		if( FALSE !== $prefs )
		{
			$this->success( '_mem_prefs ' . $group . ' ' . $val );
			return $prefs;
		}

		$this->fail( 'could_not_fetch_prefs_by ' . $group . ' ' . $val );
		return FALSE;
	}
}
