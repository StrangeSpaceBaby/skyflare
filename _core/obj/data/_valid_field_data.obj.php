<?php

/**
 *	_valid_field_data auto-generated
 */

class _valid_field_data extends _obj_data
{
public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_valid_field_id" => "int",
			"_valid_field_new" => "timestamp",
			"_valid_field_edit" => "timestamp",
			"_valid_field_del" => "timestamp",
			"_valid_field_arch" => "timestamp",
			"_valid_field_active" => "tinyint",
			"fk__valid_form_id" => "int",
			"_valid_field_name" => "varchar",
			"_valid_field_input_id" => "varchar",
			"_valid_field_type" => "varchar",
			"_valid_field_required" => "tinyint",
			"_valid_field_src" => "varchar",
			"_valid_field_mask" => "varchar",
			"_valid_field_default_value" => "varchar",
			"_valid_field_min" => "varchar",
			"_valid_field_max" => "varchar",
			"_valid_field_format" => "varchar",
			"_valid_field_if_value" => "varchar",

		];

		$this->select_cols = [
			"_valid_field_id" => "int",
			"_valid_field_new" => "timestamp",
			"_valid_field_edit" => "timestamp",
			"_valid_field_active" => "tinyint",
			"fk__valid_form_id" => "int",
			"_valid_field_name" => "varchar",
			"_valid_field_input_id" => "varchar",
			"_valid_field_type" => "varchar",
			"_valid_field_required" => "tinyint",
			"_valid_field_src" => "varchar",
			"_valid_field_mask" => "varchar",
			"_valid_field_default_value" => "varchar",
			"_valid_field_min" => "varchar",
			"_valid_field_max" => "varchar",
			"_valid_field_format" => "varchar",
			"_valid_field_if_value" => "varchar",

		];

		$this->full_join = [
			'fk__valid_form_id' =>
			[
				'table' => '_valid_form',
				'join_as' => '_valid_form'
			]
		];
	}
}
