<?php

class _admin extends _obj
{
	public function __construct()
	{
		parent::__construct( '_admin_obj' );
	}

	/**
	 * Creates table in database, ctlr and obj files, valid forms, sled files and data objects
	 *
	 * @param string $table name of table/entity to create
	 * @return boolean Always TRUE
	 */
	public function create_entity( string $table ) : bool
	{
		p( 'create table ' . $table );
		$q = "SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?";
		$sth = $this->query( $q, [ $_SERVER['DB_NAME'], $table ]);

		if( '00000' != $sth->errorCode() )
		{
			$this->fail( 'failed_to_confirm_table' );
			return FALSE;
		}

		$curr_table = $sth->fetch();
		if( !$curr_table )
		{
			p( 'creating table in db: ' . $table );
			$create_table_tpl = file_get_contents( ADMIN . "tpl/create_table.sql" );
			$create_table_sql = str_replace( '~~table~~', $table, $create_table_tpl );

			$sth = $this->query( $create_table_sql );

			if( '00000' != $sth->errorCode() )
			{
				$this->fail( 'table_not_created' );
				return FALSE;
			}
		}

		$obj = $this->get_by_col([ '_admin_obj_table' => $table ]);
		if( !$obj && FALSE !== $obj )
		{
			$obj_id = $this->save([ '_admin_obj_table' => $table, '_admin_obj_name' => $table ]);
			if( FALSE === $obj_id )
			{
				p( $this->get_error_msg() );
				exit;
			}

			$obj = $this->get_by_id( $obj_id );
			if( FALSE === $obj )
			{
				$this->fail( 'could not query _admin_obj_table' );
				return FALSE;
			}
		}

		p( 'calling create_obj_file' );
		$this->create_obj_file([ 'name' => $table, 'table' => $table ]);
		$obj['_admin_obj_obj'] = 1;
		$this->create_ctlr_file([ 'name' => $table, 'table' => $table ]);
		$obj['_admin_obj_ctlr'] = 1;

		$_perm = new _perm();
		$_role_perm = new _role_perm();

		$perm = $_perm->get_by_col([ '_perm_path' => '/' . $table ]);
		if( !$perm )
		{
			$perm_id = $_perm->save([ '_perm_path' => '/' . $table, '_perm_name' => '/' . $table ]);
			$perm = $_perm->get_by_id( $perm_id );
		}

		$perm_id = $perm['_perm_id'];
		$role_perm = $_role_perm->get_by_col([ 'fk__perm_id' => $perm_id, 'fk__role_id' => 1 ]); // 1 == super_admin

		$role_perm_id = $role_perm['_role_perm_id'];
		if( !$role_perm )
		{
			$role_perm_id = $_role_perm->save([ 'fk__perm_id' => $perm_id, 'fk__role_id' => 1 ]);
			$role_perm = $_role_perm->get_by_id( $role_perm_id );
		}

		$obj['_admin_obj_perm'] = 1;
		$obj['_admin_obj_role_perm'] = 1;

		$exclude_tables = [ '_auth_token', '_log', '_mem_auth', '_mem_reset' ];
		if( !in_array( $table, $exclude_tables ) )
		{
			$this->create_valid_form( $table, "save_" . $table . "_form" );
		}

		$obj['_admin_obj_valid_form'] = 1;

		$exclude_cruds = [ '_auth_token', '_mem_auth', '_mem_reset', '_country', '_state', '_tz' ];
		print "Crud files for $table\n";
		if( !in_array( $table, $exclude_cruds ) )
		{
			print 'creating' . "\n";
			$this->create_crud_files( $table );
		}

		$this->create_data_objects( $table );
		$obj['_admin_obj_page'] = 1;
		$obj['_admin_obj_save_modal'] = 1;

		$this->save( $obj );
		$this->success( 'table_created' );
		return TRUE;
	}

	/**
	 * Creates data object with table columns, select columns and full joins as well as fk_* relationships for select_cols
	 *
	 * @param string $table
	 * @return boolean Always TRUE
	 */
	public function create_data_objects( string $table ) : bool
	{
		$filename = OBJ_DATA_APP . $table . '_data.obj.php';
		if( $this->is_core( $table ) )
		{
			$filename = OBJ_DATA_CORE . $table. '_data.obj.php';
		}

		if( !file_exists( $filename ) )
		{
			$obj_tpl = file_get_contents( ADMIN . "tpl/obj.data.php" );
			print "\n\nOBJ DATA TPL: " . ADMIN . "tpl/obj.data.php" . "\n";

			$columns = $this->explain_table( $table, TRUE ); // force refresh of table definitions just in case
			if( !$columns )
			{
				$this->fail( 'no columns found for table ' . $table );
				return FALSE;
			}

			$cols = [];
			$select_cols = [];
			$full_join = [];
			$join_select_cols = [];

			$filters = [ 'fk__co_id', $table . '_arch', $table . '_del', $table . '_password' ];

			$tables = $this->get_tables();

			foreach( $columns as $column => $type )
			{
				$this_col = "\t\t\t\"" . $column . '" => "' . preg_replace( "/[^a-zA-Z]/", "", strtolower( $type ) ) . "\"";
				$cols[] = $this_col;
				if( !in_array( $column, $filters ) )
				{
					if( str_starts_with( $column, 'fk_' ) )
					{
						$this_col = "\t\t\t\"" . $table . "." . $column . '" => "' . preg_replace( "/[^a-zA-Z]/", "", strtolower( $type ) ) . "\"";
					}

					$select_cols[] = $this_col;
				}

				if( str_starts_with( $column, 'fk_' ) && str_ends_with( $column, '_id' )  && 'fk__co_id' != $column )
				{
					$fk_table = substr( $column, 3, -3 );
					if( in_array( $fk_table, $tables ))
					{
						$full_join[] = "\t\t\t'{$column}' =>\n\t\t\t[\n\t\t\t\t'table' => '{$fk_table}',\n\t\t\t\t'join_as' => '{$fk_table}'\n\t\t\t]";
					}

					$block = "";
					if( $this->is_core( $fk_table ) )
					{
						$block = "\t\trequire_once( OBJ_DATA_CORE . '{$fk_table}_data.obj.php' );\n";
					}
					else
					{
						$block = "\t\trequire_once( OBJ_DATA_APP . '{$fk_table}_data.obj.php' );\n";
					}

					$block .= "\t\t" . '$o_' . $fk_table . '_data = new ' . $fk_table . "_data();\n" .
					"\t\t" . 'if( $o_' . $fk_table . '_data->select_cols() )' .
					"\n\t\t{\n" .
						"\t\t\t" . '$this->select_cols = array_merge( $this->select_cols, $o_' . $fk_table . "_data->select_cols( 'array' ) );\n" .
					"\t\t}\n";

					$join_select_cols[] = $block;
				}
			}

			if( $fh = fopen( $filename, 'w' ) )
			{
				$all = str_replace( '~~obj~~', $table, $obj_tpl );
				$all = str_replace( '~~cols~~', implode( ",\n", $cols ), $all );
				$all = str_replace( '~~select_cols~~', implode( ",\n", $select_cols ), $all );
				$all = str_replace( '~~full_join~~', implode( ",\n", $full_join ), $all );
				$all = str_replace( '~~join_select_cols~~', implode( "\n", $join_select_cols ), $all );
				fwrite( $fh, $all );

				fclose( $fh );
			}
			else
			{
				p( $filename . " died" );
				$this->fail( 'could not open file ' . $filename );
				return FALSE;
			}
		}

		$this->success( 'data_obj_file_created' );
		return TRUE;
	}

	/**
	 * Gets all tables from database
	 *
	 * @return array|boolean array of tables or FALSE on error
	 */
	public function get_tables() : array|bool
	{
		$q = "SHOW TABLES";
		$sth = $this->query( $q );

		if( '00000' != $sth->errorCode() )
		{
			$this->fail( 'could_not_get_tables' );
			return FALSE;
		}

		$tables = [];
		while( $col = $sth->fetchColumn() )
		{
			$tables[] = $col;
		}

		$this->success( 'tables_fetched' );
		return $tables;
	}

	/**
	 * Gets all _admin_obj in database
	 *
	 * @return array|boolean array of admin_objs or FALSE on error
	 */
	public function get_objs() : array|bool
	{
		$this->success( 'objs_gotten' );
		return $this->list();
	}

	/**
	 * Creates ctrl file for entity
	 *
	 * @param array $vars name, table
	 * @param boolean $force_create_new not implemented
	 * @return boolean Always TRUE
	 */
	public function create_ctlr_file( array $vars, bool $force_create_new = FALSE ) : bool
	{
		p( "creating ctrlr file\n" );
		$obj = $vars['name'];
		$ctlr = $vars['name'];
		$table = $vars['table'];

		$filename = CTLR_APP . $ctlr . '.ctlr.php';
		if( $this->is_core( $ctlr ) )
		{
			$filename = CTLR_CORE . $ctlr. '.ctlr.php';
		}

		p( $filename . "\n" );
		if( !file_exists( $filename ) )
		{
			$ctlr_tpl = file_get_contents( ADMIN . "tpl/ctlr.php" );
			$fh = fopen( $filename, 'w' );
			fwrite( $fh, str_replace( '~~ctlr~~', $ctlr, $ctlr_tpl ) );
			fclose( $fh );
		}

		$this->success( 'ctlr_file_created' );
		return TRUE;
	}

	/**
	 * Creates obj file for table
	 *
	 * @param array $vars name, table
	 * @param boolean $force_create_new not implemented
	 * @return boolean Always TRUE
	 */
	public function create_obj_file( array $vars, bool $force_create_new = FALSE ) : bool
	{
		p( "Creating obj file" );
		$obj = $vars['name'];
		$table = $vars['table'];

		$filename = OBJ_APP . $obj . '.obj.php';
		if( $this->is_core( $obj ) )
		{
			$filename = OBJ_CORE . $obj . '.obj.php';
		}

		p( $filename );
		if( !file_exists( $filename ) )
		{
			$obj_tpl = file_get_contents( ADMIN . "tpl/obj.php" );
			print "\n\nOBJ TPL: " . ADMIN . "tpl/obj.php" . "\n";
			if( !$obj_tpl )
			{
				print "NO OBJ TEMPLATE FOUND";
				exit;
			}

			$fh = fopen( $filename, 'w' );
			fwrite( $fh, str_replace( '~~obj~~', $obj, $obj_tpl ) );
			fclose( $fh );
		}

		$this->success( 'obj_file_created' );
		return TRUE;
	}

	/**
	 * Creates crud interface for entity
	 *
	 * @param string $crud name of entity
	 * @return boolean Always TRUE
	 */
	public function create_crud_files( string $crud ) : bool
	{
		$page_file = PAGE_APP . $crud . '.php';
		$tpl_file = TPL_APP . 'page/' . $crud . '.html';
		$save_modal = TPL_APP . 'modal/' . $crud . '_save.html';

		if( $this->is_core( $crud ) )
		{
			$page_file = PAGE_CORE . $crud . '.php';
			$tpl_file = TPL_CORE . 'page/' . $crud . '.html';
			$save_modal = TPL_CORE . 'modal/' . $crud . '_save.html';
		}

		p( 'page_file' );
		p( $page_file );
		p( 'tpl_file' );
		p( $tpl_file );
		p( 'save_modal' );
		p( $save_modal );

		if( !file_exists( $page_file ) )
		{
			$page_tpl = file_get_contents( ADMIN . "tpl/page.php" );
			print "\n\nPAGE TPL: " . ADMIN . "tpl/page.php" . "\n";
			if( !$page_tpl )
			{
				print "NO PAGE TEMPLATE FOUND";
				exit;
			}

			$fh = fopen( $page_file, 'w' );
			fwrite( $fh, str_replace( '~~obj~~', $crud, $page_tpl ) );
			fclose( $fh );
		}

		if( !file_exists( $tpl_file ) )
		{
			$crud_header = [];
			$crud_cols = [];
			$filter_cols = [];
			$columns = $this->explain_table( $crud );
			if( $columns )
			{
				foreach( $columns as $col => $type )
				{
					list( $type, $length ) = explode( "(", $type );
					$crud_header[] = "<div class=\"col\" data-col=\"{$col}\" data-col-type=\"{$type}\">{$col}</div>\n";
					$crud_cols[] = "<div class=\"col\" data-col=\"{$col}\" data-col-type=\"{$type}\">~~{$col}~~</div>\n";
					$filter_cols[] = "data-filter-{$col}=~~{$col}~~";
				}
			}

			$crud_header[] = "<div class=\"col text-center\"><i class=\"fa fa-tools\"></i></div>";
			$crud_tpl = file_get_contents( ADMIN . "/tpl/crud.tpl" );
			print "\n\nCRUD TPL: " . ADMIN . "/tpl/crud.tpl" . "\n";
			p( $crud_tpl );
			if( !$crud_tpl )
			{
				print "NO CRUD TEMPLATE FOUND";
				exit;
			}

			$crud_tpl = str_replace( '~~crud~~', $crud, $crud_tpl );
			$crud_tpl = str_replace( '~~crud_header~~', implode( "", $crud_header ), $crud_tpl );
			$crud_tpl = str_replace( '~~crud_cols~~', implode( "", $crud_cols ), $crud_tpl );
			$crud_tpl = str_replace( '~~filter_cols~~', implode( "\n", $filter_cols ), $crud_tpl );

			$fh = fopen( $tpl_file, 'w' );
			fwrite( $fh, $crud_tpl );
			fclose( $fh );
		}

		if( !file_exists( $save_modal ) )
		{
			$save_tpl = file_get_contents( ADMIN . "/tpl/modal.save.html" );
			print "\n\nSAVE TPL: " . ADMIN . "/tpl/save.html" . "\n";
			p( $save_tpl );
			if( !$save_tpl )
			{
				print "NO SAVE TEMPLATE FOUND";
				exit;
			}

			$save_tpl = str_replace( '~~crud~~', $crud, $save_tpl );

			$fh = fopen( $save_modal, 'w' );
			fwrite( $fh, $save_tpl );
			fclose( $fh );
		}

		$obj = $this->get_by_col([ '_admin_obj_table' => $crud, '_admin_obj_name' => $crud ]);
		if( NULL !== $obj && $obj && !$obj['_admin_obj_page'] ||  !$obj['_admin_obj_save_modal'] )
		{
			$obj['_admin_obj_page'] = 1;
			$obj['_admin_obj_save_modal'] = 1;
			$obj['_admin_obj_crud'] = 1;
			$this->save( $obj );
		}

		return TRUE;
	}

	/**
	 * Creates valid form and valid fields for form
	 *
	 * @param string $table table name
	 * @param integer $form_input_id auto increment id of form
	 * @return boolean TRUE on save, FALSE on error
	 */
	public function create_valid_form( string $table, string $form_input_id ) : bool
	{
		$obj = $this->get_by_col([ '_admin_obj_table' => $table, '_admin_obj_name' => $table ]);

		$_valid_form = new _valid_form();
		$form = $_valid_form->get_by_col([ '_valid_form_input_id' => $form_input_id, '_valid_form_table' => $table ]);

		if( FALSE === $form )
		{
			$this->fail( 'selecting_valid_form_failed' );
			return FALSE;
		}

		$_valid_field = new _valid_field();

		if( !$form )
		{
			$form_id = $_valid_form->save([ '_valid_form_action' => "/{$table}/save", '_valid_form_name' => "Save {$table}", '_valid_form_input_id' => $form_input_id, '_valid_form_table' => $table ]);
			$form = $_valid_form->get_by_id( $form_id );
		}

		$form_id = $form['_valid_form_id'];

		$exclude_fields = [ $table . "_new", $table . "_edit", $table . "_del", $table . "_arch", 'fk__co_id' ];
		$exclude_srcs = [ '_co', '_token' ];

		$sth = $this->query( "EXPLAIN `{$table}`" );
		while( $col = $sth->fetch() )
		{
			if( in_array( $col['Field'], $exclude_fields ) )
			{
				continue;
			}

			$field = [ 'fk__valid_form_id' => $form_id, '_valid_field_name' => $col['Field'], '_valid_field_input_id' => $form['_valid_form_input_id'] . "_" . $col['Field'] ];

			list( $type, $length ) = explode( "(", $col['Type'], 2 );
			switch( $type )
			{
				case 'int':
				case 'smallint':
				case 'mediumint':
				case 'bigint':
				case 'float':
				case 'double':
				case 'year':
					$type = 'number';
					break;
				case 'date':
				case 'time':
				case 'datetime':
				case 'timestamp':
					$type = 'datetime-local';
					break;
				case 'tinyint':
					if( 1 == $length )
					{
						$type = "checkbox";
					}
					else
					{
						$type = 'number';
					}
					break;
				default:
					$type = 'text';
					break;
			}

			if( 'fk_' == substr( $col['Field'], 0, 3 ) && '_id' == substr( $col['Field'], -3) )
			{
				$type = 'select';
				if( !in_array( substr( $col['Field'], 3, -3 ), $exclude_srcs ) )
				{
					$field['_valid_field_src'] = "/" . substr( $col['Field'], 3, -3 ) . '/list';
				}
			}

			if( $table . "_id" == $col['Field'] )
			{
				$type = 'hidden';
			}

			$field['_valid_field_type'] = $type;
			$field['_valid_field_max'] = preg_replace( '/[^0-9]/', '', $length );

			$exists = $_valid_field->get_by_col( $field );
			if( !$exists && FALSE !== $exists )
			{
				$_valid_field_id = $_valid_field->save( $field );
				if( FALSE === $_valid_field_id )
				{
					p( "Failure to save valid field for " );
					p( $field );
					p( $_valid_field->get_error_msg() );
					p( $_valid_field->last_query );
					p( $_valid_field->last_bound );
					exit;
				}
			}
		}

		if( FALSE !== $obj && $obj && !$obj['_admin_valid_form'] )
		{
			$obj['_admin_valid_form'] = 1;
			$this->save( $obj );
		}

		return TRUE;
	}

	/**
	 * Auto creates all tables and their associated files
	 *
	 * @return void
	 */
	public function auto_create() : void
	{
		$q = "SHOW TABLES";
		$sth = $this->query( $q );

		while( $table = $sth->fetchColumn() )
		{
			p( 'calling create table on ' . $table );
			$this->create_entity( $table );
		}

		header( 'HTTP/1.1 200 Entities auto-created.' );
		exit;
	}
}
