<?php

/**
 *	_token_data auto-generated
 */

class _token_data extends _obj_data
{
public array $cols;
	public array $select_cols;
	public array $full_join;


	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_token_id" => "int",
			"_token_new" => "timestamp",
			"_token_edit" => "timestamp",
			"_token_del" => "timestamp",
			"_token_arch" => "timestamp",
			"_token_active" => "tinyint",
			"_token" => "varchar",

		];

		$this->select_cols = [
			"_token_id" => "int",
			"_token_new" => "timestamp",
			"_token_edit" => "timestamp",
			"_token_active" => "tinyint",
			"_token" => "varchar",

		];

		$this->full_join = [

		];
	}
}
