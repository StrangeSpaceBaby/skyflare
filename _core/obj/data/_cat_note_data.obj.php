<?php

class _cat_note_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_cat_note_id" => "int",
			"_cat_note_new" => "timestamp",
			"_cat_note_edit" => "timestamp",
			"_cat_note_del" => "timestamp",
			"_cat_note_arch" => "timestamp",
			"_cat_note_active" => "tinyint",
			"fk__co_id" => "int",
			"_cat_note_order" => "smallint",
			"_cat_note_name" => "varchar",
			"_cat_note_ulid" => "char"
		];

		$this->select_cols = [
						"_cat_note_id" => "int",
			"_cat_note_new" => "timestamp",
			"_cat_note_edit" => "timestamp",
			"_cat_note_active" => "tinyint",
			"_cat_note_order" => "smallint",
			"_cat_note_name" => "varchar",
			"_cat_note_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
