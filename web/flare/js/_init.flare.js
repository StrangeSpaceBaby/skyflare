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
    #allModules = [
        'loader',
        'form',
        'table',
        'jig',
        'toggle',
        'cal',
        'api',
        'auth',
        'dom',
        'file',
        'follow',
        'growl',
        'store',
    ];

    constructor( _opts = {} )
    {
        let _defaults = { 
            modules: this.#allModules, 
            src: '/flare/js/',
            baseSettingsUrl: '/_setting/get_base_settings', 
            useSky: true,
            moduleConfigs:
			{
                _api:
				{
                    baseUrl: '/',
					loader: { selector: '.loader' }
				},
            }
        };

        this.opts = { ..._defaults, ..._opts };
        this.loadedModules = new Set();
        this.setupGlobalConfig();
		this.loadBaseSettings();
        this.loadModules();
    }

    setupGlobalConfig()
    {
        _config.init( this.opts.moduleConfigs )
        	    .catch(
					( error ) =>
					{
						new _log({ msg: error, publish: 'console.error' })
					}
				);
    }

    loadModules()
    {
        return Promise.all(
			this.opts.modules.map(
                ( module ) =>
                {
                    this.loadModule( module )
                }
            )
            .catch( ( error ) =>
            {
                new _log({ msg: 'loadModules failure', publish: 'console.error' });
                new _log({ msg: error, publish: 'console.error' });
                return reject( error );
            })
		);
    }

    loadModule( module )
    {
        if( this.loadedModules.has( module ) )
        {
            return Promise.resolve();
        }

        return new Promise( ( resolve, reject ) =>
        {
            let script = document.createElement( 'script' );
            script.src = `${this.opts.src}/${module}.flare.js`;

            script.onload = () =>
            {
                this.initializeModule( module );
                resolve();
            };

            script.onerror = ( event ) =>
            {
                let errorMsg = `Failed to load module: ${module}`;
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

            document.head.appendChild( script );
        });
    }

    initializeModule( module )
    {
        switch( module )
        {
            case 'loader':
                new _loader({}).autoload();
                break;
            case 'form':
                new _form({}).autoform();
                break;
            case 'table':
                new _table({}).autotable();
                break;
            case 'jig':
                new _jig({}).autotpl();
                break;
            case 'toggle':
                new _toggle({}).autotoggle();
                break;
            case 'cal':
                new _cal({}).autocal();
                break;
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
	() =>
	{
		new _init()
		.catch(
			( error ) =>
			{
				new _log({ msg: error, publish: 'console.error' }) 
			}
		);
	}, { once: true }
);