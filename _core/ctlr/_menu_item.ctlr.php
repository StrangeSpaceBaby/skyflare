<?php

class _menu_item_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_menu_item' );
	}

	/**
	 * Calls _menu_item_obj->get_my_menu()
	 *
	 * @return array|boolean menu array on success, FALSE on error
	 */
	public function my_menu() : array|bool
	{
		$menu = $this->obj->get_my_menu();
		if( FALSE === $menu )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'my_menu_fetched' );
		return $menu;
	}
}
