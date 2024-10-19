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
    constructor( opts = {} )
    {
        let defaults = {
			url: null,
			method: 'POST',
			data: {},
			force_fetch: true,
			enctype: 'application/json'
		};

        this.opts = { ...defaults, ...opts };
    }

    poll()
    {
        return new Promise(
			( resolve, reject ) =>
			{
				if ( !this.opts.url )
				{
					return reject( 'no_url_in_api_opts' );
				}

				let o_store = new _store();
				this.opts.auth_token = o_store.fetch( 'auth_token' );
				
				let beforeRequest = _config.get( '_api', 'beforeRequest' );
				if( beforeRequest && 'function' == typeof beforeRequest )
				{
					beforeRequest( this.opts, fetchOptions );
				}
	
				let fetchOptions = {
					method: this.opts.method,
					headers: {
						'Content-Type': this.opts.enctype,
						'auth_token': this.opts.auth_token
					},
					body: JSON.stringify( this.opts.data )
				};

				fetch( this.opts.url, fetchOptions )
				.then(
					( response ) =>
					{
						let newToken = response.headers.get( 'auth_token' );
						let newTokenExpires = response.headers.get( 'auth_token_expires' );

						if ( newToken && newToken !== this.opts.auth_token )
						{
							o_store.put( 'auth_token', newToken );
							o_store.put( 'auth_token_expires', newTokenExpires );
							new _log( 'auth_token updated' );
						}

						switch ( response.status )
						{
							case 200:
								return response.json();
							case 401:
								new _log( 'Path Unauthorized' );
								return reject( 'Not Authorized' );
							case 403:
								new _log( 'Invalid path! ' + this.opts.url );
								return reject( 'Invalid Path' );
							default:
								return reject( 'Unexpected status: ' + response.status );
						}
					})
				.then(
					( data ) =>
					{
						new _log( this.opts.url + ' success' );
						
						let afterRequest = _config.get( '_api', 'afterRequest' );
						if( afterRequest && 'function' == typeof afterRequest )
						{
							afterRequest( data, this.opts );
						}

						return resolve( data );
					})
				.catch(
					( error ) =>
					{
						new _log( this.opts.url + ' failure' );
						return reject( error );
					}
				);
        });
    }
}