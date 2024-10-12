<?php

class _co_sub_metric_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct( '_co_sub_metric' );
		$this->log_chan( '_co_sub_metric_data' );

		$this->cols = [
						"_co_sub_metric_id" => "int",
			"_co_sub_metric_new" => "timestamp",
			"_co_sub_metric_edit" => "timestamp",
			"_co_sub_metric_del" => "timestamp",
			"_co_sub_metric_arch" => "timestamp",
			"_co_sub_metric_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__sub_plan_metric_id" => "int",
			"_co_sub_metric_count_curr" => "int",
			"_co_sub_metric_count_over" => "int",
			"_co_sub_metric_total_price" => "decimal",
			"_co_sub_metric_ulid" => "char"
		];

		$this->select_cols = [
						"_co_sub_metric_id" => "int",
			"_co_sub_metric_new" => "timestamp",
			"_co_sub_metric_edit" => "timestamp",
			"_co_sub_metric_active" => "tinyint",
			"_co_sub_metric.fk__sub_plan_metric_id" => "int",
			"_co_sub_metric_count_curr" => "int",
			"_co_sub_metric_count_over" => "int",
			"_co_sub_metric_total_price" => "decimal",
			"_co_sub_metric_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_sub_plan_metric_data.obj.php' );
		$o__sub_plan_metric_data = new _sub_plan_metric_data();
		if( $o__sub_plan_metric_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__sub_plan_metric_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__sub_plan_metric_id' =>
			[
				'table' => '_sub_plan_metric',
				'join_as' => '_sub_plan_metric'
			]
		];
	}
}
