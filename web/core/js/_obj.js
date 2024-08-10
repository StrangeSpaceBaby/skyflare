class _obj
{
	constructor( _obj )
	{
		log( '_obj con' );
		log( _obj );
		// No opts support yet
	}

	setObj( _obj )
	{
		log( 'setObj' );
		log( _obj );

		this._obj = _obj;
		this._obj_id = _obj + '_id';

		log( '_obj' );
		log( this._obj );
	}

	fetch()
	{
		return new Promise(
			( _success, _fail ) =>
			{
				log( 'inside fetch' );
				log( this._obj );
				log( this._obj_id );
				log( this.opts );
				log( this.opts );
				let _obj_id_val = this.opts[this._obj_id];
				log( 'obj_id_val' );
				log( _obj_id_val );
				let $url = '/' + this._obj + '/fetch/' + _obj_id_val;
				log( 'url' );
				log( $url );
				new _api({ url: $url, method: 'GET' })
				.poll()
				.then(
					( _ret ) =>
					{
						log( 'fetch api _ret' );
						log( _ret );
						if( 1 == _ret.return )
						{
							this.opts[this._obj] = _ret.data;
							log( 'after setting' );
							log( this.opts );
							return _success( _ret.data );
						}
		
						return _fail( _ret.msg );
					}
				);
			}
		)
	}
}