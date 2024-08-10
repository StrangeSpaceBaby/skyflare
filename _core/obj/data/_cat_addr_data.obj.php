<?php

class _cat_addr_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_cat_addr_id" => "int",
			"_cat_addr_new" => "timestamp",
			"_cat_addr_edit" => "timestamp",
			"_cat_addr_del" => "timestamp",
			"_cat_addr_arch" => "timestamp",
			"_cat_addr_active" => "tinyint",
			"_cat_addr_order" => "smallint",
			"_cat_addr_name" => "varchar",
			"_cat_addr_ulid" => "char"
		];

		$this->select_cols = [
						"_cat_addr_id" => "int",
			"_cat_addr_new" => "timestamp",
			"_cat_addr_edit" => "timestamp",
			"_cat_addr_active" => "tinyint",
			"_cat_addr_order" => "smallint",
			"_cat_addr_name" => "varchar",
			"_cat_addr_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
