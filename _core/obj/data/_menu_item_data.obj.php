<?php

class _menu_item_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_menu_item_id" => "int",
			"_menu_item_new" => "timestamp",
			"_menu_item_edit" => "timestamp",
			"_menu_item_del" => "timestamp",
			"_menu_item_arch" => "timestamp",
			"_menu_item_active" => "tinyint",
			"fk__co_id" => "int",
			"_menu_item_name" => "varchar",
			"_menu_item_desc" => "varchar",
			"_menu_item_href" => "varchar",
			"_menu_item_click" => "varchar",
			"_menu_item_target" => "varchar",
			"_menu_item_toggle" => "varchar",
			"_menu_item_icon" => "varchar",
			"_menu_item_public" => "tinyint",
			"_menu_item_ulid" => "char"
		];

		$this->select_cols = [
						"_menu_item_id" => "int",
			"_menu_item_new" => "timestamp",
			"_menu_item_edit" => "timestamp",
			"_menu_item_active" => "tinyint",
			"_menu_item_name" => "varchar",
			"_menu_item_desc" => "varchar",
			"_menu_item_href" => "varchar",
			"_menu_item_click" => "varchar",
			"_menu_item_target" => "varchar",
			"_menu_item_toggle" => "varchar",
			"_menu_item_icon" => "varchar",
			"_menu_item_public" => "tinyint",
			"_menu_item_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
