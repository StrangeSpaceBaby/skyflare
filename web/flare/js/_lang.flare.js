/*
 * _lang.js - Fetches language translations from api endpoint
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

class _lang
{
	construct( _opts )
	{
		let _defaults = { lang: 'en' };
		this.opts = { ..._defaults, ..._opts }

		return this;
	}

	xl8( _token )
	{
		return new Promise( ( _resolve, _reject ) =>
		{
			let o_store = new _store();
			let _xl8 = o_store.fetch( 'token_' + _token );

			log( _xl8 );
			if( !_xl8 )
			{
				let _api = new _api({ url: '/lang/xl8/' + _token })
				.poll()
				.then(
					function( _ret )
					{
						console.log( 'xl8 return' );
						console.log( _ret );

						o_store.put( 'token_' + _token, _ret.data );

						return _resolve( _ret.data );
					}
				);
			}
			
			if( 'undefined' != typeof _xl8 && _xl8 )
			{
				console.log( ' xl8ing ' + _xl8 );
				return _resolve( _xl8 );
			}
			
			return _resolve( _token );
		});
	}
}
