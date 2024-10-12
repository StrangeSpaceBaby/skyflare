<?php

class _sub_plan_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct( '_sub_plan' );
		$this->log_chan( '_sub_plan_data' );

		$this->cols = [
						"_sub_plan_id" => "int",
			"_sub_plan_new" => "timestamp",
			"_sub_plan_edit" => "timestamp",
			"_sub_plan_del" => "timestamp",
			"_sub_plan_arch" => "timestamp",
			"_sub_plan_active" => "tinyint",
			"fk__co_id" => "int",
			"_sub_plan_has_trial" => "tinyint",
			"_sub_plan_trial_duration" => "int",
			"_sub_plan_mth_price" => "decimal",
			"_sub_plan_yr_price" => "decimal",
			"_sub_plan_name" => "varchar",
			"_sub_plan_desc" => "text",
			"_sub_plan_ulid" => "char"
		];

		$this->select_cols = [
						"_sub_plan_id" => "int",
			"_sub_plan_new" => "timestamp",
			"_sub_plan_edit" => "timestamp",
			"_sub_plan_active" => "tinyint",
			"_sub_plan_has_trial" => "tinyint",
			"_sub_plan_trial_duration" => "int",
			"_sub_plan_mth_price" => "decimal",
			"_sub_plan_yr_price" => "decimal",
			"_sub_plan_name" => "varchar",
			"_sub_plan_desc" => "text",
			"_sub_plan_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
