/*
 * _cal.flare.js - Manages calendar functionality including month/year navigation and event display
 * 
 * Requires momentjs 2.29 or later (https://momentjs.com/)
 * 
 * Copyright (c) 2024 Greg Strange
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, subject to
 * including this permission notice in all copies or substantial portions
 * of the Software.
 */

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
				new _log( 'next Month cal' );
				new _log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				new _log( 'currMonth' );
				new _log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.subtract( 1, 'month' );

				new _log( 'actual nextMonth' );
				new _log( _nextMonth );
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
				new _log( 'next Month cal' );
				new _log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				new _log( 'currMonth' );
				new _log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.add( 1, 'year' );

				new _log( 'actual nextMonth' );
				new _log( _nextMonth );
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
				new _log( 'next Month cal' );
				new _log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				new _log( 'currMonth' );
				new _log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.subtract( 1, 'year' );

				new _log( 'actual nextMonth' );
				new _log( _nextMonth );
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
				new _log( 'next Month cal' );
				new _log( _cal );
				let _currMonth = _dom.getData( $this.opts.cal_id, 'calMonth' );
				new _log( 'currMonth' );
				new _log( _currMonth );

				_currMonth = moment( _currMonth );
				let _nextMonth = _currMonth.add( 1, 'month' );

				new _log( 'actual nextMonth' );
				new _log( _nextMonth );
				_dom.setData( $this.opts.cal_id, 'calMonth', _nextMonth.format( 'YYYY-MM-DD') );
				$this.init();
			}
		);
	}

	autocal()
	{
		new _log( '_cal autoload' );

		return new Promise(
			( _success, _fail ) =>
			{
				$( '.autocal' ).each(
					function( _index, _elem )
					{
						new _log( _elem );
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
						new _log( 'cal api errored' );
						new _log( _err );
					}
				);
			}
		);
	}
}
