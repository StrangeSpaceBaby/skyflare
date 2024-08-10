<?php

/**
 *	_signal_data auto-generated by awareness
 */

class _signal_data extends _obj_data
{
	public function __construct()
	{
		$this->cols = [
			"_signal_id" => "int",
			"_signal_new" => "timestamp",
			"_signal_edit" => "timestamp",
			"_signal_del" => "timestamp",
			"_signal_arch" => "timestamp",
			"_signal_active" => "tinyint",
			"_signal_configurable" => "tinyint",
			"_signal_channel" => "varchar",
			"_signal_flag" => "varchar",
			"_signal_name" => "varchar"
		];

		$this->select_cols = [
			"_signal_id" => "int",
			"_signal_new" => "timestamp",
			"_signal_edit" => "timestamp",
			"_signal_active" => "tinyint",
			"_signal_configurable" => "tinyint",
			"_signal_channel" => "varchar",
			"_signal_flag" => "varchar",
			"_signal_name" => "varchar"
		];



		$this->full_join = [

		];
	}
}
