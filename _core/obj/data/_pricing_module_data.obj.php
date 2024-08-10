<?php

class _pricing_module_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_pricing_module_id" => "int",
			"_pricing_module_new" => "timestamp",
			"_pricing_module_edit" => "timestamp",
			"_pricing_module_del" => "timestamp",
			"_pricing_module_arch" => "timestamp",
			"_pricing_module_active" => "tinyint",
			"fk__pricing_id" => "int",
			"fk__module_id" => "int",
			"_pricing_module_included" => "tinyint",
			"_pricing_module_price_mth" => "decimal",
			"_pricing_module_price_yr" => "decimal",
			"_pricing_module_price_qtr" => "decimal",
			"_pricing_module_ulid" => "char"
		];

		$this->select_cols = [
						"_pricing_module_id" => "int",
			"_pricing_module_new" => "timestamp",
			"_pricing_module_edit" => "timestamp",
			"_pricing_module_active" => "tinyint",
			"_pricing_module.fk__pricing_id" => "int",
			"_pricing_module.fk__module_id" => "int",
			"_pricing_module_included" => "tinyint",
			"_pricing_module_price_mth" => "decimal",
			"_pricing_module_price_yr" => "decimal",
			"_pricing_module_price_qtr" => "decimal",
			"_pricing_module_ulid" => "char"
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
			]
		];
	}
}
