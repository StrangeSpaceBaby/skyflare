<?php

class _workflow_step_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_workflow_step_id" => "int",
			"_workflow_step_new" => "timestamp",
			"_workflow_step_edit" => "timestamp",
			"_workflow_step_del" => "timestamp",
			"_workflow_step_arch" => "timestamp",
			"_workflow_step_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__workflow_id" => "int",
			"fk__workflow_step_success_id" => "int",
			"fk__workflow_step_fail_id" => "int",
			"fk__workflow_step_skip_id" => "int",
			"_workflow_step" => "smallint",
			"_workflow_step_can_skip" => "tinyint",
			"_workflow_step_is_final" => "tinyint",
			"_workflow_step_name" => "varchar",
			"_workflow_step_path" => "varchar",
			"_workflow_step_ulid" => "char"
		];

		$this->select_cols = [
						"_workflow_step_id" => "int",
			"_workflow_step_new" => "timestamp",
			"_workflow_step_edit" => "timestamp",
			"_workflow_step_active" => "tinyint",
			"_workflow_step.fk__workflow_id" => "int",
			"_workflow_step.fk__workflow_step_success_id" => "int",
			"_workflow_step.fk__workflow_step_fail_id" => "int",
			"_workflow_step.fk__workflow_step_skip_id" => "int",
			"_workflow_step" => "smallint",
			"_workflow_step_can_skip" => "tinyint",
			"_workflow_step_is_final" => "tinyint",
			"_workflow_step_name" => "varchar",
			"_workflow_step_path" => "varchar",
			"_workflow_step_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_workflow_data.obj.php' );
		$o__workflow_data = new _workflow_data();
		if( $o__workflow_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__workflow_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_workflow_step_success_data.obj.php' );
		$o__workflow_step_success_data = new _workflow_step_success_data();
		if( $o__workflow_step_success_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__workflow_step_success_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_workflow_step_fail_data.obj.php' );
		$o__workflow_step_fail_data = new _workflow_step_fail_data();
		if( $o__workflow_step_fail_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__workflow_step_fail_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_workflow_step_skip_data.obj.php' );
		$o__workflow_step_skip_data = new _workflow_step_skip_data();
		if( $o__workflow_step_skip_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__workflow_step_skip_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__workflow_id' =>
			[
				'table' => '_workflow',
				'join_as' => '_workflow'
			]
		];
	}
}
