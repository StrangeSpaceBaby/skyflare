/*
 * _dom.js - basic DOM methods for getting/setting attrs, get DOM elements, etc.
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

class _dom
{
	constructor( _opts )
	{
		new _log( '_dom constructor' );
		new _log( _opts );

		let _defaults = {};
		this.opts = { ..._defaults, ..._opts };

		new _log( '_dom constructor opts' );
		new _log( this.opts );
		return this;
	}

	static getData( _elemId, _attr )
	{
		_elemId = _elemId.replace( '#', '' );
		let _elem = document.getElementById( _elemId );
		if( !_elem )
		{
			new _log( 'element not in dom for data retrieval ' + _elemId + ' ' + _attr );
			return false;
		}

		new _log( 'getData returned' );
		new _log( document.getElementById( _elemId ).dataset[_attr] );

		return document.getElementById( _elemId ).dataset[_attr];
	}

	static setData( _elemId, _attr, _val )
	{
		_elemId = _elemId.replace( '#', '' );
		let _elem = document.getElementById( _elemId );
		if( !_elem )
		{
			new _log( 'element not in dom for data setting ' + _elemId + ' ' + _attr );
			return false;
		}

		new _log( 'setData returned' );
		new _log( document.getElementById( _elemId ).dataset );
		document.getElementById( _elemId ).dataset[_attr] = _val;

		return _val;
	}
}
