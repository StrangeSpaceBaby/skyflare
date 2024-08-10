<?php

class _log_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_log_id" => "int",
			"_log_new" => "timestamp",
			"_log_edit" => "timestamp",
			"_log_del" => "timestamp",
			"_log_arch" => "timestamp",
			"_log_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk__module_id" => "int",
			"_log_type" => "varchar",
			"_log_obj" => "varchar",
			"_log_obj_id" => "int",
			"_log_note" => "varchar",
			"_log_ulid" => "char"
		];

		$this->select_cols = [
						"_log_id" => "int",
			"_log_new" => "timestamp",
			"_log_edit" => "timestamp",
			"_log_active" => "tinyint",
			"_log.fk__mem_id" => "int",
			"_log.fk__module_id" => "int",
			"_log_type" => "varchar",
			"_log_obj" => "varchar",
			"_log_obj_id" => "int",
			"_log_note" => "varchar",
			"_log_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_module_data.obj.php' );
		$o__module_data = new _module_data();
		if( $o__module_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__module_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__module_id' =>
			[
				'table' => '_module',
				'join_as' => '_module'
			]
		];
	}
}
