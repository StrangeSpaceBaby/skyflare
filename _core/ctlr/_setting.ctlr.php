<?php

/**
 *	_setting_ctlr auto-generated
 */

class _setting_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_setting' );
	}

	/**
	 * Gets necesary base settings for each page load for things like product name, copyright, etc.
	 *
	 * @TODO should be moved to obj
	 * @return array|boolean array of base settings or FALSE on error
	 */
	public function get_base_settings() : array|bool
	{
		$this->obj->paginate( FALSE );
		$settings = $this->obj->list();

		if( FALSE === $settings )
		{
			$this->fail( 'base_settings_not_fetched' );
			return FALSE;
		}

		if( $settings )
		{
			$return = [];
			$whitelist = [ 'product_name', 'app_domain', 'meta_desc', 'meta_author', 'copyright_banner' ];

			$set = array_column( array_filter( $settings ), '_setting_id', '_setting_key' );

			foreach( $whitelist as $key )
			{
				$return[$key] = $settings[$set[$key]]['_setting_value'];
			}

			$this->success( 'base_settings_fetched' );
			return $return;
		}

		$this->success( 'no_base_settings_to_fetch' );
		return [];
	}
}
