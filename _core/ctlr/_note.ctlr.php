<?php

/**
 *	_note_ctlr auto-generated
 */

class _note_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_note' );
	}

	/**
	 * Get notes by obj (scope)
	 *
	 * @TODO fix, does not return notes and does not make any calls
	 * @param array $args obj & obj_id
	 * @return void
	 */
	public function get_by_obj( $args ) : void
	{
		$obj = array_shift( $args );
		$obj_id = array_shift( $args );

		if( !$obj )
		{
			$this->fail( 'obj_not_supplied_for_notes' );
			return FALSE;
		}

		if( !$obj_id )
		{
			$this->fail( 'obj_id_not_supplied_for_notes' );
			return FALSE;
		}
	}
}
