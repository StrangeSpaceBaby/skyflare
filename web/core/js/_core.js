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

		$(".modal-header").on("mousedown", function(mousedownEvt)
		{
			var $draggable = $(this);
			var x = mousedownEvt.pageX - $draggable.offset().left,
				y = mousedownEvt.pageY - $draggable.offset().top;

			$("body").on("mousemove.draggable", function(mousemoveEvt)
			{
				$draggable.closest(".modal-dialog").offset({
					"left": mousemoveEvt.pageX - x,
					"top": mousemoveEvt.pageY - y
				});
			});

			$("body").one("mouseup", function()
			{
				$("body").off("mousemove.draggable");
			});

			$draggable.closest(".modal").one("bs.modal.hide", function()
			{
				$("body").off("mousemove.draggable");
			});
		});

		$( '#scrim' ).remove();
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

function auth()
{
	log( 'auth sending' );
	log( $( '#auth_user__mem_login' ).val() );
	log( $( '#auth_user__mem_password' ).val() );

	new _api({ url: '/_auth/password', data: { username: $( '#auth_user__mem_login' ).val(), password: $( '#auth_user__mem_password' ).val() } })
		.poll()
		.then(
			( _ret ) =>
			{
				if( 1 == _ret.return )
				{
					log( 'init.auth _ret' );
					tablog( _ret );

					new _growl({ growl: _ret.msg, type: _ret.return ? 'success' : 'danger' });

					log( typeof _ret.auth_token );
					log( _ret.auth_token );
					if( 'undefined' !== typeof _ret.auth_token )
					{
						let o_store = new _store();
						o_store.put( 'auth_token', _ret.auth_token );
						o_store.put( 'auth_token_type', _ret.token_type );
						o_store.put( 'auth_token_scope', _ret.scope );

						let _moment = new moment();
						_moment.add( _ret.expires_in, 'seconds' );
						o_store.put( 'auth_token_expires', _moment.format( 'X' ) );
					}

					window.location.href = window.location.href;
				}
				else
				{
					log( 'init.auth failed' );
					tablog( _ret );
				}
			}
		)
		.catch(
			( _xhr, _textStatus, _errorThrown ) =>
			{
				log( 'auth error' );
				log( _xhr );
				log( _textStatus );
				log( _errorThrown );
			}
		);
}

function register()
{
	let _username = $( '#auth_user__mem_login' ).val();
	let _usernameVerify = $( '#auth_user__mem_login_verify' ).val();

	if( _username != _usernameVerify )
	{
		growl( 'register_username_mismatch', { type: 'danger' } );
		return false;
	}

	if( !$( '#auth_user_tos_agree' ).is( ':checked' ) )
	{
		growl( 'register_tos_not_checked', { type: 'danger' } );
		return false;
	}

	$.post(
		'/_register/register',
		{
			_mem_login: _username,
			_mem_login_verify: _usernameVerify,
			tos_agree: $( '#auth_user_tos_agree' ).is( ':checked' ),
		}
	)
	.done(
		function( _ret )
		{
			log( 'register.auth _ret' );
			tablog( _ret.data );

			growl( _ret.msg, { type: _ret.return ? 'success' : 'danger', 'delay': 10000 } );

			if( 1 == _ret.return )
			{
				log( typeof _ret.data.auth_token );
				log( _ret.data.auth_token );
				if( 'undefined' !== typeof _ret.data.auth_token )
				{
					let _store = new _store();
					_store.put( 'auth_token', _ret.auth_token );
					_store.put( 'auth_token_type', _ret.token_type );
					_store.put( 'auth_token_scope', _ret.scope );

					let _moment = new moment();
					_moment.add( _ret.expires_in, 'seconds' );
					_store.put( 'auth_token_expires', _moment.format( 'X' ) );

				}

				log( 'redirect post auth' );
				log( 'https://' + _ret.data.subscriber_domain );
				window.location.href = 'https://' + _ret.data.subscriber_domain;
			}
		}
	)
	.fail(
		function( _xhr, _textStatus, _errorThrown )
		{
			log( 'init.auth failed' );
			tablog( _xhr );
			log( _textStatus );
			log( _errorThrown );
		}
	);
}

function growl( _msg, _type )
{
	log( 'growl' );
	log( _msg );
	log( _type );

	new _growl({ msg: _msg, type: _type });
}
