<?php

class _role_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_role_id" => "int",
			"_role_new" => "timestamp",
			"_role_edit" => "timestamp",
			"_role_del" => "timestamp",
			"_role_arch" => "timestamp",
			"_role_active" => "tinyint",
			"fk__co_id" => "int",
			"_role_default" => "tinyint",
			"_role_name" => "varchar",
			"_role_desc" => "varchar",
			"_role_type" => "varchar",
			"_role_ulid" => "char"
		];

		$this->select_cols = [
						"_role_id" => "int",
			"_role_new" => "timestamp",
			"_role_edit" => "timestamp",
			"_role_active" => "tinyint",
			"_role_default" => "tinyint",
			"_role_name" => "varchar",
			"_role_desc" => "varchar",
			"_role_type" => "varchar",
			"_role_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
