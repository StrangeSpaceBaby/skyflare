<?php

class _module_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_module_id" => "int",
			"_module_new" => "timestamp",
			"_module_edit" => "timestamp",
			"_module_del" => "timestamp",
			"_module_arch" => "timestamp",
			"_module_active" => "tinyint",
			"_module_name" => "varchar",
			"_module_desc" => "varchar",
			"_module_type" => "varchar",
			"_module_default" => "tinyint",
			"_module_display_order" => "smallint",
			"_module_ulid" => "char"
		];

		$this->select_cols = [
						"_module_id" => "int",
			"_module_new" => "timestamp",
			"_module_edit" => "timestamp",
			"_module_active" => "tinyint",
			"_module_name" => "varchar",
			"_module_desc" => "varchar",
			"_module_type" => "varchar",
			"_module_default" => "tinyint",
			"_module_display_order" => "smallint",
			"_module_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
