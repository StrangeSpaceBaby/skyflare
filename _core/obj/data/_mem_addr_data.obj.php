<?php

class _mem_addr_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_mem_addr_id" => "int",
			"_mem_addr_new" => "timestamp",
			"_mem_addr_edit" => "timestamp",
			"_mem_addr_del" => "timestamp",
			"_mem_addr_arch" => "timestamp",
			"_mem_addr_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk__state_id" => "int",
			"fk__country_id" => "int",
			"fk__cat_addr_id" => "int",
			"_mem_addr_street" => "varchar",
			"_mem_addr_street_two" => "varchar",
			"_mem_addr_apt_name" => "varchar",
			"_mem_addr_city" => "varchar",
			"_mem_addr_postal" => "varchar",
			"_mem_addr_owned" => "tinyint",
			"_mem_addr_rented" => "tinyint",
			"_mem_addr_start" => "date",
			"_mem_addr_end" => "date",
			"_mem_addr_current" => "tinyint",
			"_mem_addr_renewal" => "date",
			"_mem_addr_duration" => "smallint",
			"_mem_addr_homeless" => "tinyint",
			"_mem_addr_protect" => "tinyint",
			"_mem_addr_ulid" => "char"
		];

		$this->select_cols = [
						"_mem_addr_id" => "int",
			"_mem_addr_new" => "timestamp",
			"_mem_addr_edit" => "timestamp",
			"_mem_addr_active" => "tinyint",
			"_mem_addr.fk__mem_id" => "int",
			"_mem_addr.fk__state_id" => "int",
			"_mem_addr.fk__country_id" => "int",
			"_mem_addr.fk__cat_addr_id" => "int",
			"_mem_addr_street" => "varchar",
			"_mem_addr_street_two" => "varchar",
			"_mem_addr_apt_name" => "varchar",
			"_mem_addr_city" => "varchar",
			"_mem_addr_postal" => "varchar",
			"_mem_addr_owned" => "tinyint",
			"_mem_addr_rented" => "tinyint",
			"_mem_addr_start" => "date",
			"_mem_addr_end" => "date",
			"_mem_addr_current" => "tinyint",
			"_mem_addr_renewal" => "date",
			"_mem_addr_duration" => "smallint",
			"_mem_addr_homeless" => "tinyint",
			"_mem_addr_protect" => "tinyint",
			"_mem_addr_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_state_data.obj.php' );
		$o__state_data = new _state_data();
		if( $o__state_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__state_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_country_data.obj.php' );
		$o__country_data = new _country_data();
		if( $o__country_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__country_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_cat_addr_data.obj.php' );
		$o__cat_addr_data = new _cat_addr_data();
		if( $o__cat_addr_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__cat_addr_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__state_id' =>
			[
				'table' => '_state',
				'join_as' => '_state'
			],
			'fk__country_id' =>
			[
				'table' => '_country',
				'join_as' => '_country'
			],
			'fk__cat_addr_id' =>
			[
				'table' => '_cat_addr',
				'join_as' => '_cat_addr'
			]
		];
	}
}
