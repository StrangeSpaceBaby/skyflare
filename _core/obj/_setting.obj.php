<?php

/**
 *	_setting handles meta settings for teh application such as product name,
 *	default language, etc.
 */

class _setting extends _obj
{
	public function __construct()
	{
		parent::__construct( '_setting' );
	}

	/**
	 * Returns either the setting value or the setting row depending on val_only
	 *
	 * @param string $key _setting_key
	 * @param boolean $val_only
	 * @return mixed
	 */
	public function by_key( string $key, bool $val_only = TRUE ) : mixed
	{
		$setting = $this->get_by_col([ '_setting_key' => $key ]);
		if( FALSE === $setting )
		{
			$this->fail( '_setting->by_key failed' );
			return FALSE;
		}

		$this->success( '_setting->by_key_success' );

		return $val_only ? $setting['_setting_value'] : $setting;
	}
}
