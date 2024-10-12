/*
 * _file.js - Wrapper for FileReader() with some extra checks
 * 
 * #review
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

class _file
{
	constructor( _opts )
	{
		let _defaults = { reader: new FileReader() };
		this.opts = { ..._defaults, ..._opts };
		this.drops = {};

		return this;
	}

	formatBytes( bytes, decimals = 2 )
	{
		if (bytes === 0) return '0 Bytes';

		const k = 1024;
		const dm = decimals < 0 ? 0 : decimals;
		const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

		const i = Math.floor(Math.log(bytes) / Math.log(k));

		return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
	}

	read( _element )
	{
		return new Promise(
			( _resolve, _reject ) =>
			{
				new _log( 'file read' );
				new _log( _element );

				let _file = $( _element ).prop( 'files' )[0];
				new _log( _file );
				let $this = this;
				// @TODO This will later need to grab the user's pricing tier and get the limit
				// 1 meg limit
				if( 1000000 < _file.size ) // one megabyte limit
				{
					new _growl( 'file_too_big', { type: 'danger' });
					new _log( 'file_too_big' );
					return _reject( 'file_too_big' );
				}

				let _reader = new FileReader();

				_reader.onload =
					function()
					{
						let _result = _reader.result;
						new _log( 'file result' );
						new _log( _result );
						$( '#doc_details_display' ).html( '<div class="col">' + _file.name + '</div><div class="col">' + $this.formatBytes( _file.size ) + '</div>' );

						return _resolve( _result );
					};

				let _dataUrl = _reader.readAsDataURL( $( _element ).prop( 'files' )[0] );
				new _log( _dataUrl );
			}
		);
	}
}
