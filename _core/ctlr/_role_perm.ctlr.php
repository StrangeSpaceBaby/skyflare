<?php

/**
 *	role_perm_ctlr manages the association of perms to roles.
 */

class _role_perm_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_role_perm' );
	}

	/**
	 * Given a _role_id amnd a _perm_id, returns perm array if exists for user
	 *
	 * @TODO move logic to _role_perm obj
	 * @param array $args
	 * @return array|boolean
	 */
	public function has_perm( array $args ) : array|bool
	{
		$role_id = array_shift( $args );
		$perm_id = array_shift( $args );

		$perm = $this->obj->get_by_col([ 'fk__perm_id' => $perm_id, 'fk__role_id' => $role_id ] );
		if( FALSE === $perm )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$o_mem = new _mem();
		$me = $o_mem->me();

		$perm['me'] = $me;
		$this->success( 'Role perm checked' );
		return $perm;
	}

	/**
	 * Gets all perms for passed role_id
	 *
	 * @param integer $role_id
	 * @return array|boolean
	 */
	public function get_by_role_id( int $role_id ) : array|bool
	{
		$perms = $this->obj->get_by_role_id( $role_id, TRUE );
		if( FALSE === $perms )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'role_perms_fetched_by_role_id' );
		return $perms;
	}

	/**
	 * Turns on or off a _role_perm for the role regardless of user
	 *
	 * @TODO move logic to obj
	 * @param array $args _role_id, _perm_id
	 * @return integer|boolean
	 */
	public function toggle_perm( array $args ) : int|bool
	{
		$role_id = array_shift( $args );
		$perm_id = array_shift( $args );

		if( !$role_id || !$perm_id )
		{
			$this->fail( 'role_or_perm_id_missing' );
			return FALSE;
		}

		$perm = $this->obj->get_by_col([ 'fk__role_id' => $role_id, 'fk__perm_id' => $perm_id ], FALSE, FALSE ); // FALSE, FALSE = One record return, Include deleted/inactive

		if( FALSE === $perm )
		{
			$this->fail( 'could_not_get_perm_to_toggle' );
			return FALSE;
		}

		if( $perm )
		{
			if( $perm['_role_perm_del'] )
			{
				$saved = $this->obj->undelete( $perm['_role_perm_id'] );
			}
			else
			{
				$saved = $this->obj->delete( $perm['_role_perm_id'] );
			}
		}
		else
		{
			$saved = $this->obj->save([ 'fk__role_id' => $role_id, 'fk__perm_id' => $perm_id ]);
			if( FALSE === $saved )
			{
				$this->fail( 'role_perm_could_not_be_saved' );
				return FALSE;
			}
		}

		if( $saved )
		{
			$this->success( 'permission_toggled' );
			return $saved;
		}

		$this->fail( 'perm_could_not_be_toggled' );
		return FALSE;
	}
}
