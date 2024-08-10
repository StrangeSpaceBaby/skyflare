<?php

class _notif_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_notif_id" => "int",
			"_notif_new" => "timestamp",
			"_notif_edit" => "timestamp",
			"_notif_del" => "timestamp",
			"_notif_arch" => "timestamp",
			"_notif_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"_notif_text" => "text",
			"_notif_ulid" => "char"
		];

		$this->select_cols = [
						"_notif_id" => "int",
			"_notif_new" => "timestamp",
			"_notif_edit" => "timestamp",
			"_notif_active" => "tinyint",
			"_notif.fk__mem_id" => "int",
			"_notif_text" => "text",
			"_notif_ulid" => "char"
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
