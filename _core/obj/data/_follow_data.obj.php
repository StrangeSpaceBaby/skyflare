<?php

class _follow_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_follow_id" => "int",
			"_follow_new" => "timestamp",
			"_follow_edit" => "timestamp",
			"_follow_del" => "timestamp",
			"_follow_arch" => "timestamp",
			"_follow_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"_follow_obj" => "varchar",
			"_follow_obj_id" => "int",
			"_follow_ulid" => "char"
		];

		$this->select_cols = [
						"_follow_id" => "int",
			"_follow_new" => "timestamp",
			"_follow_edit" => "timestamp",
			"_follow_active" => "tinyint",
			"_follow.fk__mem_id" => "int",
			"_follow_obj" => "varchar",
			"_follow_obj_id" => "int",
			"_follow_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			]
		];
	}
}
