<?php

class _module__mem_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_module__mem_id" => "int",
			"_module__mem_new" => "timestamp",
			"_module__mem_edit" => "timestamp",
			"_module__mem_del" => "timestamp",
			"_module__mem_arch" => "timestamp",
			"_module__mem_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__module_id" => "int",
			"fk__mem_id" => "int",
			"fk__role_id" => "int",
			"_module__mem_uuid" => "char",
			"_module__mem_ulid" => "char"
		];

		$this->select_cols = [
						"_module__mem_id" => "int",
			"_module__mem_new" => "timestamp",
			"_module__mem_edit" => "timestamp",
			"_module__mem_active" => "tinyint",
			"_module__mem.fk__module_id" => "int",
			"_module__mem.fk__mem_id" => "int",
			"_module__mem.fk__role_id" => "int",
			"_module__mem_uuid" => "char",
			"_module__mem_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_module_data.obj.php' );
		$o__module_data = new _module_data();
		if( $o__module_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__module_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_role_data.obj.php' );
		$o__role_data = new _role_data();
		if( $o__role_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__role_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__module_id' =>
			[
				'table' => '_module',
				'join_as' => '_module'
			],
			'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__role_id' =>
			[
				'table' => '_role',
				'join_as' => '_role'
			]
		];
	}
}
