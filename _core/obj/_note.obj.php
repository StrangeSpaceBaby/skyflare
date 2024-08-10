<?php

/**
 *
 */

class _note extends _obj
{
	public function __construct()
	{
		parent::__construct( '_note' );
	}

	/**
	 * Get the number of child notes for a note_id
	 *
	 * @param integer $note_id
	 * @return integer|boolean count of children, FALSE on error
	 */
	public function get_child_count( int $note_id ) : int|bool
	{
		$children = $this->obj->get_by_col([ 'fk_note_id' => $note_id ], FALSE, TRUE, [], "COUNT(*) AS count" );

		if( FALSE !== $children )
		{
			$this->success( 'child_count_fetched' );
			return $children['count'];
		}

		$this->fail( 'could_not_fetch_child_note_count' );
		return FALSE;
	}

	/**
	 * Gets notes by filter in $vars
	 *
	 * @param array $vars _note_obj, _note_obj_id, fk_cat_note_id, fk__mem_id
	 * @return array|boolean array of notes, FALSE on error
	 */
	public function get_notes( array $vars ) : array|bool
	{
		$cols = [];

		$filters = [ '_note_obj', '_note_obj_id', 'fk_cat_note_id', 'fk__mem_id' ];

		foreach( $filters as $filter )
		{
			if( $vars[$filter] )
			{
				$cols[$filter] = $vars[$filter];
			}
		}

		$notes = $this->get_by_col( $cols, TRUE, TRUE, [], "*" );

		if( FALSE !== $notes )
		{
			$this->success( 'notes_fetched' );
			return $notes;
		}

		$this->fail( 'notes_could_not_be_fetched' );
		return FALSE;
	}
}
