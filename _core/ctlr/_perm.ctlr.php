<?php

/**
 *	perm_ctlr handles everything related to perms for security
 */

class _perm_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_perm' );
	}

	/**
	 * Gets all !superadmin perms
	 *
	 * @TODO fix this.  Calls get_by_col directly
	 * 
	 * @param array $args None are used in this context
	 * @return array|boolean array of perms or FALSE on error
	 */
	public function list( array $args = [] ) : array|bool
	{
		$perms = $this->obj->get_by_col([ '_perm_role_type' => '!superadmin' ], TRUE, TRUE, [], "_perm_id, _perm_protected, _perm_role_type, _perm_name, _perm_path, _perm_desc, _perm_ulid" );
		if( FALSE === $perms )
		{
			$this->fail( 'perms_not_listed' );
			return FALSE;
		}

		$this->success( 'perms_listed' );
		return $perms;
	}

	/**
	 * Calls _role_perm_obj->get_role_perms() and returns array
	 *
	 * @param integer $role_id auto_increment id of role
	 * @return array|boolean array of perms or FALSE on error
	 */
	public function get_role_perms( int $role_id ) : array|bool
	{
		$perms = $this->obj->get_role_perms( $role_id );

		if( $this->obj->failed() )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'perms_fetched' );
		return $perms;
	}

	/**
	 *	get_all_role_perms() returns an array of all permissions by role.
	 *	full, path_only, role_perm
	 *	@param	string	$format		'full' = [role_id][perm_id], 'path_only' => Indexed array of paths, 'role_perm' => [role_perm_id]
	 *	@return	array	Formatted array in one of three formats, FALSE on error
	 */

	public function get_all_role_perms( $format = 'full' ) :array|bool
	{
		$perms = $this->obj->get_all_role_perms( $format );
		if( $this->obj->failed() )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'all_role_perms_fetched' );
		return $perms;
	}
}
