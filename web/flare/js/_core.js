$.ajaxSetup({
	beforeSend:
		function( _xhr )
		{
			tablog( _xhr );
			$( '.loader' ).removeClass( 'd-none' );
		},
	complete:
		function( _arg, _arg1, _arg2 )
		{
			$( '.loader' ).addClass( 'd-none' );
		}
});

window.ux = {};
window.ux.tables = {};
window.ux.filters = {};

var o_store = new _store();

var _debug = 1; // _store.fetch( 'debug' );

log( 'init.store' );
log( o_store );
log( _debug );

$().ready(
	function()
	{
		if( !o_store.fetch( 'base_settings' ) )
		{
			new _api({ url: '/_setting/get_base_settings' })
			.poll()
			.then(
				( _ret ) =>
				{
					log( 'base settings return' );
					log( _ret );
					if( 1 == _ret.return )
					{
						o_store.put( 'base_settings', _ret.data );
						for( let _i in _ret.data )
						{
							$( '.' + _i ).html( _ret.data[_i] );
							$( '.' + _i ).val( _ret.data[_i] );
							$( '.' + _i ).attr( 'content', _ret.data[_i] );
						}
					}
				}
			);
		}

		// These three are run to get the macro elements loaded.
		// The subsequent autotpl will load all remote tpls and
		// then process all of these commands on the specific
		// found elements in the loaded tpl
		new _loader({}).autoload();
		new _form({}).autoform();
		new _table({}).autotable();

		new _jig({}).autotpl();
		new _toggle({}).autotoggle();

		new _cal({}).autocal();
	}
);

function log( _log )
{
	if( 'undefined' !== typeof _debug && 1 == _debug )
	{
		console.log( _log );
	}
}

function tablog( _log )
{
	if( 'undefined' !== typeof _debug && 1 == _debug )
	{
		console.table( _log );
	}
}

function growl( _msg, _type )
{
	log( 'growl' );
	log( _msg );
	log( _type );

	new _growl({ msg: _msg, type: _type });
}
