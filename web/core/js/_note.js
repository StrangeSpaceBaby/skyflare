class _note
{
	constructor( _opts)
	{
		let _defaults = { _note_id: null, _note_obj: null, _note_obj_id: null };

		this.opts = { ..._defaults, ..._opts };

		log( '_note _opts' );
		log( this.opts );
	}

	showChildNotes()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_note/get_child_notes/' + $this.opts._note_id })
				.poll()
				.then(
					( _ret ) =>
					{
						log( 'show_child_notes' );
						tablog( _ret );
						if( 1 == _ret.return )
						{
							new _growl({ growl: _ret.msg, type: 'success' });
							if( 0 != _ret.count )
							{
								let _popTarget = $( '#note_replies_list' );
								_popTarget.children().remove();

								for( let _i in _ret.data )
								{
									let _item = _ret.data[_i];
									$( '#note_replies_list' ).append( new _jig({ tpl: 'note_replies_list_tpl', data: _item, default: '-' }).popTpl() );
								}
							}

							return _success( _ret );
						}

						new _growl({ growl: _ret.msg, type: 'error' });
						return _fail( _ret );
					}
				);
			}
		);
	}

	getNoteCount()
	{
		let $this = this;
		return new Promise(
			( _success, _fail ) =>
			{
				new _api({ url: '/_note/get_child_note_count/' + $this.opts.note_id })
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
				);
			}
		);
	}
}
