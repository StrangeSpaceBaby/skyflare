class _notif
{
	constructor( _opts)
	{
		let _defaults = { fk__notif_topic_id: null };

		this.opts = { ..._defaults, ..._opts };

		log( '_notif _opts' );
		log( this.opts );
	}

	subscribe()
	{
		log( 'subscribe' );
		log( this.opts );

		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_notif_topic_mem/subscribe/' + $this.opts.fk__notif_topic_id })
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
