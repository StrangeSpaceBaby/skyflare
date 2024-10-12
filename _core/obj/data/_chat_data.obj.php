<?php

class _chat_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_chat_id" => "int",
			"_chat_new" => "timestamp",
			"_chat_edit" => "timestamp",
			"_chat_del" => "timestamp",
			"_chat_arch" => "timestamp",
			"_chat_active" => "tinyint",
			"fk__co_id" => "int",
			"_chat_ulid" => "char"
		];

		$this->select_cols = [
						"_chat_id" => "int",
			"_chat_new" => "timestamp",
			"_chat_edit" => "timestamp",
			"_chat_active" => "tinyint",
			"_chat_ulid" => "char"
		];

		

		$this->full_join = [
			
		];
	}
}
