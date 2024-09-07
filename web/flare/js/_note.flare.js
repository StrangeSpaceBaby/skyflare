/*
 * _note.js - Sky only. Fetches note content and other metadata about notes for an object.
 * 
 * #review 
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

class _note
{
	constructor( _opts)
	{
		let _defaults = { _note_id: null, _note_obj: null, _note_obj_id: null };

		this.opts = { ..._defaults, ..._opts };

		new _log( '_note _opts' );
		new _log( this.opts );
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
						new _log( 'show_child_notes' );
						new _log({ msg: _ret, publish: 'console.table' });
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
