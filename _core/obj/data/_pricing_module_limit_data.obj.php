<?php

class _pricing_module_limit_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_pricing_module_limit_id" => "int",
			"_pricing_module_limit_new" => "timestamp",
			"_pricing_module_limit_edit" => "timestamp",
			"_pricing_module_limit_del" => "timestamp",
			"_pricing_module_limit_arch" => "timestamp",
			"_pricing_module_limit_active" => "tinyint",
			"fk__pricing_id" => "int",
			"fk__module_id" => "int",
			"fk__pricing_module_id" => "int",
			"_pricing_module_limit_unit_name" => "varchar",
			"_pricing_module_limit_key" => "varchar",
			"_pricing_module_limit_count_max" => "int",
			"_pricing_module_limit_free_count" => "int",
			"_pricing_module_limit_price_per" => "decimal",
			"_pricing_module_limit_ulid" => "char"
		];

		$this->select_cols = [
						"_pricing_module_limit_id" => "int",
			"_pricing_module_limit_new" => "timestamp",
			"_pricing_module_limit_edit" => "timestamp",
			"_pricing_module_limit_active" => "tinyint",
			"_pricing_module_limit.fk__pricing_id" => "int",
			"_pricing_module_limit.fk__module_id" => "int",
			"_pricing_module_limit.fk__pricing_module_id" => "int",
			"_pricing_module_limit_unit_name" => "varchar",
			"_pricing_module_limit_key" => "varchar",
			"_pricing_module_limit_count_max" => "int",
			"_pricing_module_limit_free_count" => "int",
			"_pricing_module_limit_price_per" => "decimal",
			"_pricing_module_limit_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_pricing_data.obj.php' );
		$o__pricing_data = new _pricing_data();
		if( $o__pricing_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__pricing_data->select_cols( 'array' ) );
		}

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
						'fk__pricing_id' =>
			[
				'table' => '_pricing',
				'join_as' => '_pricing'
			],
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
