<?php

class _co_sub_plan_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct( '_co_sub_plan' );
		$this->log_chan( '_co_sub_plan_data' );

		$this->cols = [
						"_co_sub_plan_id" => "int",
			"_co_sub_plan_new" => "timestamp",
			"_co_sub_plan_edit" => "timestamp",
			"_co_sub_plan_del" => "timestamp",
			"_co_sub_plan_arch" => "timestamp",
			"_co_sub_plan_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__sub_plan_id" => "int",
			"_co_sub_plan_has_trial" => "tinyint",
			"_co_sub_plan_trial_end" => "date",
			"_co_sub_plan_total_price" => "decimal",
			"_co_sub_plan_date_last_bill" => "date",
			"_co_sub_plan_date_next_bill" => "date",
			"_co_sub_plan_ulid" => "char"
		];

		$this->select_cols = [
						"_co_sub_plan_id" => "int",
			"_co_sub_plan_new" => "timestamp",
			"_co_sub_plan_edit" => "timestamp",
			"_co_sub_plan_active" => "tinyint",
			"_co_sub_plan.fk__sub_plan_id" => "int",
			"_co_sub_plan_has_trial" => "tinyint",
			"_co_sub_plan_trial_end" => "date",
			"_co_sub_plan_total_price" => "decimal",
			"_co_sub_plan_date_last_bill" => "date",
			"_co_sub_plan_date_next_bill" => "date",
			"_co_sub_plan_ulid" => "char"
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
