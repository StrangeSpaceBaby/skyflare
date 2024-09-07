/*
 * _db.js - Manages interactions with an IndexDB database
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

class _db
{
	constructor( _opts )
	{
		// Should have a database name at the minimum
		log( '_db constructor' );
		log( _opts );

		let _defaults = { dbname: null, dbversion: 1, key:{ keyPath: 'id', autoIncrement: true }, store: null, data: {}  };
		this.opts = { ..._defaults, ..._opts };

		log( '_db constructor opts' );
		log( this.opts );

		this.connect();
	}

	get_by_key( _value )
	{
		let _result = this._store.get( _value );
		log( '_db ' + this.opts.dbname + ' get_by_key ' + _value );
		return new Promise(
			( _resolve, _reject ) =>
			{
				if( _result )
				{
					return _resolve( _result );
				}

				return _reject( 'some error occurred get_by_key' );
			}
		);
	}

	insert( _key, _value )
	{
		let $this = this;
		log( '_db insert ' + _key );
		log( $this );
		return new Promise(
			( _resolve, _reject ) =>
			{
				if( !$this.opts.data )
				{
					return _reject( 'No data supplied to insert' );
				}

				let _insert = $this._store.put( _key, _value );
				_insert.onerror =
				function()
				{
					return _reject( _insert.error.name );
				}

				_insert.onsuccess =
				function()
				{
					return _resolve( 'object inserted' );
				}

			}
		)
	}

	connect()
	{
		let $this = this;
		return new Promise(
			( _resolve, _reject ) =>
			{
				let _dbRequest = indexedDB.open( $this.opts.dbname, $this.opts.dbversion );

				_dbRequest.onupgradeneeded =
				function( _event )
				{
					// triggers if client has no database
					// initialize db
					// Need more logic for updates from the api for struct changes
					let _db = _dbRequest.result;
					switch( _event.oldVersion )
					{
						case 0:
							// initialize
							_db.createObjectStore( $this.opts.dbname, { keyPath: $this.opts.key.keyPath, autoIncrement: $this.opts.keyautoIncrement });
						case 1:
							// Update db
					}
				};

				_dbRequest.onerror =
				function()
				{
					log( '_db connect error' );
					log( _dbRequest.error );
					return _reject( _dbRequest.error );
				};

				_dbRequest.onsuccess =
				function()
				{
					let _db = _dbRequest.result;
					_db.onversionchange =
					function()
					{
						_db.close();
						alert( 'Your local information is outdated.  Please save any work and refresh the page.' );
						return _reject( 'Database outdated. Please refresh.' );
					}

					$this._db = _db;
					return _resolve( $this.setTransaction() );
				};

				_dbRequest.onblocked =
				function()
				{
					// This means there is another open connection to the same db and it wasn't properly closed after onversionchange
					alert( 'Please close all other tabs you have open and refresh this page.' );
					return _reject( 'Database blocked' );
				}
			}
		);
	}

	setTransaction()
	{
		this._xaction = this._db.transaction( this.opts.store, "readwrite" );
		this._store = this._xaction.objectStore( this.opts.store );

		return this;
	}

	deleteDB()
	{
		let $this = this;
		return new Promise(
			( _resolve, _reject ) =>
			{
				let _deleteRequest = indexedDB.deleteDatabase( $this.opts.dbname );

				_deleteRequest.onsuccess =
				function()
				{
					return _resolve( 'Database deleted' );
				}

				_deleteRequest.onerror =
				function()
				{
					return _reject( 'Database not deleted' );
				}
			}
		);
	}
}
