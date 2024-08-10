<?php

class _mem_reset extends _obj
{
	public function __construct()
	{
		parent::__construct( '_mem_reset' );
	}

	/**
	 * Returns all _mem_resets for a _mem
	 *
	 * @param integer $mem_id
	 * @param mixed $reset_types
	 * @return array|boolean _mem_reset rows or FALSE on error
	 */
	public function get_mem_resets( int $mem_id, mixed $reset_types = [] ) : array|bool
	{
		if( $reset_types && !is_array( $reset_types ) )
		{
			$reset_types = [ $reset_types ];
		}

		if( !$reset_types )
		{
			$reset_types = [ 'email_verify', 'password' ];
		}

		$resets = $this->get_by_col([ 'fk__mem_id' => $mem_id, '_mem_reset_type' => $reset_types ], TRUE );
		if( FALSE === $resets )
		{
			$this->fail( 'resets_cold_not_be_fetched' );
			return FALSE;
		}

		$this->success( 'resets_fetched' );
		return $resets;
	}

	/**
	 * Creates an auth_token and creates new _mem_auth row
	 *
	 * @param array $vars _mem_reset_*
	 * @return integer|boolean new reset row, FALSE on error
	 */
	public function create_reset( array $vars ) : array|bool
	{
		$vars['_mem_reset_token'] = $this->generate_ulid();

		$reset_id = $this->save( $vars );
		if( FALSE === $reset_id )
		{
			$this->fail( 'could not create reset' );
			return FALSE;
		}

		if( $vars['fk__co_id'] )
		{
			$assigned = $this->assign__co_ownership( $reset_id, $vars['fk__co_id'] );
			if( !$assigned )
			{
				$this->delete( $reset_id );
				$this->fail( 'could_not_assign_ownership_to_reset' );
				return FALSE;
			}
		}

		// Because the mem_reset may not belong to the current _co
		$query = "SELECT * FROM _mem_reset WHERE _mem_reset_id = ?";
		$sth = $this->query( $query, [ $reset_id ]);
		$reset = $sth->fetch();

		$this->success( 'reset_created' );
		return $reset;
	}

	public function expire_all__mem_resets( int $_mem_id, string $reset_type ) : bool
	{
		$resets = $this->get_mem_resets( $_mem_id, $reset_type );
		if( $resets )
		{
			foreach( $resets as $reset )
			{
				$this->expire_reset( $reset['_mem_reset_id'] );
			}
		}

		return TRUE;
	}

	/**
	 * Soft deletes the _mem_reset_id
	 *
	 * @param integer $reset_id
	 * @return boolean TRUE on delete, FALSE on error
	 */
	public function expire_reset( int $reset_id ) : bool
	{
		$deleted = $this->delete( $reset_id );

		if( !$deleted )
		{
			$this->fail( 'reset_not_expired' );
			return FALSE;
		}

		$this->success( 'reset_expired' );
		return TRUE;
	}

	/**
	 * Used for _co registration, assigns a reset to another _co
	 *
	 * @param integer $mem_reset_id
	 * @param integer $new_co_id
	 * @return boolean TRUE on assignment, FALSE on error
	 */
	private function assign__co_ownership( int $mem_reset_id, int $new_co_id ) : bool
	{
		$q = "UPDATE _mem_reset SET fk__co_id = ? WHERE _mem_reset_id = ?"; //Not auto_query because we need to override the fk__co_id corrections
		$sth = $this->query( $q, [ $new_co_id, $mem_reset_id ]);

		return '00000' == $sth->errorCode() ? TRUE : FALSE;
	}

	/**
	 * Validates whether a passed token is a valid reset
	 *
	 * @param string $token
	 * @return array|boolean _mem_reset row, FALSE on error
	 */
	public function valid_reset_token( string $token ) : array|bool
	{
		$reset = $this->get_by_col([ '_mem_reset_token' => $token ]);
		if( FALSE === $reset )
		{
			$this->fail( 'could_not_verify_token' );
			return FALSE;
		}

		if( $reset && $reset['_mem_reset_active'] && !$reset['_mem_reset_del'] && !$reset['_mem_reset_arch'] )
		{
			$this->success( 'reset_token_verified' );
			return $reset;
		}

		$this->fail( 'reset_token_invalid_or_expired' );
		return FALSE;
	}
}
