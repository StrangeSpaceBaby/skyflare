<?php

/**
 *	_tag_data auto-generated
 */

class _tag_data extends _obj_data
{
public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_tag_id" => "int",
			"_tag_new" => "timestamp",
			"_tag_edit" => "timestamp",
			"_tag_del" => "timestamp",
			"_tag_arch" => "timestamp",
			"_tag_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"_tag" => "varchar",
			"_tag_obj" => "varchar",
			"_tag_obj_id" => "int",

		];

		$this->select_cols = [
			"_tag_id" => "int",
			"_tag_new" => "timestamp",
			"_tag_edit" => "timestamp",
			"_tag_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"_tag" => "varchar",
			"_tag_obj" => "varchar",
			"_tag_obj_id" => "int",

		];

		$this->full_join = [
			'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],

		];
	}
}
