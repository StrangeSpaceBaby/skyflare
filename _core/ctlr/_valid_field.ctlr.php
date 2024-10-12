<?php

/**
 *	service_ctlr handles everything related to a service. A service is defined as the first URI segment after the host domain.
 *	Where the URI is http://example.com/_mem/save, /_mem is the service, /save is the function name
 */

class _valid_field_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_valid_field' );
	}

	/**
	 * Given a form name, returns all fields for the form
	 *
	 * @param string $form_name
	 * @return array|bool array of fields or FALSE on error
	 */
	public function form_fields( string $form_name ) : array|bool
	{
		$fields = $this->obj->form_fields( $form_name );

		if( $this->obj->failed() )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'fields_fetched' );
		return $fields;
	}

}
