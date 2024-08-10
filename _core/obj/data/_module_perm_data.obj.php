<?php

class _module_perm_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		$this->cols = [
						"_module_perm_id" => "int",
			"_module_perm_new" => "datetime",
			"_module_perm_edit" => "datetime",
			"_module_perm_del" => "datetime",
			"_module_perm_arch" => "datetime",
			"_module_perm_active" => "tinyint",
			"fk__module_id" => "int",
			"fk__perm_id" => "int",
			"_module_perm_ulid" => "char"
		];

		$this->select_cols = [
						"_module_perm_id" => "int",
			"_module_perm_new" => "datetime",
			"_module_perm_edit" => "datetime",
			"_module_perm_active" => "tinyint",
			"_module_perm.fk__module_id" => "int",
			"_module_perm.fk__perm_id" => "int",
			"_module_perm_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_module_data.obj.php' );
		$o__module_data = new _module_data();
		if( $o__module_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__module_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_perm_data.obj.php' );
		$o__perm_data = new _perm_data();
		if( $o__perm_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__perm_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__module_id' =>
			[
				'table' => '_module',
				'join_as' => '_module'
			],
			'fk__perm_id' =>
			[
				'table' => '_perm',
				'join_as' => '_perm'
			]
		];
	}
}
