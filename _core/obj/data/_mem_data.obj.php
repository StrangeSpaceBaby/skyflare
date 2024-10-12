<?php

/**
 *	_mem_data auto-generated
 */

class _mem_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
			"_mem_id" => "int",
			"_mem_new" => "timestamp",
			"_mem_edit" => "timestamp",
			"_mem_del" => "timestamp",
			"_mem_arch" => "timestamp",
			"_mem_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__doc_id" => "int",
			"_mem_code" => "varchar",
			"_mem_fname" => "varchar",
			"_mem_mname" => "varchar",
			"_mem_lname" => "varchar",
			"_mem_name" => "varchar",
			"_mem_dob" => "date",
			"_mem_email" => "varchar",
			"_mem_email_verified" => "tinyint",
			"_mem_configured" => "tinyint",
			"_mem_ulid" => "char"
		];

		$this->select_cols = [
			"_mem_id" => "int",
			"_mem_new" => "timestamp",
			"_mem_edit" => "timestamp",
			"_mem_active" => "tinyint",
			"_mem.fk__doc_id" => "int",
			"_mem_code" => "varchar",
			"_mem_fname" => "varchar",
			"_mem_mname" => "varchar",
			"_mem_lname" => "varchar",
			"_mem_name" => "varchar",
			"_mem_dob" => "date",
			"_mem_email" => "varchar",
			"_mem_email_verified" => "tinyint",
			"_mem_configured" => "tinyint",
			"_mem_ulid" => "char"
		];

		$this->full_join = [
			'fk__doc_id' =>
			[
				'table' => '_doc',
				'join_as' => '_doc'
			],
		];
	}
}
