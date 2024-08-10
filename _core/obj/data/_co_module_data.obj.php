<?php

class _co_module_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_co_module_id" => "int",
			"_co_module_new" => "timestamp",
			"_co_module_edit" => "timestamp",
			"_co_module_del" => "timestamp",
			"_co_module_arch" => "timestamp",
			"_co_module_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__module_id" => "int",
			"fk__pricing_module_id" => "int",
			"_co_module_ulid" => "char"
		];

		$this->select_cols = [
						"_co_module_id" => "int",
			"_co_module_new" => "timestamp",
			"_co_module_edit" => "timestamp",
			"_co_module_active" => "tinyint",
			"_co_module.fk__module_id" => "int",
			"_co_module.fk__pricing_module_id" => "int",
			"_co_module_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_module_data.obj.php' );
		$o__module_data = new _module_data();
		if( $o__module_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__module_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_pricing_module_data.obj.php' );
		$o__pricing_module_data = new _pricing_module_data();
		if( $o__pricing_module_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__pricing_module_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__module_id' =>
			[
				'table' => '_module',
				'join_as' => '_module'
			],
			'fk__pricing_module_id' =>
			[
				'table' => '_pricing_module',
				'join_as' => '_pricing_module'
			]
		];
	}
}
