/*
 * _log.js - Loges to console or supplied function
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

class _log
{
	constructor( _opts )
	{		
		let _defaults = { msg: 'No log message', publish: 'console.log' };
		if( 'string' == typeof _opts )
		{
			_defaults.msg = _opts;
		}

		this.opts = { ..._defaults, ..._opts };

		this.log();
	}

	log( _msg )
	{
		_msg ??= this.opts.msg;

		switch( this.opts.publish )
		{
			case 'console.log':
				console.log( _msg );
				break;
			case 'console.info':
				console.info( _msg );
				break;
			case 'console.warn':
				console.warn( _msg );
				break;
			case 'console.error':
				console.error( _msg );
				break;
			case 'console.trace':
				console.trace( _msg );
				break;
			case 'console.debug':
				console.debug( _msg );
				break;
			case 'console.table':
				console.table( _msg );
				break;
			default:
				self[this.opts.publish]( _msg );
				break;
		}
	}
}