/**
 *	The API class provides for a slick overlayer to facilitate token management, access verification, etc.
 */

class _api
{
	constructor( _opts )
	{
		let _defaults = { url: null, method: 'POST', data: new Array(0), force_fetch: true };

		this.opts = { ..._defaults, ..._opts };
	}

	poll()
	{
		let o_store = new _store();
		this.opts.auth_token = o_store.fetch( 'auth_token' );

		let $this = this;
		return new Promise(
			( _resolve, _reject ) =>
			{
				if( !$this.opts.url )
				{
					return _reject( 'no_url_in_api_opts' );
				}


				/*
				let o_db = new _db({ dbname: 'cached_api', dbversion: 1, key:{ keyPath: 'url', autoIncrement: true }, store: 'cached' });
				if( !$this.opts.force_fetch )
				{
					let _cached = o_db.get_by_key( $this.opts.url );
					log( 'cached_api checked' );
					log( _cached );
					if( _cached )
					{
						return _resolve( _cached );
					}
				}
				*/

				log( 'poll auth_token' );
				log( $this.opts.auth_token );
				$.ajax({
					method: $this.opts.method,
					url: $this.opts.url,
					data: $this.opts.data,
					headers:
					{
						auth_token: $this.opts.auth_token
					},
					success: function( _ret )
					{
						log( $this.opts.url + ' success' );

						if( 1 == _ret.return )
						{
							/*
							o_db.insert( $this.opts.url, _ret )
							.then(
								( _ret ) =>
								{
									return _resolve( _ret );
								}
							)
							.catch(
								( _ret ) =>
								{
									log( 'cached_api store failed for ' + $this.opts.url );
									return _resolve( _ret );
								}
							);
							*/
							return _resolve( _ret );
						}
						else
						{
							return _reject( _ret );
						}
					},
					error: function( _ret )
					{
						log( $this.opts.url + ' failure' );
						$( '#result_display' ).removeClass( 'text-success' ).addClass( 'text-danger' );
						if( 'undefined' != typeof _ret.msg && _ret.msg )
						{
							log( 'prepending' );
							$( '#result_display' ).prepend( _ret.msg + "<br />" );
						}
						return _reject( _ret );
					}
				}).always(
					( _ret, _textStatus, _xhr ) =>
					{
						log( 'api always response header for ' + $this.opts.url );
						// log( _xhr.getAllResponseHeaders() );
						log( _xhr.status );
						log( '/api always response_header for ' + $this.opts.url );

						switch( _xhr.status )
						{
							case 200:
								if( $this.opts.auth_token != _xhr.getResponseHeader( 'auth_token' ) )
								{
									let o_store = new _store();
									o_store.put( 'auth_token', _xhr.getResponseHeader( 'auth_token' ) );
									o_store.put( 'auth_token_expires', _xhr.getResponseHeader( 'auth_token_expires' ) );
									log( 'auth_token updated' );
									return _resolve( _xhr );
								}
								break;
							case 403:
								log( 'Invalid path! ' + $this.opts.url );
								return _reject( 'Invalid Path' );
							case 401:
								log( 'Path Unauthorized' );
								return _reject( 'Not Authorized' );
						}
					}
				);
			}
		);
	}
}
