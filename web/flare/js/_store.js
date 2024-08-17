class _store
{
	constructor()
	{
		return this;
	}

	put( _key, _val )
	{
		localStorage.setItem( _key, JSON.stringify( _val ) );
	}

	fetch( _key )
	{
		let _val = localStorage.getItem( _key );

		try
		{
			return JSON.parse( localStorage.getItem( _key ) );
		}
		catch( _error )
		{
			return _val;
		}
	}

	del( _key )
	{
		localStorage.removeItem( _key );
	}

	clear()
	{
		localStorage.clear();
	}
}
