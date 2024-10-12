<?php

class _role_perm extends _obj
{
	public function __construct()
	{
		parent::__construct( '_role_perm' );
	}

	public function get_by_role_id( int $role_id ) : array|bool
	{
		$perms = $this->get_by_col([ 'fk__role_id' => $role_id ], TRUE );
		if( FALSE === $perms )
		{
			$this->fail( $this->get_error_msg() );
			return FALSE;
		}

		$this->success( 'role_perms_fetched_by_role_id' );
		return $perms;
	}

	/**
	 * If role has perm, the role_perm_id is returned.
	 *
	 * @param integer $role_id
	 * @param integer $perm_id
	 * @return integer|boolean role_perm_id or FALSE on error
	 */
	public function role_has_perm( int $role_id, int $perm_id ) : int|bool
	{
		if( is_numeric( $perm_id ) && is_integer( $perm_id * 1 ) )
		{
			$perm = $this->get_by_col([ 'fk__role_id' => $role_id, 'fk__perm_id' => $perm_id ]);
		}
		else
		{
			$_perm = new _perm();
			$perm_row = $_perm->get_by_col([ '_perm_path' => $perm_id ]);
			$perm = $this->get_by_col([ 'fk__role_id' => $role_id, 'fk__perm_id' => $perm_row['perm_id'] ]);
		}

		if( $perm['_role_perm_id'] )
		{
			$this->success( 'role_has_perm' );
			return $perm['role_perm_id'];
		}

		$this->fail( 'role_does_not_have_perm' );
		return FALSE;
	}

	/**
	 * save() checks to make sure the role does not already have the permission
	 * before calling the parent::save().
	 *
	 * @param array $vars
	 * @return integer|boolean _role_perm_id or FALSE on error
	 */
	public function save( array $vars ) : int|bool
	{
		// We need to check here for uniques before calling the parent save
		$role_perm = $this->get_by_col([ 'fk__role_id' => $vars['fk__role_id'], 'fk__perm_id' => $vars['fk__perm_id'] ], FALSE );

		if( $role_perm['_role_perm_id'] )
		{
			$this->success( 'role_has_perm' );
			return TRUE;
		}

		$saved = parent::save( $vars );
		if( $saved )
		{
			$this->success( 'role_perm_saved' );
			return $saved;
		}

		$this->fail( 'role_perm_not_saved' );
		return FALSE;
	}
}
