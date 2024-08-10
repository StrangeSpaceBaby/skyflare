<?php

class _co_pricing_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_co_pricing_id" => "int",
			"_co_pricing_new" => "timestamp",
			"_co_pricing_edit" => "timestamp",
			"_co_pricing_del" => "timestamp",
			"_co_pricing_arch" => "timestamp",
			"_co_pricing_active" => "tinyint",
			"fk__co_id" => "int",
			"_co_pricing_price" => "decimal",
			"_co_pricing_cadence" => "int",
			"_co_pricing_next_bill_date" => "timestamp",
			"_co_pricing_next_bill_amt" => "decimal",
			"_co_pricing_ulid" => "char"
		];

		$this->select_cols = [
						"_co_pricing_id" => "int",
			"_co_pricing_new" => "timestamp",
			"_co_pricing_edit" => "timestamp",
			"_co_pricing_active" => "tinyint",
			"_co_pricing_price" => "decimal",
			"_co_pricing_cadence" => "int",
			"_co_pricing_next_bill_date" => "timestamp",
			"_co_pricing_next_bill_amt" => "decimal",
			"_co_pricing_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
