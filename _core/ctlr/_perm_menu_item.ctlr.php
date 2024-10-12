<?php

/**
 *	_perm_menu_item_ctlr auto-generated
 */

class _perm_menu_item_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_perm_menu_item' );
	}

	/**
	 * Gets menu_by_role() for current user
	 *
	 * @TODO fix this entirely
	 * @return array|boolean menu array on success, FALSE one rror
	 */
	public function get_my_menu() : array|bool
	{
		$_auth_token = new _auth_token();
		$token = $_auth_token->verify_token();

		$_mem_auth = new _mem_auth();
		$me = $_mem_auth->get_by_col([ 'fk__mem_id' => $token['fk__mem_id'] ]);

		$menu = $this->obj->get_menu_by_role( $me['fk__role_id'] );
		if( FALSE !== $menu )
		{
			$this->success( 'menu_fetched' );
			return $menu;
		}

		$this->fail( 'menu_not_fetched' );
		return FALSE;
	}
}
