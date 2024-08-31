<?php

class _sub_plan_metric_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct( '_sub_plan_metric' );
		$this->log_chan( '_sub_plan_metric_data' );

		$this->cols = [
						"_sub_plan_metric_id" => "int",
			"_sub_plan_metric_new" => "timestamp",
			"_sub_plan_metric_edit" => "timestamp",
			"_sub_plan_metric_del" => "timestamp",
			"_sub_plan_metric_arch" => "timestamp",
			"_sub_plan_metric_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__sub_plan_id" => "int",
			"_sub_plan_metric_is_one_time" => "tinyint",
			"_sub_plan_metric_extra_price" => "decimal",
			"_sub_plan_metric_extra_qty" => "smallint",
			"_sub_plan_metric_units_incl" => "smallint",
			"_sub_plan_metric_unit" => "varchar",
			"_sub_plan_metric_ulid" => "char"
		];

		$this->select_cols = [
						"_sub_plan_metric_id" => "int",
			"_sub_plan_metric_new" => "timestamp",
			"_sub_plan_metric_edit" => "timestamp",
			"_sub_plan_metric_active" => "tinyint",
			"_sub_plan_metric.fk__sub_plan_id" => "int",
			"_sub_plan_metric_is_one_time" => "tinyint",
			"_sub_plan_metric_extra_price" => "decimal",
			"_sub_plan_metric_extra_qty" => "smallint",
			"_sub_plan_metric_units_incl" => "smallint",
			"_sub_plan_metric_unit" => "varchar",
			"_sub_plan_metric_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_sub_plan_data.obj.php' );
		$o__sub_plan_data = new _sub_plan_data();
		if( $o__sub_plan_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__sub_plan_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__sub_plan_id' =>
			[
				'table' => '_sub_plan',
				'join_as' => '_sub_plan'
			]
		];
	}
}
