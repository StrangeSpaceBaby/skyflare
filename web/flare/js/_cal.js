class _cal
{
	constructor( _opts )
	{
		let _defaults = { cal_id: null };
		this.opts = { ..._defaults, ..._opts };

		return this;
	}

	prevMonth()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _cal = $( $this.opts.cal_id );
				log( 'next Month cal' );
				log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				log( 'currMonth' );
				log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.subtract( 1, 'month' );

				log( 'actual nextMonth' );
				log( _nextMonth );
				_dom.setData( $this.opts.cal_id, 'calMonth', _nextMonth.format( 'YYYY-MM-DD') );
				$this.init();
			}
		);
	}

	nextYear()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _cal = $( $this.opts.cal_id );
				log( 'next Month cal' );
				log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				log( 'currMonth' );
				log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.add( 1, 'year' );

				log( 'actual nextMonth' );
				log( _nextMonth );
				_dom.setData( $this.opts.cal_id, 'calMonth', _nextMonth.format( 'YYYY-MM-DD') );
				$this.init();
			}
		);
	}

	prevYear()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _cal = $( $this.opts.cal_id );
				log( 'next Month cal' );
				log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				log( 'currMonth' );
				log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.subtract( 1, 'year' );

				log( 'actual nextMonth' );
				log( _nextMonth );
				_dom.setData( $this.opts.cal_id, 'calMonth', _nextMonth.format( 'YYYY-MM-DD') );
				$this.init();
			}
		);
	}

	nextMonth()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				let _cal = $( $this.opts.cal_id );
				log( 'next Month cal' );
				log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				log( 'currMonth' );
				log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.add( 1, 'month' );

				log( 'actual nextMonth' );
				log( _nextMonth );
				_dom.setData( $this.opts.cal_id, 'calMonth', _nextMonth.format( 'YYYY-MM-DD') );
				$this.init();
			}
		);
	}

	autocal()
	{
		log( '_cal autoload' );

		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autocal' ).each(
					function( _index, _elem )
					{
						log( _elem );
						new _cal({ cal_id: $( _elem ).prop( 'id' ) }).init();
					}
				)

				return _success( 'autoloaded' );
			}
		);
	}

	init()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				if( !$this.opts.cal_id )
				{
					return _fail( 'No calender found' );
				}

				let _month = _dom.getData( $this.opts.cal_id, 'calMonth' );
				let _today = '';
				let _currMonth = '';
				if( !_month || 'undefined' == typeof _month )
				{
					_today = moment( moment().format( 'YYYY-MM-01' ) );
					_currMonth = _today.format( 'YYYY-MM' );
				}
				else
				{
					_today = moment( _month );
					_currMonth = _today.format( 'YYYY-MM' );
				}

				_dom.setData( $this.opts.cal_id, 'calMonth', _today.format( 'YYYY-MM-DD' ) );
				$( '.cal-month-name' ).html( _today.format( 'MMMM YYYY' ) );

				_today.startOf( 'week' );
				let _startMonth = moment( _today.format( 'YYYY-MM-DD' ) );

				let _iterate = 1;
				while( 43 != _iterate )
				{
					$( '.cal-day-' + _iterate + '> .cal-date' ).html( _startMonth.format( 'DD' ) );

					if( _startMonth.format( 'YYYY-MM' ) != _currMonth.format( 'YYYY-MM' ) )
					{
						$( '.cal-day-' + _iterate ).addClass( 'dark-date' );
					}
					else
					{
						$( '.cal-day-' + _iterate ).removeClass( 'dark-date' );
					}

					$( '.cal-day-' + _iterate + ' > ul.day-events' ).prop( 'id', 'cal-day-' + _startMonth.format( 'YYYY-MM-DD' ) );

					_startMonth.add( 1, 'days');
					_iterate++;
				}

				let _src = _dom.getData( $this.opts.cal_id, 'src' ) + _dom.getData( $this.opts.cal_id, 'calMonth' );
				let _tpl = _dom.getData( $this.opts.cal_id, 'dayTpl' );

				new _api({ url: _src }).
				poll().
				then(
					( _ret ) =>
					{
						if( 1 == _ret.return )
						{
							$( '.cal-event' ).remove();
							if( 0 != _ret.count )
							{
								for( let _i in _ret.data )
								{
									let _item = _ret.data[_i];
									let _date = moment( _item.vol_shift_start );
									$( '#cal-day-' + _date.format( 'YYYY-MM-DD' ) ).append( new _jig({ tpl: _tpl, data: _item, default: '' }).popTpl() )
								}
							}
						}
					}
				)
				.catch(
					( _err ) =>
					{
						log( 'cal api errored' );
						log( _err );
					}
				);
			}
		);
	}
}
