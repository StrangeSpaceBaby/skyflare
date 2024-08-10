<?php

class _workflow__mem_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_workflow__mem_id" => "int",
			"_workflow__mem_new" => "timestamp",
			"_workflow__mem_edit" => "timestamp",
			"_workflow__mem_del" => "timestamp",
			"_workflow__mem_arch" => "timestamp",
			"_workflow__mem_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk__workflow_id" => "int",
			"fk__workflow_step_id" => "int",
			"_workflow__mem_success" => "tinyint",
			"_workflow__mem_fail" => "tinyint",
			"_workflow__mem_done" => "tinyint",
			"_workflow__mem_ulid" => "char"
		];

		$this->select_cols = [
						"_workflow__mem_id" => "int",
			"_workflow__mem_new" => "timestamp",
			"_workflow__mem_edit" => "timestamp",
			"_workflow__mem_active" => "tinyint",
			"_workflow__mem.fk__mem_id" => "int",
			"_workflow__mem.fk__workflow_id" => "int",
			"_workflow__mem.fk__workflow_step_id" => "int",
			"_workflow__mem_success" => "tinyint",
			"_workflow__mem_fail" => "tinyint",
			"_workflow__mem_done" => "tinyint",
			"_workflow__mem_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_workflow_data.obj.php' );
		$o__workflow_data = new _workflow_data();
		if( $o__workflow_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__workflow_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_workflow_step_data.obj.php' );
		$o__workflow_step_data = new _workflow_step_data();
		if( $o__workflow_step_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__workflow_step_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__workflow_id' =>
			[
				'table' => '_workflow',
				'join_as' => '_workflow'
			],
			'fk__workflow_step_id' =>
			[
				'table' => '_workflow_step',
				'join_as' => '_workflow_step'
			]
		];
	}
}
