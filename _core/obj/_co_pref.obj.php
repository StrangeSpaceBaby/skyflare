<?php

class _co_pref extends _obj
{
	public function __construct()
	{
		parent::__construct( '_co_pref' );
	}

	/**
	 * Given a pref_key, returns either the pref value or saves the pref_val to a new pref.
	 * The pref_key must already exist
	 *
	 * @param string $pref_key
	 * @param string $pref_val
	 * @return mixed FALSE on missing pref_key, existing pref_val or pref_id on save
	 */
	public function pref( string $pref_key, string $pref_val = '' ) : mixed
	{
		$pref = $this->get_by_col([ '_co_pref_key' => $pref_key ]);
		if( !$pref['_co_pref_id'] )
		{
			$this->fail( 'no_such_co_pref_key_exists' );
			return FALSE;
		}

		if( $pref && !$pref_val )
		{
			$this->success( 'sub_pref_returned' );
			return $pref['_co_pref_val'];
		}

		$pref_val = nl2br( $pref_val );
		return parent::save([ '_co_pref_id' => $pref['_co_pref_id'], '_co_pref_key' => $pref_key, '_co_pref_val' => $pref_val ]);
	}

	/**
	 * Always returns FALSE because co_prefs should be gotten with pref()
	 *
	 * @param array $vars
	 * @return boolean Always FALSE
	 */
	public function save( array $vars ) : bool
	{
		$this->fail( 'cannot_save_co_pref_directly' );
		return FALSE;
	}
}
