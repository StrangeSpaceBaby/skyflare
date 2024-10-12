<?php

/**
 *
 */

class _role_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_role' );
	}

	/**
	 * Gets !superadmin roles
	 *
	 * @param array $args Not used by here for compliance with _ctlr method
	 * @return array|boolean
	 */
	public function list( array $args = [] ) : array|bool
	{
		$roles = $this->obj->get_by_col([ '_role_type' => '!superadmin' ], TRUE, TRUE );
		if( FALSE === $roles )
		{
			$this->fail( 'roles_not_listed' );
			return FALSE;
		}

		$this->success( 'roles_listed' );
		return $roles;
	}

	/**
	 * Saves new role perm
	 *
	 * @TODO missing logic
	 * @return void
	 */
	public function save_role_perm()
	{

	}
}
