<?php

class _config_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_config_id" => "int",
			"_config_new" => "timestamp",
			"_config_edit" => "timestamp",
			"_config_del" => "timestamp",
			"_config_arch" => "timestamp",
			"_config_active" => "tinyint",
			"_config_name" => "varchar",
			"_config_desc" => "varchar",
			"_config_table" => "varchar",
			"_config_link" => "varchar",
			"_config_ulid" => "char"
		];

		$this->select_cols = [
						"_config_id" => "int",
			"_config_new" => "timestamp",
			"_config_edit" => "timestamp",
			"_config_active" => "tinyint",
			"_config_name" => "varchar",
			"_config_desc" => "varchar",
			"_config_table" => "varchar",
			"_config_link" => "varchar",
			"_config_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
