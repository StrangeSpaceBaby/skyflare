class _doc
{
	constructor( _opts )
	{
		log( '_doc constructor' );
		log( _opts );

		let _defaults =
		{
			file_id: null,
			populate: null,
			file_tpl: null
		};

		this.opts = { ..._defaults, ..._opts };

		if( this.opts.file_id && '#' != this.opts.file_id.substring( 0, 1 ) )
		{
			this.opts.file_id = '#' + this.opts.file_id;
		}

		if( this.opts.populate && '#' != this.opts.populate.substring( 0, 1 ) )
		{
			this.opts.populate = '#' + this.opts.populate;
		}

		log( '_doc constructor opts' );
		log( this.opts );
		return this;
	}

	readFile()
	{
		let $this = this;
		return new Promise(
			( _resolve, _reject ) =>
			{
				if( !$this.opts.file_id )
				{
					return _reject( 'file_id does not exist in DOM' );
				}

				let _fileInput = $( $this.opts.file_id );
				log( 'fileInput' );
				log( _fileInput );
				let _files = _fileInput[0].files;
				log( _files );

				if( 'undefined' !== typeof _files && _files.length )
				{
					$( $this.opts.populate ).children().not( '.keep' ).remove();
					for( let _f in _files )
					{
						let _file = _files[_f];
						if( 'object' === typeof _file )
						{
							log( 'readFile '+ _f );
							log( _file );

							_file.index = _f;
							if( !this.acceptableType( _file.type ) )
							{
								return _reject( 'file type not allowed ' + _file.type );
							}

							if( $this.opts.populate )
							{
								log( 'fileInput list populating' );
								$( $this.opts.populate ).append( new _jig({ tpl: $this.opts.file_tpl, data: _file }).popTpl() );

								$( '#doc_thumb_' + _f ).append( $this.fileIcon( _file.type ) );
							}

							return _resolve( _file );
						}
					}

					return _resolve( 'files_processed' );
				}
				else
				{
					log( 'no files to process' );
					return _resolve( 'no_files_to_process' );
				}
			}
		);
	}

	save()
	{
		log( 'new _doc' );
		log( this.opts );
		return new Promise(
			( _success, _fail ) =>
			{
				let _api = new _api({ url: '/_doc/save', data: this.opts })
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

	acceptableType( _format )
	{
		let _exception =
		{
			'application/pdf': 1,
			'application/zip': 1
		};

		let _parts = _format.split( '/' );

		switch( _parts[0] )
		{
			case 'image':
				return true;
			case 'text':
				return true;
			case 'application':
				if( 'undefined' != typeof _exception[_format] && _exception[_format] )
				{
					return true;
				}
				return false;
		}
	}

	fileIcon( _type )
	{
		log( 'fileIcon' );
		log( _type );
		let _fileParts = _type.split("/");
		log( _fileParts );
		let _icon = '<i class="bi bi-file fa-fw fa-2x text-primary"></i>';

		if( 'image' == _fileParts[0] )
		{
			_icon = '<i class="bi bi-file-image fa-fw fa-2x text-primary"></i>';
		}
		else if( 'text' == _fileParts[0] )
		{
			_icon = '<i class="bi bi-file-alt fa-fw fa-2x text-primary"></i>';
		}
		else if( 'application' == _fileParts[0] )
		{
			if( 'pdf' == _fileParts[1] )
			{
				_icon = '<i class="bi bi-file-pdf fa-fw fa-2x text-danger"></i>';
			}
			else if( 'zip' == _fileParts[1] )
			{
				_icon = '<i class="bi bi-file-archive fa-fw fa-2x text-primary"></i>';
			}
		}

		log( _icon );
		return _icon;
	}
}
