<?php

/**
 *	_role is a core object that provides all methods for managing and manipulating
 *	roles.
 */

class _role extends _obj
{
	public function __construct()
	{
		parent::__construct( '_role' );
	}

	/**
	 * Returns default_role for new _mems. Probably deprecated
	 *
	 * @return array
	 */
	public function get_default_role() : array
	{
		$module = $this->get_by_col([ '_role_default' => 1 ]);

		return $module ? $module : [];
	}

	/**
	 * Gets all admin roles for the sub
	 *
	 * @return array|boolean array of roles or FALSE on error
	 */
	public function get_admin_roles() : array|bool
	{
		$roles = $this->get_by_col([ '_role_type' => 'admin' ], TRUE );
		if( FALSE === $roles )
		{
			$this->fail( 'admin_roles_not_fetched' );
			return FALSE;
		}

		$this->success( 'admin_roles_fetched' );
		return $roles;
	}

	/**
	 * Given a mem_id and role_id returns TRUE if the mem has teh role, FALSE if not
	 *
	 * @param integer $mem_id
	 * @param integer $role_id
	 * @return boolean
	 */
	public function has_role( int $mem_id, int $role_id ) : bool
	{
		$_mem_auth = new _mem_auth();
		$_mem = $_mem_auth->get_by_col([ 'fk__mem_id' => $mem_id, 'fk__role_id' => $role_id ]);

		if( $_mem && $_mem['mem_id'] == $mem_id )
		{
			$this->success( 'mem_has_role' );
			return TRUE;
		}

		$this->fail( 'mem_does_not_have_role' );
		return FALSE;
	}

}
