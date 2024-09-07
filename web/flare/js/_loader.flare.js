/*
 * _loader.js - Using element attributes, fetches content, hydrates a template and injects it into the population target
 * 
 * Copyright (c) 2024 Greg Strange
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, subject to
 * including this permission notice in all copies or substantial portions
 * of the Software.
 */

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
		new _log( '_loader autoload' );

		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autoload' ).each(
					function( _index, _elem )
					{
						new _log( 'autoload elem' );
						new _log( _elem );
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

		new _log( 'loader loading ' + _elemId );
		if( '.' == _elemId.substr( 0, 1 ) )
		{
			$( _elemId ).each(
				function( _index, _elem )
				{
					new _log( 'multi-load' );
					new _log( _elem );
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
					new _log( '_elemId' );
					new _log( _elemId );
					if( 'undefined' == typeof $( _elemId ) || !$( _elemId ).length )
					{
						return _fail( _elemId + ' not_in_DOM' );
					}

					let _elem = $( _elemId );
					let _src = !$this.opts.src ? _elem.attr( 'data-fl-src' ) : $this.opts.src;
					let _replaces = [];
					let _tpl = !$this.opts.tpl ? _elem.attr( 'data-fl-tpl' ) : $this.opts.tpl;
					let _populate = !$this.opts.populate ? _elem.attr( 'data-fl-populate' ) : $this.opts.populate;
					let _emptyMsg = !$this.opts.when_empty ? _elem.attr( 'data-fl-when-empty' ) : $this.opts.when_empty;

					let _hashRegex = /#[a-z\d\-_]+/ig;
					_replaces = [ ..._src.matchAll( _hashRegex ) ];

					if( 'undefined' != typeof _replaces && _replaces.length )
					{
						for( let _i in _replaces )
						{
							let _replace = _replaces[_i][0];
							new _log( 'replace ' + _replace + ' with ' + $( _replace ).val() );
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
							new _log( 'load _ret' );
							new _log( _ret );

							if( 1 == _ret.return )
							{
								_popTarget.children().not( '.keep' ).remove();
								if( _ret.count )
								{
									for( let _i in _ret.data )
									{
										let _item = _ret.data[_i];
										if( _tpl )
										{
											_popTarget.append( new _jig({ tpl: _tpl, data: _item, default: $this.opts.default_value }).popTpl() );
										}
										new _jig().postPop( '#' + _populate );
									}
								}
								else
								{
									new _log( 'nothing to load' );
									if( _emptyMsg )
									{
										new _log( 'emptyMsg ' + _emptyMsg );
										_popTarget.append( _emptyMsg );
									}
								}

								return _success( _ret );
							}
							else if( _ret )
							{
								new _log( 'populate page' );
								new _log( _ret );
								// Loading bare data into element like a full page injection
								_popTarget.html( _ret );

								return _success( 'page loaded' );
							}
							else
							{
								if( _emptyMsg )
								{
									new _log( 'emptyMsg failed-return ' + _emptyMsg );
									_popTarget.children().not( '.keep' ).remove();
									_popTarget.append( _emptyMsg );
								}
	
								return _fail( _ret );
							}
						}
					)
					.catch(
						( _ret ) =>
						{
							new _log( 'loader api error' );
							new _log( _ret );

							return _ret;
						}
					);
				}
				catch( _error )
				{
					new _log( '_loader load error' );
					new _log( _error );
					return _fail( _error );
				}
			}
		);
	}
}
