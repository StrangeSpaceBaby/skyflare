class _meditation
{
	constructor( _opts )
	{
		log( '_meditation constructor' );
		log( _opts );

		let _defaults = { table: null };
		this.opts = { ..._defaults, ..._opts };

		log( '_meditation constructor opts' );
		log( this.opts );
		return this;
	}

	loadTableOverview()
	{
		log( 'loadTableOverview' );
		let _table = this.opts.table;
		log( _table );
		let _formsList = $( '#generic_forms_list' );
		let _itemsList = $( '#generic_list' );

		$( '#generic_form_fields' ).empty();
		let _header = $( '#generic_header' );
		_header.empty();

		log( 'formsList' );
		log( _formsList );
		log( _formsList.data() );
		log( 'setting ' + '/_valid_form/forms_by_table/' + _table );

		_formsList.attr( 'data-src', '/_valid_form/forms_by_table/' + _table );
		_itemsList.attr( 'data-src', '/' + _table + '/list' );
		_itemsList.attr( 'data-table', _table );

		new _loader({}).load( '#generic_forms_list' );
		new _loader({}).load( '#generic_list' ).then(
			( _ret ) =>
			{
				log( 'loading_generic_list' );
				let _itemsList = $( '#generic_list' );
				_itemsList.children().not( '.keep' ).not( 'list-group-item-header' ).empty();

				if( 1 == _ret.return && _ret.data )
				{
					for( let _i in _ret.data )
					{
						let _header = $( '#generic_header' );
						_header.empty();
						let _headerBuilt = 0;

						let _item = _ret.data[_i];
						log( 'load generic item' );
						log( _item );

						let _itemId = _item[_table + '_id' ];

						_itemsList.append( new _jig({ tpl: 'generic_list_tpl', data: { id: _itemId, table: _table } }).popTpl() );

						let _colsList = $( '#generic_cols_' + _itemId );
						_colsList.empty();

						for( let _j in _item )
						{
							if( !_headerBuilt )
							{
								_header.append(
									'<div class="col">' + _j + '</div>'
								);
							}

							_colsList.append(
								'<div class="col">' + _item[_j] + '</div>'
							);
						}

						_headerBuilt++;
					}
				}
			}
		);

		this.fillCanvas( 'table_overview' );
	}

	fillCanvas( _tpl )
	{
		this.clearCanvas( _tpl );
		$( '#canvas' ).html( $( 'tpl#' + _tpl ).html() ).data( 'tpl', _tpl );
		$( 'tpl#' + _tpl ).html( '' );
	}

	clearCanvas( _tpl )
	{
		let _currTpl = $( '#canvas' ).data( 'tpl' );
		if( _currTpl )
		{
			if( $( 'tpl#' + _tpl ).length )
			{
				$( 'tpl#' + _tpl ).html( $( '#canvas' ).html() );
			}
		}

		$( '#canvas' ).data( 'tpl', '' );
		$( '#canvas' ).html( '' );
	}
}
