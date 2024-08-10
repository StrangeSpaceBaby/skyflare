class _tab
{
    constructor( _opts )
    {
        log( '_tab constructor' );
        log( _opts );

        let _defaults = { tabs_content_elem: '.tabs', tab_class: '.tab', tab_nav_class: '.tab-nav' };
        this.opts = { ..._defaults, ..._opts };

        log( '_tab constructor opts' );
        log( this.opts );
        return this;
    }

    showTab( _tab_name )
    {
        console.log( _tab_name );
        console.log( this.opts.tabs_content_elem + ' > ' + this.opts.tab_class );
        console.log( this.opts.tabs_content_elem + ' > #' + _tab_name );
        $( this.opts.tab_class ).addClass( 'd-none' );
        $( this.opts.tab_nav_class ).removeClass( 'active' );
        $( '#' + _tab_name ).removeClass( 'd-none' );
        $( 'a[href="#' + _tab_name + '"]' ).addClass( 'active' );
    }
}
