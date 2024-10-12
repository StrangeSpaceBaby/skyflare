<?php

class _follow extends _obj
{
	public function __construct()
	{
		parent::__construct( '_follow' );
	}

	/**
	 * Selects all follows for a particular object for the current user
	 *
	 * @param string $obj
	 * @return boolean|array
	 */
	public function get_by_obj( string $obj ) : bool|array
	{
		$o__mem = new _mem();
		$me = $o__mem->me();
		
		$follows = $this->get_by_col([ '_follow_obj' => $obj, 'fk__mem_id' => $me['_mem_id'] ], TRUE, TRUE );

		if( FALSE === $follows )
		{
			$this->fail( 'could_not_fetch_follows_by_obj' );
			return FALSE;
		}

		$this->success( 'follows_fetched_by_obj' );
		return $follows;
	}

	/**
	 * If the current user is following a particular object and object_id, the follow array is returned
	 * FALSE if not following.
	 *
	 * @param array $vars fk__mem_id, _follow_obj, _follow_obj_id
	 * @return boolean|array
	 */
	public function following( array $vars ) : bool|array
	{
		if( !$vars['fk__mem_id'] )
		{
			$o_mem = new _mem();
			$vars['fk__mem_id'] = $o_mem->me( '_mem_id' );
		}

		$following = $this->get_by_col([ 'fk__mem_id' => $vars['fk__mem_id'], '_follow_obj' => $vars['_follow_obj'], '_follow_obj_id' => $vars['_follow_obj_id'] ], TRUE, TRUE );
		if( FALSE !== $following )
		{
			$this->success( 'following' );
			return $following;
		}

		$this->success( 'not_following' );
		return FALSE;
	}

	/**
	 * Allows a _mem_id to follow an object and object_id. If already following merely returns true and makes no changes.
	 *
	 * @param array $vars fk__mem_id, _follow_obj, _follow_obj_id
	 * @return boolean
	 */
	public function follow( array $vars ) : bool
	{
		$curr_follow = $this->get_by_col([ 'fk__mem_id' => $vars['fk__mem_id'], '_follow_obj' => $vars['_follow_obj'], '_follow_obj_id' => $vars['_follow_obj_id'] ] );
		if( !$curr_follow['_follow_id'] )
		{
			list( $q, $bind ) =  $this->auto_query( $vars );
			$sth = $this->query( $q, $bind );

			if( '00000' == $sth->errorCode() )
			{
				$this->success( 'followed' );
				return TRUE;
			}

			$this->fail( 'could_not_follow' );
			return FALSE;
		}
		else
		{
			if( !$curr_follow['_follow_active'] || $curr_follow['_follow_del'] )
			{
				$undeleted = $this->undelete( $curr_follow['_follow_id'] );
				if( FALSE !== $undeleted )
				{
					$this->success( 'followed' );
					return TRUE;
				}
			}
		}

		$this->success( 'already_following' );
		return TRUE;
	}

	/**
	 * Unfollows _mem from _object and _object_id.
	 * THIS FUNCTION real_delete()s THE FOLLOW ROW
	 *
	 * @param array $vars fk__mem_id, _follow_obj, _follow_obj_id
	 * @return boolean
	 */
	public function unfollow( array $vars ) : bool
	{
		$curr_follow = $this->get_by_col([ 'fk__mem_id' => $vars['fk__mem_id'], '_follow_obj' => $vars['_follow_obj'], '_follow_obj_id' => $vars['_follow_obj_id'] ]);
		if( $curr_follow['_follow_id'] )
		{
			$deleted = $this->real_delete( $curr_follow['_follow_id'] );
			if( $deleted )
			{
				$this->success( 'unfollowed' );
				return TRUE;
			}

			$this->fail( 'could_not_unfollow' );
			return FALSE;
		}

		$this->success( 'already_unfollowed' );
		return TRUE;
	}

	/**
	 * Gets all follow rows for passed column selectors.
	 *
	 * @TODO Fix params and results
	 * @deprecated
	 * @param array $vars passed column selectors
	 * @return array|boolean all follow rows, FALSE on error
	 */
	public function get_follows( array $vars ) : array|bool
	{
		$cols = [ '*' ];
		$joins = [];

		$follows = $this->get_by_col( $vars, TRUE, TRUE, [], implode( ',', $cols ) );

		if( FALSE !== $follows )
		{
			$this->success( 'follows_fetched' );
			return $follows;
		}

		$this->fail( 'follows_could_not_be_fetched' );
		return FALSE;
	}

}
