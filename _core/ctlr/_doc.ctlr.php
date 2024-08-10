<?php

/**
 *	_doc_ctlr
 */

class _doc_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_doc' );
	}

	/**
	 * Lists all documents using get_by_col
	 *
	 * @param array $args Array of filters and options for return format
	 * @return array|boolean array of documents or FALSE on error
	 */
	public function list( array $args = [] ) : array|bool
	{
		$docs = $this->obj->get_by_col([], TRUE, FALSE,
		[
			'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk_uploader__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => 'uploader',
				'join_column' => '_mem_id'
			],
		]);

		if( FALSE === $docs )
		{
			$this->fail( 'docs_could_not_be_listed' );
			return FALSE;
		}

		$this->success( 'docs_listed' );
		return $docs;
	}

	/**
	 * Gets filters of all documents
	 *
	 * @deprecated 
	 * @see _doc_obj::list()
	 * @return array array of filters from documents such as uplaoders and subjects
	 */
	public function get_filters() : array
	{
		$filters = [];

		$docs = $this->obj->get_by_col( [], TRUE, TRUE,
		[
			'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk_uploader__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => 'uploader',
				'join_column' => '_mem_id'
			]
		], " _doc_id, _mem._mem_id, _mem._mem_code, _mem._mem_fname, _mem._mem_lname, uploader._mem_id AS uploader__mem_id, uploader._mem_code AS uploader__mem_code, uploader._mem_fname AS uploader__mem_fname, uploader._mem_lname AS uploader__mem_lname" );

		if( $docs )
		{
			foreach( $docs as $doc_id => $doc )
			{
				$filters['uploaders'][$doc['uploader__mem_id']] = [ '_mem_code' => $doc['uploader__mem_code'], '_mem_fname' => $doc['uploader__mem_fname'], '_mem_lname' => $doc['uploader__mem_lname'] ];
				$filters['subjects'][$doc['_mem_id']] = [ '_mem_code' => $doc['_mem_code'], '_mem_fname' => $doc['_mem_fname'], '_mem_lname' => $doc['_mem_lname'] ];
			}
		}

		$this->success( 'filters_created' );
		return $filters;
	}

	public function save() : bool
	{
		$_mem = new _mem();

		$this->obj->store([ 'filename' => $_mem->me( '_mem_ulid' ) . "/" . $_FILES['upload_file']['name'], 'file_path' => $_FILES['upload_file']['tmp_name'] ]);
		
		return TRUE;
	}
}
