<?php

/**
 *	_task_data auto-generated
 */

class _task_data extends _obj_data
{
	public function __construct()
	{
		$this->cols = [
			"_task_id" => "int",
			"_task_new" => "timestamp",
			"_task_edit" => "timestamp",
			"_task_del" => "timestamp",
			"_task_arch" => "timestamp",
			"_task_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk_task_completer_id" => "int",
			"_task_due_date" => "date",
			"_task_name" => "varchar",
			"_task_desc" => "mediumtext",
			"_task_obj" => "varchar",
			"_task_obj_id" => "int",
			"_task_required" => "tinyint",
			"_task_completion_date" => "date",
			"_task_status" => "tinyint",
			"_task_private" => "tinyint",

		];

		$this->select_cols = [
			"_task_id" => "int",
			"_task_new" => "timestamp",
			"_task_edit" => "timestamp",
			"_task_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk_task_completer_id" => "int",
			"_task_due_date" => "date",
			"_task_name" => "varchar",
			"_task_desc" => "mediumtext",
			"_task_obj" => "varchar",
			"_task_obj_id" => "int",
			"_task_required" => "tinyint",
			"_task_completion_date" => "date",
			"_task_status" => "tinyint",
			"_task_private" => "tinyint",

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
