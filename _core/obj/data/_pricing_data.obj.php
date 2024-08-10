<?php

class _pricing_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_pricing_id" => "int",
			"_pricing_new" => "timestamp",
			"_pricing_edit" => "timestamp",
			"_pricing_del" => "timestamp",
			"_pricing_arch" => "timestamp",
			"_pricing_active" => "tinyint",
			"_pricing_price_mth" => "decimal",
			"_pricing_price_yr" => "decimal",
			"_pricing_price_qtr" => "decimal",
			"_pricing_free_trial" => "tinyint",
			"_pricing_free_trial_days" => "smallint",
			"_pricing_name" => "varchar",
			"_pricing_desc" => "text",
			"_pricing_ulid" => "char"
		];

		$this->select_cols = [
						"_pricing_id" => "int",
			"_pricing_new" => "timestamp",
			"_pricing_edit" => "timestamp",
			"_pricing_active" => "tinyint",
			"_pricing_price_mth" => "decimal",
			"_pricing_price_yr" => "decimal",
			"_pricing_price_qtr" => "decimal",
			"_pricing_free_trial" => "tinyint",
			"_pricing_free_trial_days" => "smallint",
			"_pricing_name" => "varchar",
			"_pricing_desc" => "text",
			"_pricing_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
