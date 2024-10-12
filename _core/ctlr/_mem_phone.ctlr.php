<?php

use Erichowey\NanpNumberFormatter\NanpNumberFormatter;

/**
 *	_mem_phone_ctlr auto-generated
 */

class _mem_phone_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_mem_phone' );
	}

	/**
	 * Fetches and formats all a _mem's phone numbers in intl format
	 *
	 * @TODO figure out how to support ulid
	 * @param integer $_mem_id auto increment id of _mem
	 * @return array|boolean array of phones or FALSE on error
	 */
	public function get_by__mem( int $_mem_id ) : array|bool
	{
		$phones = $this->obj->get_by_col([ 'fk__mem_id' => $_mem_id ], TRUE, TRUE,
		[
			'fk__cat_phone_id' =>
			[
				'table' => '_cat_phone',
				'join_as' => '_cat_phone'
			]
		], "*" );

		if( FALSE === $phones )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		if( $phones )
		{
			foreach( $phones as $phone_id=> $phone )
			{
				$num = NanpNumberFormatter::format( $phone['_mem_phone_number'] );
				$phones[$phone_id]['_mem_phone_number'] = $num->internationalFormat;
			}
		}

		$this->success( 'phones_gotten_by_mem' );
		return $phones;
	}
}
