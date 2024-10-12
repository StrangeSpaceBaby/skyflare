<?php

class _co_mem extends _obj
{
	public function __construct()
	{
		parent::__construct( '_co_mem' );
	}

	/**
	 * Returns all sub_mems with extended data
	 *
	 * @return array|boolean
	 */
	public function get_co_mems() : array|bool
	{
		$mems = $this->get_by_col([], TRUE, TRUE,
			[
				'fk__role_id' =>
				[
					'table' => '_role',
					'join_as' => '_role'
				],
				'fk__mem_id' =>
				[
					'table' => '_mem',
					'join_as' => '_mem'
				]
			],
			"_co_mem_id, fk__mem_id, fk__role_id, _role_id, _role_name, _role_type, _role_default,
			_mem_id, _mem_email, _mem_fname, _mem_lname, _mem_name, _mem_dob, _mem_code, _mem_configured, _mem_email_verified, fk__doc_id, _mem_new,
			if(
				_mem_dob,
				CONCAT(
					MONTH(_mem_dob),
					'/',
					DAY(_mem_dob)
				),
				''
			) AS month_year_dob"
		);

		if( FALSE === $mems )
		{
			$this->fail( 'could_not_fetch_co_mema' );
			return FALSE;
		}

		$this->success( '_co_mems_fetched' );
		return $mems;
	}

	/**
	 * Returns the _co_mem row if the passed _mem_id matches.
	 *
	 * @param integer $id
	 * @return array|boolean sub_mem array or FALSE on error
	 */
	public function get_by__mem_id( int $id ) : array|bool
	{
		$mem = $this->get_by_col([ 'fk__mem_id' => $id ], FALSE, TRUE,
			[
				'fk__role_id' =>
				[
					'table' => '_role',
					'join_as' => '_role'
				]
			],
			"_co_mem_id, fk__mem_id, fk__role_id, _role_id, _role_name, _role_type, _role_default"
		);

		if( FALSE === $mem )
		{
			$this->fail( 'could_not_fetch_co_mem' );
			return FALSE;
		}

		$this->success( '_co_mem_fetched' );
		return $mem;
	}
}
