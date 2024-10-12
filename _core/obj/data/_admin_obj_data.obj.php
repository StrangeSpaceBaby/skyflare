<?php

class _admin_obj_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_admin_obj_id" => "int",
			"_admin_obj_new" => "timestamp",
			"_admin_obj_edit" => "timestamp",
			"_admin_obj_del" => "timestamp",
			"_admin_obj_arch" => "timestamp",
			"_admin_obj_active" => "tinyint",
			"_admin_obj_name" => "varchar",
			"_admin_obj_table" => "varchar",
			"_admin_obj_obj" => "tinyint",
			"_admin_obj_ctlr" => "tinyint",
			"_admin_obj_page" => "tinyint",
			"_admin_obj_perm" => "tinyint",
			"_admin_obj_role_perm" => "tinyint",
			"_admin_obj_save_modal" => "tinyint",
			"_admin_obj_valid_form" => "tinyint",
			"_admin_obj_ulid" => "char"
		];

		$this->select_cols = [
						"_admin_obj_id" => "int",
			"_admin_obj_new" => "timestamp",
			"_admin_obj_edit" => "timestamp",
			"_admin_obj_active" => "tinyint",
			"_admin_obj_name" => "varchar",
			"_admin_obj_table" => "varchar",
			"_admin_obj_obj" => "tinyint",
			"_admin_obj_ctlr" => "tinyint",
			"_admin_obj_page" => "tinyint",
			"_admin_obj_perm" => "tinyint",
			"_admin_obj_role_perm" => "tinyint",
			"_admin_obj_save_modal" => "tinyint",
			"_admin_obj_valid_form" => "tinyint",
			"_admin_obj_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
