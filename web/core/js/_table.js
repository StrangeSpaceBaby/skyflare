class _table
{
	constructor( _opts )
	{
		let _table = document.getElementById( 'table_pref_col_nav' );
		if( null === _table )
		{
			log( 'no table_pref_col_nav for use in table.js' );
			return false;
		}

		let _defaults = { table: document.getElementById( 'table_pref_col_nav' ).dataset.tableId };

		this.opts = { ..._defaults, ..._opts };

		log( '_table _opts' );
		log( this.opts );

		return this;
	}

	filter( _vars )
	{
		log( 'filter vars' );
		log( _vars );

		log( 'input[type=checkbox][name=filter_' + _vars.col + '][value="'+ _vars.value + '"]' );
		log( $( '#' + this.opts.table ) );
		log( '[data-filter-' + _vars.col + '="' + _vars.value + '"]' );

		if( $( 'input[type=checkbox][name=filter_' + _vars.col + '][value="'+ _vars.value + '"]' ).prop( 'checked' ) )
		{
			$( '#' + this.opts.table ).find( '[data-filter-' + _vars.col + '="' + _vars.value + '"]' ).removeClass( 'd-none' );
		}
		else
		{
			$( '#' + this.opts.table ).find( '[data-filter-' + _vars.col + '="' + _vars.value + '"]' ).addClass( 'd-none' );
		}
	}

	sortCol( _sortCol )
	{
		log( window.ux );
		log( 'start_direction' );

		let _this = document.getElementById( 'sort_icon_' + _sortCol );
		let _dir = _this.dataset.direction;
		let _table = '#' + this.opts.table;

		log( 'direction' );
		log( _dir );
		log( _this.dataset );

		log( 'end_direction' );
		log( _this.dataset.direction );

		let _vals = {};
		let _type = $( _table + ' .list-group-header' ).find( '[data-col="' + _sortCol + '"]' ).data( 'col-type' );
		log( 'type' );
		log( _type );

		let _sortNumeric = 0;
		switch( _type )
		{
			case 'date': // Date will sort numeric once it's reduced to the unix timestamp
			case 'currency':
			case 'number':
			case 'integer':
			case 'numeric':
				_sortNumeric++;
				break;
			default:
				break;
		}

		$( _table ).children().not( '.list-group-header' ).find( '[data-col="' + _sortCol + '"]' ).each(
			function( _index, _col )
			{
				log( 'col' );
				log( _col );
				log( $( _col ).closest( '.list-group-item' ) );

				let _id = $( _col ).closest( '.list-group-item' ).prop( 'id' );
				let _val = $( _col ).text();

				switch( _type )
				{
					case 'date':
						let _date = new moment( _val );
						_val = _date.format( 'x' );
						break;
					case 'currency':
					case 'number':
					case 'integer':
					case 'numeric':
						_val = _val.replace( /[^0-9\.]/, '' );
						break;
					default:
						break;
				}

				if( 'undefined' === typeof _vals[_val] )
				{
					_vals[_val] = [];
				}

				log( '_val' );
				log( _val );
				log( _vals );
				_vals[_val].push( _id );
			}
		);

		log( 'vals' );
		log( _vals );

		log( 'keys' );
		let _keys = [];
		_keys = Object.keys( _vals );
		log( _keys );

		$( '.sort-icon' ).not( 'sort_col_' + _sortCol ).addClass( _this.dataset.defaultIcon ).removeClass( _this.dataset.sortDown ).removeClass( _this.dataset.sortUp );

		if( 'up' == _dir )
		{
			log( 'going down' );
			_this.dataset.direction = 'down';
			$( this ).addClass( _this.dataset.sortDown ).removeClass( _this.dataset.sortUp );
			if( !_sortNumeric )
			{
				_keys = _keys.sort().reverse();
			}
			else
			{
				_keys = _keys.sort((a, b) => a - b).reverse();
			}
		}
		else if( 'down' == _dir )
		{
			log( 'going up' );
			_this.dataset.direction = 'up';
			$( this ).addClass( _this.dataset.sortUp ).removeClass( _this.dataset.sortDown );
			if( !_sortNumeric )
			{
				_keys = _keys.sort();
			}
			else
			{
				_keys = _keys.sort((a, b) => a - b);
			}
		}

		let _order = 0;
		for( let _i = 0; _i < _keys.length; _i++ )
		{
			let _val = _keys[_i];
			log( '_val' );
			log( _val );

			for( let _j = 0; _j < _vals[_val].length; _j++ )
			{
				let _elem = _vals[_val][_j];
				log( '_elem' );
				log( _elem );
				$( '#' + _elem ).css( 'order', _order );
				_order++;
			}
		}
	}

	toggleHiddenCol( _col )
	{
		log( 'start_hidden' );
		log( '#' + this.opts.table + ' *[data-col="' + _col + '"]' );

		$( '#' + this.opts.table + ' *[data-col="' + _col + '"]' ).toggleClass( 'd-none' );

		this.updateHiddenColToggle( _col );
	}

	updateHiddenColToggle( _col )
	{
		log( 'updateHiddenColToggle' );
		log( _col );
		let _this = document.getElementById( 'hide_icon_' + _col );
		let _on = _this.dataset.on;

		log( 'on' );
		log( _on );
		log( _this.dataset );

		$( '#hide_icon_' + _col ).toggleClass( _this.dataset.onIcon + ' text-success' ).toggleClass( _this.dataset.offIcon + ' text-dark' );
		if( 1 == _this.dataset.on )
		{
			_this.dataset.on = 0;
		}
		else
		{
			_this.dataset.on = 1;
		}
	}

	openPrefs()
	{
		log( 'openPrefs' );
		let _modal = $( '#table_prefs_box' );
		log( 'modal' );
		log( _modal );

		let _list = $( '#table_pref_col_nav' );
		_list.empty();

		let _tpl = 'table_pref_col_nav_tpl';

		let _table = this.opts.table;
		document.getElementById( 'table_pref_col_nav' ).dataset.tableId = _table;

		log( 'typeof window' );
		log( typeof window.ux.tables );
		tablog( window.ux.tables );

		if( 'undefined' == typeof window.ux.tables || !window.ux.tables[_table] )
		{
			new _table({ table: _table }).initTable();
		}

		for( let _i in window.ux.tables[_table].col_order )
		{
			let _col = window.ux.tables[_table].col_order[_i];
			log( 'prefs _col' );
			log( _col );
			if( !_col )
			{
				continue;
			}

			let _colDetails = window.ux.tables[_table].cols[_col];
			_list.append( new _jig({ tpl: _tpl, data: { col: _col, label: _colDetails.label } }).popTpl() );
			if( window.ux.tables[_table].cols_hidden.includes( _col ) )
			{
				$( '*[data-col="' + _col + '"]' ).addClass( 'd-none' ).data( 'on', 0 );
				this.updateHiddenColToggle( _col );
			}
		}
	}

	openFilters()
	{
		log( 'openFilters' );
		let _modal = $( '#table_filters_box' );
		log( 'modal' );
		log( _modal );

		let _list = $( '#table_filter_col_nav' );
		_list.empty();

		let _tpl = 'table_filter_col_nav_tpl';

		let _table = this.opts.table;
		document.getElementById( 'table_filter_col_nav' ).dataset.tableId = _table;

		let _filters = {};
		$( '#' + _table ).children().not( '.list-group-header' ).each(
			( _index, _elem ) =>
			{
				log( 'dataset' );
				log( _elem.dataset );
				for( let _key in _elem.dataset )
				{
					let _data = _elem.dataset[_key];
					if( 'filter' == _key.substring( 0, 6 ) )
					{
						log( 'openFilters filter' );
						log( _key );
						_key = _key.substring( 6 ).toLowerCase();
						log( _key );

						if( 'undefined' === typeof( _filters[_key] ) )
						{
							_filters[_key] = [];
						}

						_filters[_key].push( _data );
					}
				}
			}
		);
		log( 'filters' );
		tablog( _filters );

		let _headerTpl = 'table_filter_col_section_nav_tpl';
		for( let _i in _filters )
		{
			let _opts = [...new Set( _filters[_i] )]; // Removes duplicates
			_list.append( new _jig({ tpl: _headerTpl, data: { section: _i } }).popTpl() );
			for( let _j in _opts )
			{
				_list.append( new _jig({ tpl: _tpl, data: { col: _i, label: _opts[_j] } }).popTpl() );
			}
		}
	}

	autotable()
	{
		log( 'autotable' );
		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autotable' ).each(
					function( _index, _elem )
					{
						log( 'elem' );
						log( _elem );
						new _table({ table: '#' + $( _elem ).attr( 'id' ) }).initTable();
					}
				);

				return _success( 'autotables_initted' );
			}
		);
	}

	render()
	{
		log( 'render ' + this.opts.table );
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _table = $this.opts.table.replace( /[^A-Za-z0-9\-\_]/g, "" );
				log( '_table' );
				log( _table );
				log( 'table in window ux' );
				log( window.ux.tables[_table] );
				log( window.ux.tables );
				if( 'undefined' === typeof window.ux.tables[_table] || !window.ux.tables[_table] )
				{
					log( 'table not initted' );
					return _fail( 'table_not_initted' );
				}

				if( window.ux.tables[_table].cols_hidden )
				{
					$( window.ux.tables[_table].cols_hidden ).each(
						function( _index, _col )
						{
							log( 'hidden cols' );
							log( _index );
							log( _col );
							log( '#' + _table + ' *[data-col="' + _col + '"]' );
							$( '*[data-col="' + _col + '"]' ).addClass( 'd-none' );
						}
					);
				}

				for( let _i in window.ux.tables[_table].col_order )
				{
					let _col = window.ux.tables[_table].col_order[_i];
					$( '*[data-col="' + _col + '"]' ).css( 'order', _i );
				}

				return _success( 'table_rendered' );
			}
		);
	}

	initTable()
	{
		log( 'initTable' );
		log( this.opts );

		let $this = this;
		let _table = $( '#' + $this.opts.table );
		let _tableName = _table.attr( 'id' );
		log( 'tableName' );
		log( _tableName );

		if( 'undefined' === typeof window.ux.tables[_tableName] )
		{
			window.ux.tables[_tableName] = {};
		}

		window.ux.tables[_tableName].cols = {};
		window.ux.tables[_tableName].col_order = [];
		window.ux.tables[_tableName].cols_hidden = [];

		return new Promise(
			( _success, _fail ) =>
			{
				if( !$this.opts.table )
				{
					log( 'no table provided to _ux initTable()' );
					return _fail( _ret );
				}

				let _display_order = 0;

				_table.find( '.list-group-header' ).find( '.col' ).each(
					function( _index, _elem )
					{
						_display_order++;

						let _dataset = $( _elem ).data();

						if( 'undefined' === typeof _dataset['col'] )
						{
							return false;
						}

						let _col = _dataset['col'].replace( /[^A-Za-z0-9\-\_]/g, "" );
						let _label = _col;

						if( $( _elem ).html() )
						{
							_label = $( _elem ).html();
						}

						if( $( _elem ).attr( 'data-label' ) )
						{
							_label = $( _elem ).attr( 'data-label' );
						}

						if( $( _elem ).attr( 'data-display-order' ) )
						{
							window.ux.tables[_tableName].col_order[$( _elem ).attr( 'data-display-order' )] = _col;
						}
						else
						{
							window.ux.tables[_tableName].col_order[_display_order] = _col;
						}

						$( _elem ).css( 'order', $( _elem ).attr( 'data-display-order' ) ? $( _elem ).attr( 'data-display-order' ) : _display_order );

						let _sortable = true;
						if( 'undefined' !== typeof $( _elem ).attr( 'data-sortable' ) )
						{
							_sortable = $( _elem ).attr( 'data-sortable' );
						}

						let _hidden = false;
						if( 'undefined' !== typeof $( _elem ).attr( 'data-hidden' ) && !$( _elem ).attr( 'data-col-always-on' ) )
						{
							_hidden = $( _elem ).attr( 'data-hidden' );
							window.ux.tables[_tableName].cols_hidden.push( _col );
						}

						window.ux.tables[_tableName].cols[_col] = { label: _label, col: _col, type: $( _elem ).attr( 'data-col-type' ), display_order: _display_order, sortable: _sortable, hidden: _hidden };
					}
				);

				log( 'end initTable' );
				log( window.ux.tables[_tableName].cols['Name'] );
				this.render();

				return _success( _tableName + ' table initted' );
			}
		);

	}
}
