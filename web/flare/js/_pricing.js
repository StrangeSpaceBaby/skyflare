class _pricing
{
	constructor( _opts )
	{
		let _defaults = {};
		this.opts = { ..._defaults, ..._opts };

		log( '_pricing _opts' );
		log( this.opts );
		return this;
	}

	calcBill()
	{
		log( 'calcBill' );
		return new Promise(
			( _success, _fail ) =>
			{
				let _pricing = $( 'input[name="_pricing_id"]:checked' ).val();
				log( 'pricing' );
				log( _pricing );
			}
		);
	}

	calc()
	{
		log( 'pricing calc' );
		let _min = this.opts.min * 1;
		let _max = this.opts.max * 1;
		let _price = this.opts.price * 1;
		let _count = this.opts.count * 1;
		let _free = this.opts.free * 1;

		return new Promise(
			( _success, _fail ) =>
			{
				log( _min );
				log( _max );
				log( _price );
				log( _count );
				log( _free );

				if( _max )
				{
					log( 'has max ' + _max );
					if( _count > _max )
					{
						return _fail( 'count_too_high' );
					}
				}

				if( _min )
				{
					log( 'has min ' + _min );
					if( _count < _min )
					{
						return _fail( 'count_too_low' );
					}
				}

				let _total = ( _count - _free ) * _price;
				log( 'total' );
				log( _total );
				return _success( _total );
			}
		);
	}

	get_all_pricing()
	{
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_pricing/get_all_pricing' })
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
				.catch(
					( _ret ) =>
					{
						return _fail( _ret );
					}
				)
			}
		);
	}
}
