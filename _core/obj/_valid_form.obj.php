<?php

class _valid_form extends _obj
{
	public function __construct()
	{
		parent::__construct( '_valid_form' );
	}

	/**
	 * Gets all forms by table name
	 *
	 * @param string $table
	 * @return array|boolean array of forms or FALSE on error
	 */
	public function get_forms_by_table( string $table ) : array|bool
	{
		$forms = $this->get_by_col([ '_valid_form_table' => $table ], TRUE );
		if( FALSE === $forms )
		{
			$this->fail( 'forms_by_table_not_selected' );
			return FALSE;
		}

		$this->success( 'forms_by_table_fetched' );
		return $forms;
	}

	/**
	 * Calls parent::delete() and then removes all valid_fields for the form
	 *
	 * @param integer|string $id _valid_form_id
	 * @return boolean TRUE if deleted, FALSE on error
	 */
	public function delete( int|string $id ) : bool
	{
		$deleted = parent::delete( $id );

		if( !$deleted )
		{
			// The parent has already set any errors
			return FALSE;
		}
		else
		{
			$o_valid_field = new _valid_field();
			$fields_deleted = $o_valid_field->delete_by_form_id( $id );
			if( !$fields_deleted )
			{
				$this->fail( $o_valid_field->get_error_msg() );
				return FALSE;
			}
		}

		$this->success( 'valid_form_deleted' );
		return TRUE;
	}
}
