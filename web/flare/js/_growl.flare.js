/*
 * _growl.js - Flare's version of toast()
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

class _growl
{
	constructor( _opts )
	{
		let _defaults = { msg: null, type: 'error' };

		this.opts = { ..._defaults, ..._opts };

		this.state_classes =
		{
			'info':		'info',
			'error':	'danger',
			'success':	'success',
			'warning':	'warning'
		}

		this.state_text_classes =
		{
			'info':		'primary',
			'error':	'white',
			'success':	'white',
			'warning':	'primary'
		}

		this.opts.state = this.state_classes[this.opts.type];
		this.opts.state_text = this.state_text_classes[this.opts.type];

		new _log( '_growl _opts' );
		new _log( this.opts );

		return this.growl();
	}

	growl()
	{
		let _now = Date.now();
		let _count = $( '.growl' ).length + 1;
		let _id = _now + '-' + _count;
		new _log( 'growl id' );
		new _log( _id );
		$( '#growl_container' ).append( new _jig({ tpl: 'growl_tpl', data: { growl: this.opts.msg, id: _id, state: this.opts.state, state_text: this.opts.state_text }, default: '-' }).popTpl() );
		setTimeout(
			function()
			{
				$( '#growl_' + _id ).fadeOut( 1000,
					function()
					{
						$( '#growl_' + _id ).remove();
					}
				);
			}, 3000
		)
	}
}
