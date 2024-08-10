class _jig
{
	constructor( _opts )
	{
		let _defaults = { ldelim: '~~', rdelim: '~~', default: null };
		this.opts = { ..._defaults, ..._opts };

		this.rendered = '';

		return this;
	}

	autotpl()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autotpl' ).each(
					( _index, _elem ) =>
					{
						let _id = $( _elem ).attr( 'id' );
						let _tpl = $( '#' + _id ).attr( 'data-tpl' );
						this.fetchTpl( _tpl )
						.then(
							( _content ) =>
							{
								$( '#' + _id ).html( _content );
								$this.postPop( _id );
							}
						)
						.catch(
							( _msg ) =>
							{
								log( _id + ' failed autotpl with message ' + _msg );
							}
						);
					}
				);

				return _success( 'autotpl finished' );
			}
		);
	}

	postPop( _id )
	{
		log( 'postPop' );
		$( ('#' + _id).replace( '##', '#' ) ).find( '.autoload' ).each(
			( _loadIndex, _loadElem ) =>
			{
				let _loadId = $( _loadElem ).attr( 'id' );
				new _loader({}).load( '#' + _loadId );
			}
		);

		$( ('#' + _id).replace( '##', '#' ) ).find( '.autoform' ).each(
			( _formIndex, _formElem ) =>
			{
				let _formId = $( _formElem ).attr( 'id' );
				new _form({ form_id: '#' + _formId, autoform: true }).autoform();
			}
		);

		$( ('#' + _id).replace( '##', '#' ) ).find( '.autotable' ).each(
			( _tableIndex, _tableElem ) =>
			{
				let _tableId = $( _tableElem ).attr( 'id' );
				new _table({ table: '#' + _tableId }).initTable();
			}
		);

		log( 'postPop settoggle' );
		log( ('#' + _id).replace( '##', '#' ) );
		$( ('#' + _id).replace( '##', '#' ) ).find( '.autotoggle' ).each(
			( _toggleIndex, _toggleElem ) =>
			{
				log( 'toggling' );
				log( _toggleElem );
				let _toggleId = $( _toggleElem ).attr( 'id' );
				new _toggle({ elem: '#' + _toggleId }).setToggle();
			}
		);
	}

	fetchTpl( _tpl )
	{
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_tpl/by_name/' + _tpl })
				.poll()
				.then(
					( _ret ) =>
					{
						if( 1 == _ret.return )
						{
							return _success( _ret.data );
						}
						else
						{
							return _fail( _ret );
						}
					}
				)
			}
		);
	}

	popTpl()
	{
		let _tplHandle = this.opts.tpl;
		let _data = this.opts.data;

		let _src = '';
		if( $( 'template#' + _tplHandle ).length )
		{
			_src = $( 'template#' + _tplHandle ).html();
		}
		else
		{
			_src = $( 'div#' + _tplHandle ).html();
		}

		if( '' == _src || 'undefined' == typeof _src )
		{
			log( _tplHandle + ' not found' );
			log( 'src', _src );
			return false;
		}

		for( let _i in _data )
		{
			if( null != _data[_i] )
			{
				var _item = _data[_i];
				if( Array.isArray( _item ) )
				{
					for( let _j in _item )
					{
						_item[_j] = _item[_j].toString().replace( '$', '&#36;' );
						_src = _src.replace( new RegExp( this.opts.ldelim + '(' + _i + '.' + _j + '?)' + this.opts.rdelim, 'g' ), _item[_j] );
					}
				}
				else
				{
					_item = _item.toString().replace( '$', '&#36;' );
					_src = _src.replace( new RegExp( this.opts.ldelim + '(' + _i + '?)' + this.opts.rdelim, 'g' ), _item );
				}
			}
		}

		_src = _src.replace( new RegExp( this.opts.ldelim + '(.*?)' + this.opts.rdelim, 'g' ), this.opts.default );

		return _src;
	}
}
