<?php

/**
 *	_valid_field manages the validation rules for form fields
 */

class _valid_field extends _obj
{
	public function __construct()
	{
		parent::__construct( '_valid_field' );
	}

	public function delete_by_form_id( int $id ) : bool
	{
		$q = "DELETE FROM _valid_field WHERE fk__valid_form_id = ?";
		$sth = $this->query( $q, [ $id ] );
		$sth->execute();

		return '00000' != $sth->errorCode() ? FALSE : TRUE;
	}

	public function form_fields( string $form_input_id ) : bool|array
	{
		$q = "SELECT * FROM _valid_field JOIN _valid_form ON _valid_form._valid_form_id = _valid_field.fk__valid_form_id WHERE _valid_form_input_id = ?";
		$sth = $this->query( $q, [ $form_input_id ] );
		$sth->execute();

		if( '00000' != $sth->errorCode() )
		{
			return FALSE;
		}
		
		$fields = array();
		while( $row = $sth->fetch() )
		{
			$fields[$row['_valid_field_id']] = array(
				'_valid_field_id' => $row['_valid_field_id'],
				'id'		=> $row['_valid_field_input_id'],
				'name'		=> $row['_valid_field_name'],
				'type'		=> $row['_valid_field_type'],
				'required'	=> $row['_valid_field_required'],
				'mask'		=> $row['_valid_field_mask'],
				'min'		=> $row['_valid_field_min'],
				'max'		=> $row['_valid_field_max'],
				'format'	=> $row['_valid_field_format'],
				'src'		=> $row['_valid_field_src'],
				'default'	=> $row['_valid_field_default_value'] ? $row['_valid_field_default_value'] : NULL,
			);
		}

		$this->success( 'fields_fetched' );
		return $fields;
	}

}
