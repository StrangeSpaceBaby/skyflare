<?php

class _mem_phone_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_mem_phone_id" => "int",
			"_mem_phone_new" => "timestamp",
			"_mem_phone_edit" => "timestamp",
			"_mem_phone_del" => "timestamp",
			"_mem_phone_arch" => "timestamp",
			"_mem_phone_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk__cat_phone_id" => "int",
			"_mem_phone_number" => "varchar",
			"_mem_phone_verified" => "tinyint",
			"_mem_phone_verify_code" => "varchar",
			"_mem_phone_ulid" => "char"
		];

		$this->select_cols = [
						"_mem_phone_id" => "int",
			"_mem_phone_new" => "timestamp",
			"_mem_phone_edit" => "timestamp",
			"_mem_phone_active" => "tinyint",
			"_mem_phone.fk__mem_id" => "int",
			"_mem_phone.fk__cat_phone_id" => "int",
			"_mem_phone_number" => "varchar",
			"_mem_phone_verified" => "tinyint",
			"_mem_phone_verify_code" => "varchar",
			"_mem_phone_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_cat_phone_data.obj.php' );
		$o__cat_phone_data = new _cat_phone_data();
		if( $o__cat_phone_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__cat_phone_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__cat_phone_id' =>
			[
				'table' => '_cat_phone',
				'join_as' => '_cat_phone'
			]
		];
	}
}
