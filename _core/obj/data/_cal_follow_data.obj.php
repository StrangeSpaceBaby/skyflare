<?php

class _cal_follow_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_cal_follow_id" => "int",
			"_cal_follow_new" => "timestamp",
			"_cal_follow_edit" => "timestamp",
			"_cal_follow_del" => "timestamp",
			"_cal_follow_arch" => "timestamp",
			"_cal_follow_active" => "tinyint",
			"fk__co_id" => "int",
			"_cal_follow_name" => "varchar",
			"_cal_follow_ulid" => "char"
		];

		$this->select_cols = [
						"_cal_follow_id" => "int",
			"_cal_follow_new" => "timestamp",
			"_cal_follow_edit" => "timestamp",
			"_cal_follow_active" => "tinyint",
			"_cal_follow_name" => "varchar",
			"_cal_follow_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
