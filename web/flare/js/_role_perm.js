class _role_perm
{
	constructor( _opts )
	{
		log( '_role_perm constructor' );
		log( _opts );

		let _defaults =
		{
			_role_id: null,
			_perm_id: null
		};

		this.opts = { ..._defaults, ..._opts };

		log( '_role_perm constructor opts' );
		log( this.opts );
		return this;
	}

	togglePerm()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				if( !$this.opts._role_id )
				{
					return _fail( 'no_role_id_given_for_perms' );
				}

				new _api({ url: '/_role_perm/toggle_perm/' + $this.opts._role_id + '/' + $this.opts._perm_id })
				.poll()
				.then(
					( _ret ) =>
					{
						if( 1 == _ret.return )
						{
							return _success( _ret );
						}
					}
				)
				.catch(
					( _ret ) =>
					{
						log( '_role_perm not toggled' );
						log( _ret );
						return _fail( 'role_perm_not_toggled' );
					}
				)
			}
		);
	}

	perms()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				if( !$this.opts._role_id )
				{
					return _fail( 'no_role_id_given_for_perms' );
				}

				new _api({ url: '/_role_perm/get_by_role_id/' + $this.opts._role_id })
				.poll()
				.then(
					( _ret ) =>
					{
						log( '_role_perm.perms() fetched' );
						return _success( _ret );
					}
				)
				.catch
				(
					( _ret ) =>
					{
						log( 'caught _role_perm.perms()' );
						log( _ret );

						return _fail( _ret );
					}
				);
			}
		)
	}
}
