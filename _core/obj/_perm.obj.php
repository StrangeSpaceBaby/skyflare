<?php

/**
 *	_perm is a core object that provides all methods for managing and manipulating
 *	perms.
 */

class _perm extends _obj
{
	public function __construct()
	{
		parent::__construct( '_perm' );
	}

	/**
	 *	verify_path_access() checks the request path and confirms that the
	 *	supplied role has access.
	 *
	 * @param string $path The request path
	 * @param integer $role_id The auto_increment value of role
	 * @return array|boolean
	 */
	public function verify_path_access( string $path, $role_id ) : array|bool
	{
		if( !$role_id )
		{
			$this->fail( 'no_role_id_supplied' );
			return FALSE;
		}

		$parts = explode( "/", $path, 2 );

		$short_path = array_shift( $parts );
		if( !str_starts_with( $path, '/' ) )
		{
			$short_path = "/" . $short_path;
			$path = "/" . $path;
		}

		$q = "SELECT *
				FROM _role_perm
				JOIN _role ON fk__role_id = _role_id
				JOIN _perm ON fk__perm_id = _perm_id
			WHERE _role_perm_active = 1 AND ( _perm_path = ? OR _perm_path = ? ) AND _role_perm.fk__role_id IN ('" . implode( "','", $role_id )  . "') AND _role.fk__co_id = ?";

		$sth = $this->query( $q, array( $short_path, $path, $this->_co_id ) );
		$access = $sth->fetch();

		return $access ? $access : FALSE;
	}

	/**
	 *	get_all_role_perms() returns all role_perms for all roles for the
	 *	subscriber
	 *
	 * @param string $format 'full' => [role_id][perm_id], path_only => indexed array of paths, role_perm => [role_perm_id]
	 * @return array array of perms
	 */
	public function get_all_role_perms( string $format = 'full' ) : array
	{
		$q = "SELECT * FROM _role_perm JOIN _role ON _role_id = fk__role_id JOIN _perm ON _perm_id = fk__perm_id WHERE _role.fk__co_id = ?";
		$sth = $this->query( $q, array( $this->_co_id ) );

		$perms = array();
		while( $row = $sth->fetch() )
		{
			switch( $format )
			{
				case 'full':
					$perms[$row['_role_id']][$row['_perm_id']] = $row;
					break;
				case 'path_only':
					$perms[] = $row['_perm_path'];
					break;
				case 'role_perm':
					$perms[$row['_role_perm_id']] = $row;
					break;
			}
		}

		$this->success( 'perms_fetched' );
		return $perms;
	}

	/**
	 *	get_role_perms() returns an array of all permissions for a requested role as [role_perm_id]
	 *
	 * @param integer $role_id
	 * @return array
	 */
	public function get_role_perms( int $role_id ) : array
	{
		$q = "SELECT * FROM _role_perm JOIN _role ON _role_id = fk__role_id JOIN _perm ON _perm_id = fk__perm_id WHERE _role.fk__co_id = ? AND _role._role_id = ?";
		$sth = $this->query( $q, array( $this->_co_id, $role_id ) );

		return $sth->fetchAll( PDO::FETCH_UNIQUE );
	}
}
