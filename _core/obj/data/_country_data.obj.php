<?php

class _country_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_country_id" => "int",
			"_country_new" => "timestamp",
			"_country_edit" => "timestamp",
			"_country_del" => "timestamp",
			"_country_arch" => "timestamp",
			"_country_active" => "tinyint",
			"_country_name" => "varchar",
			"_country_abbrev" => "char",
			"_country_display_order" => "smallint",
			"_country_ulid" => "char"
		];

		$this->select_cols = [
						"_country_id" => "int",
			"_country_new" => "timestamp",
			"_country_edit" => "timestamp",
			"_country_active" => "tinyint",
			"_country_name" => "varchar",
			"_country_abbrev" => "char",
			"_country_display_order" => "smallint",
			"_country_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
