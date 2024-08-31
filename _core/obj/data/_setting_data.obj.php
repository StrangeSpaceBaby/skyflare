<?php

/**
 *	_setting_data auto-generated
 */

class _setting_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_setting_id" => "int",
			"_setting_new" => "timestamp",
			"_setting_edit" => "timestamp",
			"_setting_del" => "timestamp",
			"_setting_arch" => "timestamp",
			"_setting_active" => "tinyint",
			"_setting_key" => "varchar",
			"_setting_value" => "varchar",

		];

		$this->select_cols = [
			"_setting_id" => "int",
			"_setting_new" => "timestamp",
			"_setting_edit" => "timestamp",
			"_setting_active" => "tinyint",
			"_setting_key" => "varchar",
			"_setting_value" => "varchar",

		];

		$this->full_join = [

		];
	}
}
