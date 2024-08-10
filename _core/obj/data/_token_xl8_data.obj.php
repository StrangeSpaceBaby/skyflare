<?php

/**
 *	_token_xl8_data auto-generated
 */

class _token_xl8_data extends _obj_data
{
	public function __construct()
	{
		$this->cols = [
			"_token_xl8_id" => "int",
			"_token_xl8_new" => "timestamp",
			"_token_xl8_edit" => "timestamp",
			"_token_xl8_del" => "timestamp",
			"_token_xl8_arch" => "timestamp",
			"_token_xl8_active" => "tinyint",
			"fk__token_id" => "int",
			"fk__lang_id" => "int",
			"_token_xl8" => "longtext",

		];

		$this->select_cols = [
			"_token_xl8_id" => "int",
			"_token_xl8_new" => "timestamp",
			"_token_xl8_edit" => "timestamp",
			"_token_xl8_active" => "tinyint",
			"fk__token_id" => "int",
			"fk__lang_id" => "int",
			"_token_xl8" => "longtext",

		];

		$this->full_join = [
			'fk__token_id' =>
			[
				'table' => '_token',
				'join_as' => '_token'
			],
			'fk__lang_id' =>
			[
				'table' => '_lang',
				'join_as' => '_lang'
			],

		];
	}
}
