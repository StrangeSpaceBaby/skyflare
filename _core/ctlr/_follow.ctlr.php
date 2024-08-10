<?php

/**
 *	_follow_ctlr auto-generated
 */

class _follow_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_follow' );
	}

	/**
	 * Gets all follows by an object/tablw name
	 *
	 * @param string $obj Object or table name
	 * @return array|boolean array of follows or FALSE on error
	 */
	public function get_by_obj( string $obj ) : array|bool
	{
		global $me;

		$follows = $this->obj->get_by_obj( $obj );

		if( FALSE === $follows )
		{
			$this->fail( 'could_not_fetch_follows_by_obj' );
			return FALSE;
		}

		$this->success( 'follows_fetched_by_obj' );
		return $follows;
	}

	/**
	 * If not following, now follows.
	 * If follows, now does not follow.
	 *
	 * @return int|boolean id of the follow row or FALSE on error
	 */
	public function toggle() : int|bool
	{
		global $me;

		$follow = $this->obj->get_by_col([ '_follow_obj' => _POST['_follow_obj'], '_follow_obj_id' => _POST['_follow_obj_id'], 'fk__mem_id' => $me['_mem_id'] ], FALSE, FALSE );

		if( $this->obj->failed() )
		{
			$this->fail( 'could_not_fetch_follow_to_toggle' );
			return FALSE;
		}

		if( !$follow )
		{
			_POST['fk__mem_id'] = $me['_mem_id'];
			$follow = $this->obj->save( _POST );

			if( FALSE === $follow )
			{
				$this->fail( 'could_not_follow_obj' );
				return FALSE;
			}

			$this->success( 'follow_started' );
			return $follow;
		}
		else
		{
			$follow['_follow_active'] = !$follow['_follow_active'];
			$toggle = $this->obj->save( $follow );
			$this->success( 'follow_toggled' );
			return $follow;
		}
	}

	/**
	 * If authenticated user is following obj, returns the follow array
	 *
	 * @param array $args
	 * @return array|boolean follow row or FALSE on error
	 */
	public function do_i_follow( array $args ) : array|bool
	{
		global $me;

		$obj = array_shift( $args );
		$id = array_shift( $args );

		$follow = $this->obj->get_by_col([ '_follow_obj' => $obj, '_follow_obj_id' => $id, 'fk__mem_id' => $me['_mem_id'] ]);

		if( FALSE === $follow )
		{
			$this->fail( 'dont_know_if_you_follow' );
			return FALSE;
		}

		if( !$follow )
		{
			$this->success( 'you_do_not_follow' );
			return [];
		}

		$this->success( 'you_follow' );
		return $follow;
	}
}
