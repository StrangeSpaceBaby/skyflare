<?php

/**
 *	valid_form_ctlr handles everything related to a service. A service is defined as the first URI segment after the host domain.
 *	Where the URI is http://example.com/_mem/save, /_mem is the service, /save is the function name
 */

class _valid_form_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_valid_form' );
	}

	/**
	 * Returns all valid forms related by table
	 *
	 * @param string $table table name
	 * @return array|bool array of forms or FALSE on error
	 */
	public function forms_by_table( string $table ) : array|bool
	{
		$forms = $this->obj->get_forms_by_table( $table );
		if( FALSE !== $forms )
		{
			$this->success( 'forms_by_table_fetched' );
			return $forms;
		}

		$this->fail( 'forms_by_table_failed' );
		return FALSE;
	}
}
