class _task
{
	constructor( _opts )
	{
		log( 'task constructor' );
		log( _opts );

		let _defaults = { task_obj_id: null, task_obj: null, task_name: null, task_desc: null };
		this.opts = { ..._defaults, ..._opts };

		log( 'task constructor opts' );
		log( this.opts );
		return this.setup();
	}

	setup()
	{
	}

	new()
	{
		log( 'new task' );
		log( this.opts );
		return new Promise(
			( _success, _fail ) =>
			{
				let _api = new _api({ url: '/task/new', data: this.opts })
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
