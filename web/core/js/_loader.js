class _loader
{
	constructor( _opts )
	{
		let _defaults = { src: null, tpl: null, populate: null, default_value: '-', load_in: '#nowhere' };
		this.opts = { ..._defaults, ..._opts };

		return this;
	}

	autoload()
	{
		log( '_loader autoload' );

		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autoload' ).each(
					function( _index, _elem )
					{
						log( 'autoload elem' );
						log( _elem );
						new _loader({}).load( $( _elem ).prop( 'id' ) );
					}
				)

				return _success( 'autoloaded' );
			}
		);
	}

	load( _elemId )
	{
		let $this = this;

		log( 'loader loading ' + _elemId );
		if( '.' == _elemId.substr( 0, 1 ) )
		{
			$( _elemId ).each(
				function( _index, _elem )
				{
					log( 'multi-load' );
					log( _elem );
					$this.load( '#' + $( _elem ).attr( 'id' ) );
				}
			)
		}
		else
		{
			if( '#' != _elemId.substring( 0, 1 ) )
			{
				_elemId = '#' + _elemId;
			}
		}

		return new Promise(
			( _success, _fail ) =>
			{
				try
				{
					log( '_elemId' );
					log( _elemId );
					if( 'undefined' == typeof $( _elemId ) || !$( _elemId ).length )
					{
						return _fail( _elemId + ' not_in_DOM' );
					}

					let _elem = $( _elemId );
					let _src = !$this.opts.src ? _elem.attr( 'data-src' ) : $this.opts.src;
					let _replaces = [];
					let _tpl = !$this.opts.tpl ? _elem.attr( 'data-tpl' ) : $this.opts.tpl;
					let _populate = !$this.opts.populate ? _elem.attr( 'data-populate' ) : $this.opts.populate;
					let _emptyMsg = !$this.opts.when_empty ? _elem.attr( 'data-when-empty' ) : $this.opts.when_empty;

					let _hashRegex = /#[a-z\d\-_]+/ig;
					_replaces = [ ..._src.matchAll( _hashRegex ) ];

					if( 'undefined' != typeof _replaces && _replaces.length )
					{
						for( let _i in _replaces )
						{
							let _replace = _replaces[_i][0];
							log( 'replace ' + _replace + ' with ' + $( _replace ).val() );
							_src = _src.replace( _replace, $( _replace ).val() );
						}
					}

					let _popTarget = $( '#' + _populate );
					_popTarget.children().not( '.keep' ).remove();
					_popTarget.append( '<div class="row"><div class="col-12 text-center pt-5"><i class="fad fad fa-spinner fa-spin fa-3x fa-fw text-primary"></i></div></div>' );

					if( !_src )
					{
						return _fail( 'no_src_for_api_call_in_load' );
					}

					new _api({ url: _src, method: 'GET' })
					.poll()
					.then(
						( _ret ) =>
						{
							log( 'load _ret' );
							log( _ret );

							if( 1 == _ret.return )
							{
								_popTarget.children().not( '.keep' ).remove();
								if( 0 != _ret.count )
								{
									for( let _i in _ret.data )
									{
										let _item = _ret.data[_i];
										_popTarget.append( new _jig({ tpl: _tpl, data: _item, default: $this.opts.default_value }).popTpl() );
										new _jig().postPop( '#' + _populate );
									}
								}
								else
								{
									log( 'nothing to load' );
									if( _emptyMsg )
									{
										log( 'emptyMsg ' + _emptyMsg );
										_popTarget.append( _emptyMsg );
									}
								}

								return _success( _ret );
							}

							if( _emptyMsg )
							{
								log( 'emptyMsg failed-return ' + _emptyMsg );
								_popTarget.children().not( '.keep' ).remove();
								_popTarget.append( _emptyMsg );
							}

							return _fail( _ret );
						}
					)
					.catch(
						( _ret ) =>
						{
							log( 'loader api error' );
							log( _ret );

							return _ret;
						}
					);
				}
				catch( _error )
				{
					log( '_loader load error' );
					log( _error );
					return _fail( _error );
				}
			}
		);
	}
}
