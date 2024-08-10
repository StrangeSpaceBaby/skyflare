<?php

class _cal_item_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_cal_item_id" => "int",
			"_cal_item_new" => "timestamp",
			"_cal_item_edit" => "timestamp",
			"_cal_item_del" => "timestamp",
			"_cal_item_arch" => "timestamp",
			"_cal_item_active" => "tinyint",
			"fk__co_id" => "int",
			"_cal_item_name" => "varchar",
			"_cal_item_ulid" => "char"
		];

		$this->select_cols = [
						"_cal_item_id" => "int",
			"_cal_item_new" => "timestamp",
			"_cal_item_edit" => "timestamp",
			"_cal_item_active" => "tinyint",
			"_cal_item_name" => "varchar",
			"_cal_item_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
