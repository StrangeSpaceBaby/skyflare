/*
 * _store.js - Manages localStorage
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
