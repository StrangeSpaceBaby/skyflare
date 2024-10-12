/*
 * _tab.js - for managing tab interfaces
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

class _tab
{
    constructor( _opts )
    {
        new _log( '_tab constructor' );
        new _log( _opts );

        let _defaults = { tabs_content_elem: '.tabs', tab_class: '.tab', tab_nav_class: '.tab-nav' };
        this.opts = { ..._defaults, ..._opts };

        new _log( '_tab constructor opts' );
        new _log( this.opts );
        return this;
    }

    showTab( _tab_name )
    {
        new _log( _tab_name );
        new _log( this.opts.tabs_content_elem + ' > ' + this.opts.tab_class );
        new _log( this.opts.tabs_content_elem + ' > #' + _tab_name );
        $( this.opts.tab_class ).addClass( 'd-none' );
        $( this.opts.tab_nav_class ).removeClass( 'active' );
        $( '#' + _tab_name ).removeClass( 'd-none' );
        $( 'a[href="#' + _tab_name + '"]' ).addClass( 'active' );
    }
}
