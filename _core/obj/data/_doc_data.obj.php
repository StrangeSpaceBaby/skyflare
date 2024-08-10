<?php

class _doc_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_doc_id" => "int",
			"_doc_new" => "timestamp",
			"_doc_edit" => "timestamp",
			"_doc_del" => "timestamp",
			"_doc_arch" => "timestamp",
			"_doc_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk_uploader__mem_id" => "int",
			"_doc_name" => "varchar",
			"_doc_orig_name" => "varchar",
			"_doc_type" => "varchar",
			"_doc_size" => "int",
			"_doc_s3_loc" => "varchar",
			"_doc_hash" => "varchar",
			"_doc_ulid" => "char"
		];

		$this->select_cols = [
						"_doc_id" => "int",
			"_doc_new" => "timestamp",
			"_doc_edit" => "timestamp",
			"_doc_active" => "tinyint",
			"_doc.fk__mem_id" => "int",
			"_doc.fk_uploader__mem_id" => "int",
			"_doc_name" => "varchar",
			"_doc_orig_name" => "varchar",
			"_doc_type" => "varchar",
			"_doc_size" => "int",
			"_doc_s3_loc" => "varchar",
			"_doc_hash" => "varchar",
			"_doc_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_APP . 'uploader__mem_data.obj.php' );
		$o_uploader__mem_data = new uploader__mem_data();
		if( $o_uploader__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o_uploader__mem_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			]
		];
	}
}
