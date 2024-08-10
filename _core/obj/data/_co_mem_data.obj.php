<?php

/**
 *	_co_mem_data auto-generated
 */

class _co_mem_data extends _obj_data
{
	public function __construct()
	{
		$this->cols = [
			"_co_mem_id" => "int",
			"_co_mem_new" => "timestamp",
			"_co_mem_edit" => "timestamp",
			"_co_mem_del" => "timestamp",
			"_co_mem_arch" => "timestamp",
			"_co_mem_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk__role_id" => "int",
		];

		$this->select_cols = [
			"_co_mem_id" => "int",
			"_co_mem_new" => "timestamp",
			"_co_mem_edit" => "timestamp",
			"_co_mem_active" => "tinyint",
			"fk__mem_id" => "int",
			"fk__role_id" => "int",
		];

		$this->full_join = [
			'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__role_id' =>
			[
				'table' => '_role',
				'join_as' => '_role'
			],
		];
	}
}
