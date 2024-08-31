<?php

/**
 *	_perm_data auto-generated
 */

class _perm_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_perm_id" => "int",
			"_perm_new" => "timestamp",
			"_perm_edit" => "timestamp",
			"_perm_del" => "timestamp",
			"_perm_arch" => "timestamp",
			"_perm_active" => "tinyint",
			"_perm_protected" => "tinyint",
			"_perm_role_type" => "varchar",
			"_perm_name" => "varchar",
			"_perm_path" => "varchar",
			"_perm_desc" => "varchar",

		];

		$this->select_cols = [
			"_perm_id" => "int",
			"_perm_new" => "timestamp",
			"_perm_edit" => "timestamp",
			"_perm_active" => "tinyint",
			"_perm_protected" => "tinyint",
			"_perm_role_type" => "varchar",
			"_perm_name" => "varchar",
			"_perm_path" => "varchar",
			"_perm_desc" => "varchar",

		];

		$this->full_join = [

		];
	}
}
