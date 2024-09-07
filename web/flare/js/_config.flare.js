/*
 * _config.flare.js - Provides an interface for API interactions with token management and access verification
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

class _config
{
	static get( module, key )
	{
		if (!window.flareConfigData)
		{
			new _log({ msg: 'Flare configuration not initialized', publish: 'console.error' });
			return undefined;
		}

		let value = key ? window.flareConfigData[module]?.[key] : window.flareConfigData[module];
		if( 'undefined' == typeof value )
		{
			new _log({ msg: `Config not found for ${module}${key ? '.' + key : ''}`, publish: 'console.warn' });
	  	}

		return value;
	}
  
	static init( moduleConfigs )
	{
		if( window.flareConfigData	)
		{
			return Promise.reject( 'Flare configuration is already loaded. It cannot be changed.' );
		}

		window.flareConfigData = Object.freeze( moduleConfigs );
		return Promise.resolve();
	}
}
