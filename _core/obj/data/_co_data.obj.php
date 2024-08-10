<?php

/**
 *	_co_data auto-generated
 */

class _co_data extends _obj_data
{
	public function __construct()
	{
		$this->cols = [
			"_co_id" => "int",
			"_co_new" => "timestamp",
			"_co_edit" => "timestamp",
			"_co_del" => "timestamp",
			"_co_arch" => "timestamp",
			"_co_active" => "tinyint",
			"fk__mem_id" => "int",
			"fk__pricing_id" => "int",
			"_co_name" => "varchar",
			"_co_domain" => "varchar",
			"_co_ulid" => "varchar",
			"_co_setup" => "tinyint",
			"_co_configured" => "tinyint",

		];

		$this->select_cols = [
			"_co_id" => "int",
			"_co_new" => "timestamp",
			"_co_edit" => "timestamp",
			"_co_active" => "tinyint",
			"fk__mem_id" => "int",
			"fk__pricing_id" => "int",
			"_co_name" => "varchar",
			"_co_domain" => "varchar",
			"_co_ulid" => "varchar",
			"_co_setup" => "tinyint",
			"_co_configured" => "tinyint",

		];

		$this->full_join = [
			'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__pricing_id' =>
			[
				'table' => '_pricing',
				'join_as' => '_pricing'
			],

		];
	}
}
