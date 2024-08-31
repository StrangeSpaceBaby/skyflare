<?php

class _note_data extends _obj_data
{
	public array $cols;
	public array $select_cols;
	public array $full_join;

	public function __construct()
	{
		parent::__construct();

		$this->cols = [
						"_note_id" => "int",
			"_note_new" => "timestamp",
			"_note_edit" => "timestamp",
			"_note_del" => "timestamp",
			"_note_arch" => "timestamp",
			"_note_active" => "tinyint",
			"fk__co_id" => "int",
			"fk__mem_id" => "int",
			"fk__cat_note_id" => "int",
			"fk__note_id" => "int",
			"_note_edited" => "tinyint",
			"_note_effective_date" => "timestamp",
			"_note_text" => "mediumtext",
			"_note_obj" => "varchar",
			"_note_obj_id" => "int",
			"_note_ulid" => "char"
		];

		$this->select_cols = [
						"_note_id" => "int",
			"_note_new" => "timestamp",
			"_note_edit" => "timestamp",
			"_note_active" => "tinyint",
			"_note.fk__mem_id" => "int",
			"_note.fk__cat_note_id" => "int",
			"_note.fk__note_id" => "int",
			"_note_edited" => "tinyint",
			"_note_effective_date" => "timestamp",
			"_note_text" => "mediumtext",
			"_note_obj" => "varchar",
			"_note_obj_id" => "int",
			"_note_ulid" => "char"
		];

				require_once( OBJ_DATA_CORE . '_mem_data.obj.php' );
		$o__mem_data = new _mem_data();
		if( $o__mem_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__mem_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_cat_note_data.obj.php' );
		$o__cat_note_data = new _cat_note_data();
		if( $o__cat_note_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__cat_note_data->select_cols( 'array' ) );
		}

		require_once( OBJ_DATA_CORE . '_note_data.obj.php' );
		$o__note_data = new _note_data();
		if( $o__note_data->select_cols() )
		{
			$this->select_cols = array_merge( $this->select_cols, $o__note_data->select_cols( 'array' ) );
		}


		$this->full_join = [
						'fk__mem_id' =>
			[
				'table' => '_mem',
				'join_as' => '_mem'
			],
			'fk__cat_note_id' =>
			[
				'table' => '_cat_note',
				'join_as' => '_cat_note'
			],
			'fk__note_id' =>
			[
				'table' => '_note',
				'join_as' => '_note'
			]
		];
	}
}
