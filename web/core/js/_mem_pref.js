class _mem_pref
{
	constructor( _opts)
	{
		let _defaults = { _mem_pref_id: null, _mem_pref_group: null, _mem_pref_value: null };

		this.opts = { ..._defaults, ..._opts };

		log( '_note _opts' );
		log( this.opts );
	}

	getPrefs()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _url = '/_mem_pref/get_prefs_by/' + $this.opts._mem_pref_group;
				if( $this.opts._mem_pref_value )
				{
					_url += '/' + $this.opts._mem_pref_value;
				}
				new _api({ url: _url })
				.poll()
				.then(
					( _ret ) =>
					{
						tablog( _ret );
						if( 1 == _ret.return )
						{
							new _growl({ growl: _ret.msg, type: 'success' });
							return _success( _ret );
						}

						new _growl({ growl: _ret.msg, type: 'error' });
						return _fail( _ret );
					}
				);
			}
		);
	}

	togglePref()
	{
		log( 'togglePref' );
		log( this.opts );

		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_mem_pref/toggle/' + $this.opts._mem_pref_group + '/' + $this.opts._mem_pref_value })
				.poll()
				.then(
					( _ret ) =>
					{
						tablog( _ret );
						if( 1 == _ret.return )
						{
							new _growl({ growl: _ret.msg, type: 'success' });
							return _success( _ret );
						}

						new _growl({ growl: _ret.msg, type: 'error' });
						return _fail( _ret );
					}
				);
			}
		);
	}
}
