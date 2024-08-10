<?php

class _lang_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_lang_id" => "int",
			"_lang_new" => "timestamp",
			"_lang_edit" => "timestamp",
			"_lang_del" => "timestamp",
			"_lang_arch" => "timestamp",
			"_lang_active" => "tinyint",
			"_lang_order" => "smallint",
			"_lang_name" => "varchar",
			"_lang_code" => "varchar",
			"_lang_default" => "tinyint",
			"_lang_system" => "tinyint",
			"_lang_ulid" => "char"
		];

		$this->select_cols = [
						"_lang_id" => "int",
			"_lang_new" => "timestamp",
			"_lang_edit" => "timestamp",
			"_lang_active" => "tinyint",
			"_lang_order" => "smallint",
			"_lang_name" => "varchar",
			"_lang_code" => "varchar",
			"_lang_default" => "tinyint",
			"_lang_system" => "tinyint",
			"_lang_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
