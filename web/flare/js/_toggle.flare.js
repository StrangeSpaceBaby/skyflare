/*
 * _toggle.js - Sets, changes and updates toggle representations
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

class _toggle
{
	constructor( _opts )
	{
		new _log( 'toggle constructor' );
		new _log( _opts );

		let _defaults = { elem: null };
		this.opts = { ..._defaults, ..._opts };

		this.opts.elem = ('#' + this.opts.elem).replace( '##', '#' ); // Adds a # to the id in case it was forgotten
		new _log( 'toggle constructor opts' );
		new _log( this.opts );

		return this;
	}

	toggleAllOff( _selector )
	{
		$( _selector ).each(
			function( _index, _elem )
			{
				let _id = $( _elem ).prop( 'id' );
				_dom.setData( _id, 'flare-toggle-state', 0 );
				new _toggle({ elem: _id }).setToggle();
			}
		)
	}

	toggleAllOn( _selector )
	{
		$( _selector ).each(
			function( _index, _elem )
			{
				let _id = $( _elem ).prop( 'id' );
				_dom.setData( _id, 'flare-toggle-state', 1 );
				new _toggle({ elem: _id }).setToggle();
			}
		)
	}

	autotoggle()
	{
		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autotoggle' ).each(
					function( _index, _elem )
					{
						new _toggle({ elem: new _dom.attr( _elem, 'id' ) }).setToggle();
					}
				)

				return _success( 'autotoggled' );
			}
		);
	}

	setToggle()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _id = new _dom.attr( $this.opts.elem, 'id' );
				let _state = new _dom.attr( ('#' + _id).replace( '##', '#' ), 'flare-toggle-state' );
				if( 'undefined' !== typeof _state )
				{
					if( ( 'boolean' === typeof _state && _state ) || 1 == _state )
					{
						$this.switchOn();
						return _success( 'settoggle finished' );
					}
					else
					{
						$this.switchOff();
						return _success( 'settoggle finished' );
					}
				}
				return _fail( 'settoggle unknown error' );
			}
		);
	}

	toggle()
	{
		this.switch();
	}

	switch()
	{
		let _elem = this.opts.elem;
		let _toggleState = new _dom.attr( _elem, 'flare-toggle-state' );

		if( 'undefined' != typeof _toggleState )
		{
			if( !_toggleState )
			{
				this.switchOn();
			}
			else
			{
				this.switchOff();
			}
		}
		else
		{
			this.switchOn();
		}
	}

	switchOn()
	{
		let _elem = this.opts.elem;
		if( !$( _elem ).length )
		{
			return this;
		}

		let _toggleOnClass = new _dom.attr( _elem, 'flare-toggle-on-class' );
		let _toggleOffClass = new _dom.attr( _elem, 'flare-toggle-off-class' );

		new _dom.removeClass( _elem, _toggleOffClass );
		new _dom.addClass( _elem, _toggleOnClass );
		new _dom.attr( _elem.substr( 1 ), 'flare-toggle-state', 1 );

		return this;
	}

	switchOff()
	{
		let _elem = this.opts.elem;
		if( !$( _elem ).length )
		{
			return this;
		}

		let _toggleOnClass = new _dom.attr( _elem, 'flare-toggle-on-class' );
		let _toggleOffClass = new _dom.attr( _elem, 'flare-toggle-off-class' );

		new _dom.removeClass( _elem, _toggleOnClass );
		new _dom.addClass( _elem, _toggleOffClass );
		new _dom.attr( _elem.substr( 1 ), 'flare-toggle-state', 0 );

		return this;
	}
}
