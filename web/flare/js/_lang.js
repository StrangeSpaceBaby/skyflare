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
			else if( 'undefined' != typeof _xl8 && _xl8 )
			{
				console.log( ' xl8ing ' + _xl8 );
				return _resolve( _xl8 );
			}
			else
			{
				return _resolve( _token );
			}
		});
	}
}
