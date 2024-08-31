<?php

class _workflow_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_workflow_id" => "int",
			"_workflow_new" => "timestamp",
			"_workflow_edit" => "timestamp",
			"_workflow_del" => "timestamp",
			"_workflow_arch" => "timestamp",
			"_workflow_active" => "tinyint",
			"fk__co_id" => "int",
			"_workflow_display_order" => "tinyint",
			"_workflow_name" => "varchar",
			"_workflow_desc" => "varchar",
			"_workflow_ulid" => "char"
		];

		$this->select_cols = [
						"_workflow_id" => "int",
			"_workflow_new" => "timestamp",
			"_workflow_edit" => "timestamp",
			"_workflow_active" => "tinyint",
			"_workflow_display_order" => "tinyint",
			"_workflow_name" => "varchar",
			"_workflow_desc" => "varchar",
			"_workflow_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
