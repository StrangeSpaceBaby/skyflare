<?php

/**
 *	_role_perm_data auto-generated
 */

class _role_perm_data extends _obj_data
{
public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_role_perm_id" => "int",
			"_role_perm_new" => "timestamp",
			"_role_perm_edit" => "timestamp",
			"_role_perm_del" => "timestamp",
			"_role_perm_arch" => "timestamp",
			"_role_perm_active" => "tinyint",
			"fk__role_id" => "int",
			"fk__perm_id" => "int",

		];

		$this->select_cols = [
			"_role_perm_id" => "int",
			"_role_perm_new" => "timestamp",
			"_role_perm_edit" => "timestamp",
			"_role_perm_del" => "timestamp",
			"_role_perm_arch" => "timestamp",
			"_role_perm_active" => "tinyint",
			"fk__role_id" => "int",
			"fk__perm_id" => "int",
			"_perm.*" => "array"
		];

		$this->full_join = [
			'fk__role_id' =>
			[
				'table' => '_role',
				'join_as' => '_role'
			],
			'fk__perm_id' =>
			[
				'table' => '_perm',
				'join_as' => '_perm'
			],

		];
	}
}
