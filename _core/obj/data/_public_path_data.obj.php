<?php

/**
 *	_public_path_data auto-generated
 */

class _public_path_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_public_path_id" => "int",
			"_public_path_new" => "timestamp",
			"_public_path_edit" => "timestamp",
			"_public_path_del" => "timestamp",
			"_public_path_arch" => "timestamp",
			"_public_path_active" => "tinyint",
			"_public_path" => "varchar",

		];

		$this->select_cols = [
			"_public_path_id" => "int",
			"_public_path_new" => "timestamp",
			"_public_path_edit" => "timestamp",
			"_public_path_active" => "tinyint",
			"_public_path" => "varchar",

		];

		$this->full_join = [

		];
	}
}
