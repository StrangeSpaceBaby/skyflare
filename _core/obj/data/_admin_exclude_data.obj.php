<?php

class _admin_exclude_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_admin_exclude_id" => "int",
			"_admin_exclude_new" => "timestamp",
			"_admin_exclude_edit" => "timestamp",
			"_admin_exclude_del" => "timestamp",
			"_admin_exclude_arch" => "timestamp",
			"_admin_exclude_active" => "tinyint",
			"fk__co_id" => "int",
			"_admin_exclude_type" => "varchar",
			"_admin_exclude_value" => "varchar",
			"_admin_exclude_ulid" => "char"
		];

		$this->select_cols = [
						"_admin_exclude_id" => "int",
			"_admin_exclude_new" => "timestamp",
			"_admin_exclude_edit" => "timestamp",
			"_admin_exclude_active" => "tinyint",
			"_admin_exclude_type" => "varchar",
			"_admin_exclude_value" => "varchar",
			"_admin_exclude_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
