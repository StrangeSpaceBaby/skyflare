/*
 * _auth.flare.js - Manages authentication processes including login and logout operations
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

class _auth
{
	constructor( _opts )
	{
		new _log( '_auth constructor' );
		new _log( _opts );

		let _defaults = {
			form_id: null,
			_mem_login: null,
			_mem_password: null,
			auth_endpoint: '/_auth/password',
			auth_redirect_url: '/',
			logout_redirect_url: '/_auth/logout'
		};

		this.opts = { ..._defaults, ..._opts };

		new _log( '_auth constructor opts' );
		new _log( this.opts );
		return this;
	}

	logout()
	{
		let o_store = new _store();
		o_store.del( 'auth_token' );
		o_store.del( 'auth_token_type' );
		o_store.del( 'auth_token_scope' );
		o_store.del( 'auth_token_expires' );

		document.cookie = "auth_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

		window.location.href = $this.opts.logout_redirect_url;
	}

	auth()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _data = {};
				if( $this.opts.form_id )
				{
					_data = new _form({ form_id: $this.opts.form_id }).getFormData();
				}
				else
				{
					_data = $this.opts;
				}

				new _api({ url: $this.opts.auth_endpoint, data: _data })
					.poll()
					.then(
						( _ret ) =>
						{
							if( 1 == _ret.return )
							{
								new _log( 'init.auth _ret' );
								new _log( _ret );

								new _growl({ growl: _ret.msg, type: _ret.return ? 'success' : 'danger' });

								new _log( 'typeof auth_token' );
								new _log( typeof _ret.data.auth_token );
								new _log( 'auth api auth_token' );
								new _log( _ret.data.auth_token );
								if( 'undefined' !== typeof _ret.data.auth_token )
								{
									new _log( 'auth_token not undefined' );
									let o_store = new _store();
									o_store.del( 'auth_token' );
									o_store.del( 'auth_token_type' );
									o_store.del( 'auth_token_scope' );

									o_store.put( 'auth_token', _ret.data.auth_token );
									o_store.put( 'auth_token_expires', _ret.data.expires );

									const d = new Date();
  									d.setTime(d.getTime() + (1*24*60*60*1000));
  									let expires = "expires="+ d.toUTCString();
									new _log( 'auth cookie set' );
									new _log( "auth_token=" + _ret.data.auth_token + ";" + expires + ";path=/" );
  									document.cookie = "auth_token=" + _ret.data.auth_token + ";" + expires + ";path=/";
								}

								window.location.href = $this.opts.auth_redirect_url;
							}
							else
							{
								new _log( 'init.auth failed' );
								new _log({ msg: _ret, publish: 'console.table' });
								return _fail( _ret );
							}
						}
					)
					.catch(
						( _xhr, _textStatus, _errorThrown ) =>
						{
							new _log( 'auth error' );
							new _log( _xhr );
							new _log( _textStatus );
							new _log( _errorThrown );
							return _fail( _textStatus + ' ' + _errorThrown );
						}
					);
			}
		);
	}
}
