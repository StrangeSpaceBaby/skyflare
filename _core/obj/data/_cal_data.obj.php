<?php

class _cal_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_cal_id" => "int",
			"_cal_new" => "timestamp",
			"_cal_edit" => "timestamp",
			"_cal_del" => "timestamp",
			"_cal_arch" => "timestamp",
			"_cal_active" => "tinyint",
			"fk__co_id" => "int",
			"_cal_name" => "varchar",
			"_cal_ulid" => "char"
		];

		$this->select_cols = [
						"_cal_id" => "int",
			"_cal_new" => "timestamp",
			"_cal_edit" => "timestamp",
			"_cal_active" => "tinyint",
			"_cal_name" => "varchar",
			"_cal_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
