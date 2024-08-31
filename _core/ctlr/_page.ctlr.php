<?php

class _page_ctlr extends _ctlr
{
	private object $_tpl;

	public function __construct()
	{
		parent::__construct( '_page' );

		$this->_tpl = new _tpl();
	}

	public function show( string $page ) : void
	{
		$page_script = '';
		$page_tpl = '';
		if( str_starts_with( $page, '_' ) )
		{
			$page_script = PAGE_CORE . $page . '.php';
			$page_tpl = TPL_CORE . '/page/' . $page . '.html';
		}
		else
		{
			$page_script = PAGE_APP . $page . '.php';
			$page_tpl = TPL_APP . '/page/' . $page . '.html';
		}
	
		try
		{
			if( !file_exists( $page_script ) )
			{
				throw new Exception( 'page_does_not_exist: ' . $page_script );
			}
			else
			{
				require_once( $page_script );

				$this->_tpl->assign( '_co', (new _co())->_co() );
				$this->_tpl->assign( 'me', (new _mem())->me() );

				print $this->_tpl->parse( $page_tpl );
			}
		}
		catch( Exception $e )
		{
			$this->_tpl->assign( 'message', $e->getMessage() );
			print $this->_tpl->parse( TPL_CORE . 'error/_404.html' );
		}
	
		exit;
	}
}
