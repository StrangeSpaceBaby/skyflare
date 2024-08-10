<?php

class _cat_phone_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_cat_phone_id" => "int",
			"_cat_phone_new" => "timestamp",
			"_cat_phone_edit" => "timestamp",
			"_cat_phone_del" => "timestamp",
			"_cat_phone_arch" => "timestamp",
			"_cat_phone_active" => "tinyint",
			"_cat_phone_order" => "smallint",
			"_cat_phone_name" => "varchar",
			"_cat_phone_ulid" => "char"
		];

		$this->select_cols = [
						"_cat_phone_id" => "int",
			"_cat_phone_new" => "timestamp",
			"_cat_phone_edit" => "timestamp",
			"_cat_phone_active" => "tinyint",
			"_cat_phone_order" => "smallint",
			"_cat_phone_name" => "varchar",
			"_cat_phone_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
