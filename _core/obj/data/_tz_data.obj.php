<?php

/**
 *	_tz_data auto-generated
 */

class _tz_data extends _obj_data
{
	public function __construct()
	{
		$this->cols = [
			"_tz_id" => "int",
			"_tz_new" => "timestamp",
			"_tz_edit" => "timestamp",
			"_tz_del" => "timestamp",
			"_tz_arch" => "timestamp",
			"_tz_active" => "tinyint",
			"_tz_region" => "varchar",
			"_tz_city" => "varchar",
			"_tz_value" => "varchar",

		];

		$this->select_cols = [
			"_tz_id" => "int",
			"_tz_new" => "timestamp",
			"_tz_edit" => "timestamp",
			"_tz_active" => "tinyint",
			"_tz_region" => "varchar",
			"_tz_city" => "varchar",
			"_tz_value" => "varchar",

		];

		$this->full_join = [

		];
	}
}
