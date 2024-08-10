class _follow
{
	constructor( _opts)
	{
		let _defaults = { _follow_id: null, _follow_obj: null, _follow_obj_id: null };

		this.opts = { ..._defaults, ..._opts };

		log( '_follow _opts' );
		log( this.opts );
	}

	toggle()
	{
		log( 'toggle' );
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_follow/toggle/', data: $this.opts })
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

	do_i_follow()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_follow/do_i_follow/' + $this.opts._follow_obj + '/' + $this.opts._follow_obj_id, method: 'GET' })
				.poll()
				.then(
					( _ret ) =>
					{
						if( 1 == _ret.return )
						{
							if( 'undefined' != typeof _ret.data._follow_id )
							{
								return _success( _ret );
							}
							else
							{
								return _success( 'no_follow' );
							}
						}

						return _fail( _ret );
					}
				);
			}
		);
	}

	getFollows( _types )
	{
		log( 'getFollows' );
		this.opts.objs = [ this.opts._follow_obj ];

		if( !!_types )
		{
			log( 'types' );
			log( _types );
			this.opts.objs = _types.join( '|' );
		}

		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_follow/get_by_obj/' + $this.opts.objs, method: 'GET' })
				.poll()
				.then(
					( _ret ) =>
					{
						tablog( _ret );
						if( 1 == _ret.return )
						{
							new _growl({ growl: _ret.msg, type: 'success' });
							return _success( _ret.data );
						}

						new _growl({ growl: _ret.msg, type: 'error' });
						return _fail( _ret );
					}
				);
			}
		);
	}
}
