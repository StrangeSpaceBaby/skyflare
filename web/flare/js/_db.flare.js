/*
 * _db.js - Manages interactions with an IndexedDB database
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
    constructor( _opts = {} )
    {
        let _defaults = {
            dbName: _config.get( '_db', 'dbName' ) ?? 'FlareDB',
            storeName: _config.get( '_db', 'storeName' ) ?? 'FlareStore',
            version: _config.get( '_db', 'version' ) ?? 1,
            schemaUrl: _config.get( '_db', 'schemaUrl' ) ?? '/api/db-schema'
        };

        this.opts = { ..._defaults, ..._opts };
        this.db = null;
        this.schemaConfig = null;
    }

    #fetchSchema()
    {
		let $this = this;
        return new Promise(
			( _resolve, _reject ) =>
			{
				new _api({ url: $this.opts.schemaUrl })
				.poll()
				.then( ( response ) =>
				{
					let schema = JSON.parse( response );
					if( !schema[$this.opts.version] )
					{
						return _reject( new Error( `No schema definition found for version ${$this.opts.version}` ) );
					}

					return _resolve( response );
				});
			}
		); 
    }

    #open()
    {
		let $this = this;
        return new Promise(
			( _resolve, _reject ) =>
			{
				let request = indexedDB.open( $this.opts.dbName, $this.opts.version );

				request.onupgradeneeded = 
				( event ) =>
				{
					$this.#fetchSchema()
					.then(
						( schema ) =>
						{
							let db = event.target.result;
							let transaction = event.target.transaction;
							let oldVersion = event.oldVersion;
		
							for ( let version = oldVersion + 1; version <= $this.opts.version; version++ )
							{
								if( schema[version] )
								{
									schema[version].forEach(
										( update ) =>
										{
											$this.#applySchemaUpdate( db, transaction, update )
											.catch(
												( error ) =>
												{
													return _reject( error );
												}
											);
										}
									);
								}
							}

							return _resolve( `${$this.opts.dbName} updated from version ${event.oldVersion} to ${$this.opts.version}` );
						}
					)
					.catch(
						( error ) =>
						{
							return _reject( error );
						}
					);
				};

				request.onsuccess = 
				( event ) =>
				{
					$this.db = event.target.result;
					_resolve( $this.db );
				};

				request.onerror = 
				( event ) =>
				{
					_reject( `Database error: ${event.target.error}` );
				};
			}
		);
    }

    #applySchemaUpdate( db, transaction, update )
    {
		return new Promise(
			( _resolve, _reject ) =>
			{
				switch ( update.action )
				{
					case 'createStore':
						db.createObjectStore( update.store, update.options );
						break;
					case 'deleteStore':
						db.deleteObjectStore( update.store );
						break;
					case 'createIndex':
						let store = transaction.objectStore( update.store );
						store.createIndex( update.index, update.keyPath, update.options );
						break;
					case 'deleteIndex':
						store = transaction.objectStore( update.store );
						store.deleteIndex( update.index );
						break;
					default:
						console.warn( `Unknown schema update action: ${update.action}` );
						return _reject( new Error( `Unknown schema update action: ${update.action}` ) );
				}

				return _resolve( `${update.action} performed` );
			}
		)
    }

    #close()
    {
        if( this.db )
        {
            this.db.close();
            this.db = null;
        }
    }

    save( data, key = null )
    {
        return this.#open()
            .then( () =>
            {
                return new Promise( ( resolve, reject ) =>
                {
                    let transaction = this.db.transaction([this.opts.storeName], 'readwrite');
                    let store = transaction.objectStore( this.opts.storeName );
                    let request = key ? store.put( data, key ) : store.put( data );

                    request.onerror = 
                    () =>
                    {
                        reject( request.error );
                    };
                    request.onsuccess = 
                    () =>
                    {
                        resolve( request.result );
                    };
                });
            })
			.catch( ( error ) => { return reject( error ) } )
            .finally( () => this.#close() );
    }

    select( key )
    {
        return this.#open()
            .then( () =>
            {
                return new Promise( ( resolve, reject ) =>
                {
                    let transaction = this.db.transaction([this.opts.storeName], 'readonly');
                    let store = transaction.objectStore( this.opts.storeName );
                    let request = store.get( key );

                    request.onerror = 
                    () =>
                    {
                        reject( request.error );
                    };
                    request.onsuccess = 
                    () =>
                    {
                        resolve( request.result );
                    };
                });
            })
			.catch( ( error ) => { return reject( error ) } )
            .finally( () => this.#close() );
    }

    deleteFrom( key )
    {
        return this.#open()
            .then( () =>
            {
                return new Promise( ( resolve, reject ) =>
                {
                    let transaction = this.db.transaction([this.opts.storeName], 'readwrite');
                    let store = transaction.objectStore( this.opts.storeName );
                    let request = store.delete( key );

                    request.onerror = 
                    () =>
                    {
                        reject( request.error );
                    };
                    request.onsuccess = 
                    () =>
                    {
                        resolve();
                    };
                });
            })
			.catch( ( error ) => { return reject( error ) } )
            .finally( () => this.#close() );
    }

    clear()
    {
        return this.#open()
            .then( () =>
            {
                return new Promise( ( resolve, reject ) =>
                {
                    let transaction = this.db.transaction([this.opts.storeName], 'readwrite');
                    let store = transaction.objectStore( this.opts.storeName );
                    let request = store.clear();

                    request.onerror = 
                    () =>
                    {
                        reject( request.error );
                    };
                    request.onsuccess = 
                    () =>
                    {
                        resolve();
                    };
                });
            })
			.catch( ( error ) => { return reject( error ) } )
            .finally( () => this.#close() );
    }

    getAll()
    {
        return this.#open()
            .then( () =>
            {
                return new Promise( ( resolve, reject ) =>
                {
                    let transaction = this.db.transaction([this.opts.storeName], 'readonly');
                    let store = transaction.objectStore( this.opts.storeName );
                    let request = store.getAll();

                    request.onerror = 
                    () =>
                    {
                        reject( request.error );
                    };
                    request.onsuccess = 
                    () =>
                    {
                        resolve( request.result );
                    };
                });
            })
			.catch( ( error ) => { return reject( error ) } )
            .finally( () => this.#close() );
    }
}