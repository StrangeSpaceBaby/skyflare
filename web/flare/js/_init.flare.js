/*
 * _init.flare.js - Initializes core functionality for the Flare framework, sets up global configuration
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

class _init
{
    #allflares = [
        '_log',
        '_dom',
        '_jig',
        '_config',
        '_growl',
        '_api',
        '_loader',
        '_form',
        '_table',
        '_toggle',
        '_cal',
        '_auth',
        '_file',
        '_follow',
        '_store',
    ];

    #loadedflares = [];
    
    constructor( _opts = {} )
    {
        let _defaults = { 
            flares: this.#allflares, 
            src: '/flare/js/',
            baseSettingsUrl: '/_setting/get_base_settings', 
            useSky: true,
            flareConfigs:
			{
                _api:
				{
                    baseUrl: '/',
					loader: { selector: '.loader' }
				},
            }
        };

        this.opts = { ..._defaults, ..._opts };
        this.loadflares()
            .then(
                () =>
                {
                    new _log( 'loadflares ended in constructor' );
                    this.setupGlobalConfig();
                    this.loadBaseSettings();
                    this.callAutoFunctions();
                }
            )
            .catch(
                ( error ) =>
                {
                    return Promise.reject( error );
                }
            );

        return Promise.resolve();
    }

    setupGlobalConfig()
    {
        console.log( this.#loadedflares );
        _config.init( this.opts.flareConfigs )
        	    .catch(
					( error ) =>
					{
						new _log({ msg: error, publish: 'console.error' })
					}
				);
    }

    loadflares()
    {
        console.log( this.#loadedflares );
        let flares = [];
        (this.opts.flares).forEach(
            ( flare ) =>
            {
                flares.push(
                    this.loadflare( flare )
                    .catch(
                        function( error )
                        {
                            new _log({ msg: 'loadflares failure', publish: 'console.error' });
                            new _log({ msg: error, publish: 'console.error' });
                            return Promise.reject( error );
                        }
                    )
                )
            }
        );

        return Promise.all(flares);
    }

    loadflare( flare )
    {
        if( (this.#loadedflares).includes( flare ) )
        {
            return Promise.resolve();
        }

        return new Promise(
            ( resolve, reject ) =>
            {
                let script = document.createElement( 'script' );
                script.src = `${this.opts.src}${flare}.flare.js`;
                script.async = false;

                script.onload = () =>
                {
                    (this.#loadedflares).push( flare );
                    resolve();
                };

                script.onerror = ( event ) =>
                {
                    let errorMsg = `Failed to load flare: ${flare}`;
                    if( event.error )
                    {
                        errorMsg += `\nError: ${event.error.message}`;
                        if( event.error.stack )
                        {
                            errorMsg += `\nStack: ${event.error.stack}`;
                        }
                    }
                    reject( new Error( errorMsg ) );
                };

                document.body.appendChild( script );
            }
        );
    }

    callAutoFunctions()
    {
        let flareOrder = [ '_loader', '_form', '_table', '_jig', '_toggle', '_cal' ];

        for( let index in flareOrder )
        {
            let flare = flareOrder[index];
            if( !(this.#loadedflares).includes( flare ) )
            {
                new _log( flare + ' was not loaded for initialization' );
                return Promise.reject();
            }

            switch( flare )
            {
                case '_loader':
                    new _loader({}).autoload();
                    break;
                case '_form':
                    new _form({}).autoform();
                    break;
                case '_table':
                    new _table({}).autotable();
                    break;
                case '_jig':
                    new _jig({}).autotpl();
                    break;
                case '_toggle':
                    new _toggle({}).autotoggle();
                    break;
                case '_cal':
                    new _cal({}).autocal();
                    break;
            }
        }
    }

    loadBaseSettings()
    {
        if( !this.opts.useSky && !this.opts.baseSettingsUrl )
        {
            return Promise.reject( 'Base settings URL not set for non-Sky backend' );
        }

        return new _api({ url: this.opts.baseSettingsUrl })
            .poll()
            .then( ( _response ) =>
            {
                new _store().put( 'base_settings', _response );
                for( let _key in _response )
                {
                    document.querySelectorAll( `.${_key}` ).forEach(
						( elem, index ) => 
                    	{
                        	elem.textContent = _response[_key];
                        	elem.value = _response[_key];
                    	}
					);
                }

                return Promise.resolve();
            })
            .catch( ( _error ) =>
            {
                new _log({ msg: 'Base settings failure', publish: 'console.error' });
                new _log({ msg: _error, publish: 'console.table' });
                return Promise.reject( _error );
            });
    }
}

document.addEventListener( 'DOMContentLoaded', 
	function()
	{
		new _init()
		.catch(
			( error ) =>
			{
				console.table( error );
			}
		);
	}, { once: true }
);