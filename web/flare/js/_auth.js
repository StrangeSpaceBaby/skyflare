class _auth
{
	constructor( _opts )
	{
		log( '_auth constructor' );
		log( _opts );

		let _defaults = {
			form_id: null,
			_mem_login: null,
			_mem_password: null,
			auth_endpoint: '/_auth/password',
			auth_redirect_url: '/',
			logout_redirect_url: '/_auth/logout'
		};

		this.opts = { ..._defaults, ..._opts };

		log( '_auth constructor opts' );
		log( this.opts );
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
								log( 'init.auth _ret' );
								log( _ret );

								new _growl({ growl: _ret.msg, type: _ret.return ? 'success' : 'danger' });

								log( 'typeof auth_token' );
								log( typeof _ret.data.auth_token );
								log( 'auth api auth_token' );
								log( _ret.data.auth_token );
								if( 'undefined' !== typeof _ret.data.auth_token )
								{
									log( 'auth_token not undefined' );
									let o_store = new _store();
									o_store.del( 'auth_token' );
									o_store.del( 'auth_token_type' );
									o_store.del( 'auth_token_scope' );

									o_store.put( 'auth_token', _ret.data.auth_token );
									o_store.put( 'auth_token_expires', _ret.data.expires );

									const d = new Date();
  									d.setTime(d.getTime() + (1*24*60*60*1000));
  									let expires = "expires="+ d.toUTCString();
									log( 'auth cookie set' );
									log( "auth_token=" + _ret.data.auth_token + ";" + expires + ";path=/" );
  									document.cookie = "auth_token=" + _ret.data.auth_token + ";" + expires + ";path=/";
								}

								window.location.href = $this.opts.auth_redirect_url;
							}
							else
							{
								log( 'init.auth failed' );
								tablog( _ret );
								return _fail( _ret );
							}
						}
					)
					.catch(
						( _xhr, _textStatus, _errorThrown ) =>
						{
							log( 'auth error' );
							log( _xhr );
							log( _textStatus );
							log( _errorThrown );
							return _fail( _textStatus + ' ' + _errorThrown );
						}
					);
			}
		);
	}
}
