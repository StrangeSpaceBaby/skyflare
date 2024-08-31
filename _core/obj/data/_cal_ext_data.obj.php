<?php

class _cal_ext_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_cal_ext_id" => "int",
			"_cal_ext_new" => "timestamp",
			"_cal_ext_edit" => "timestamp",
			"_cal_ext_del" => "timestamp",
			"_cal_ext_arch" => "timestamp",
			"_cal_ext_active" => "tinyint",
			"fk__co_id" => "int",
			"_cal_ext_name" => "varchar",
			"_cal_ext_ulid" => "char"
		];

		$this->select_cols = [
			"_cal_ext_id" => "int",
			"_cal_ext_new" => "timestamp",
			"_cal_ext_edit" => "timestamp",
			"_cal_ext_active" => "tinyint",
			"_cal_ext_name" => "varchar",
			"_cal_ext_ulid" => "char"
		];

		$this->full_join = [
			
		];
	}
}
