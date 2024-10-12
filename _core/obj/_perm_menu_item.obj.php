<?php

class _perm_menu_item extends _obj
{
	public function __construct()
	{
		parent::__construct( '_perm_menu_item' );
	}

	/**
	 * Returns a role's menu
	 *
	 * @param integer $role_id
	 * @return array|boolean menu array or FALSE on error
	 */
	public function get_menu_by_role( int $role_id ) : array|bool
	{
		$q = "SELECT _menu_item.*, _perm_menu_item.*
				FROM _perm_menu_item
				JOIN _menu_item ON _perm_menu_item.fk__menu_item_id = _menu_item._menu_item_id
				JOIN _role_perm ON _role_perm.fk__perm_id = _perm_menu_item.fk__perm_id
			WHERE
				_perm_menu_item.fk__co_id = :fk__co_id AND _role_perm.fk__role_id = :fk__role_id";
		$sth = $this->query( $q, [ 'fk__co_id' => $this->_co_id, 'fk__role_id' => $role_id ]);

		if( '00000' == $sth->errorCode() )
		{
			$this->success( 'role_menu_fetched' );

			$menu = [];
			while( $row = $sth->fetch() )
			{
				$menu[$row['_perm_menu_item_disp_order']] = $row;
			}

			return $menu;
		}

		$this->fail( 'role_menu_failed' );
		return FALSE;
	}
}
