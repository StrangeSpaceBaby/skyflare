<?php

class _notif_signal_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_notif_signal_id" => "int",
			"_notif_signal_new" => "timestamp",
			"_notif_signal_edit" => "timestamp",
			"_notif_signal_del" => "timestamp",
			"_notif_signal_arch" => "timestamp",
			"_notif_signal_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__signal_id" => "int",
			"fk__notif_id" => "int",
			"_notif_signal_ulid" => "char"
		];

		$this->select_cols = [
						"_notif_signal_id" => "int",
			"_notif_signal_new" => "timestamp",
			"_notif_signal_edit" => "timestamp",
			"_notif_signal_active" => "tinyint",
			"_notif_signal.fk__signal_id" => "int",
			"_notif_signal.fk__notif_id" => "int",
			"_notif_signal_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_signal_data.obj.php' );
		$o__signal_data = new _signal_data();
		if( $o__signal_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__signal_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_notif_data.obj.php' );
		$o__notif_data = new _notif_data();
		if( $o__notif_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__notif_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__notif_id' =>
			[
				'table' => '_notif',
				'join_as' => '_notif'
			]
		];
	}
}
