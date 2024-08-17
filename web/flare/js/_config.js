
class _config
{
	constructor( _opts )
	{
		log( '_config constructor' );
		log( _opts );

		let _defaults = {  };
		this.opts = { ..._defaults, ..._opts };

		log( '_config constructor opts' );
		log( this.opts );
		return this;
	}

	toggleRolePermission( _roleId, _permId )
	{
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_role_perm/toggle/' + _roleId + '/' + _permId })
				.poll()
				.then(
					( _ret ) =>
					{
						if( 1 == _ret.return )
						{
							return _success( _ret );
						}

						return _fail( _ret );
					}
				)
			}
		);
	}
}
