<?php

/**
 *	_perm_menu_item_data auto-generated
 */

class _perm_menu_item_data extends _obj_data
{
public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_perm_menu_item_id" => "int",
			"_perm_menu_item_new" => "timestamp",
			"_perm_menu_item_edit" => "timestamp",
			"_perm_menu_item_del" => "timestamp",
			"_perm_menu_item_arch" => "timestamp",
			"_perm_menu_item_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__perm_id" => "int",
			"fk__menu_item_id" => "int",
			"_perm_menu_item_disp_order" => "smallint",

		];

		$this->select_cols = [
			"_perm_menu_item_id" => "int",
			"_perm_menu_item_new" => "timestamp",
			"_perm_menu_item_edit" => "timestamp",
			"_perm_menu_item_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__perm_id" => "int",
			"fk__menu_item_id" => "int",
			"_perm_menu_item_disp_order" => "smallint",

		];

		$this->full_join = [
			'fk__perm_id' =>
			[
				'table' => '_perm',
				'join_as' => '_perm'
			],
			'fk__menu_item_id' =>
			[
				'table' => '_menu_item',
				'join_as' => '_menu_item'
			],

		];
	}
}
