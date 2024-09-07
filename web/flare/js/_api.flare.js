/*
 * _api.flare.js - Provides an interface for API interactions with token management and access verification
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
					new _log( 'cached_api checked' );
					new _log( _cached );
					if( _cached )
					{
						return _resolve( _cached );
					}
				}
				*/

				new _log( 'poll auth_token' );
				new _log( $this.opts.auth_token );
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
						new _log( $this.opts.url + ' success' );

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
									new _log( 'cached_api store failed for ' + $this.opts.url );
									return _resolve( _ret );
								}
							);
							*/
							return _resolve( _ret );
						}
						else if( _ret )
						{
							return _resolve( _ret );
						}
						else
						{
							return _reject( _ret );
						}
					},
					error: function( _ret )
					{
						new _log( $this.opts.url + ' failure' );
						return _reject( _ret );
					}
				}).always(
					( _ret, _textStatus, _xhr ) =>
					{
						// new _log( 'api always response header for ' + $this.opts.url );
						// new _log( _xhr.getAllResponseHeaders() );
						// new _log( _xhr.status );
						// new _log( '/api always response_header for ' + $this.opts.url );

						switch( _xhr.status )
						{
							case 200:
								if( $this.opts.auth_token != _xhr.getResponseHeader( 'auth_token' ) )
								{
									let o_store = new _store();
									o_store.put( 'auth_token', _xhr.getResponseHeader( 'auth_token' ) );
									o_store.put( 'auth_token_expires', _xhr.getResponseHeader( 'auth_token_expires' ) );
									new _log( 'auth_token updated' );
									return _resolve( _xhr );
								}
								break;
							case 403:
								new _log( 'Invalid path! ' + $this.opts.url );
								return _reject( 'Invalid Path' );
							case 401:
								new _log( 'Path Unauthorized' );
								return _reject( 'Not Authorized' );
						}
					}
				);
			}
		);
	}
}
