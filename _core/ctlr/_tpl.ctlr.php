<?php

class _tpl_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_tpl' );
		$this->log_chan( '_tpl' );
	}

	/**
	 * Gets tpl content by name (filename)
	 *
	 * @param array|string if array, then it contains a sub directory in the /tpl directory; if string, top level tpl
	 * @return string|boolean template content on success, FALSE on error
	 */
	public function by_name( string|array $name ) : string|bool
	{
		$this->log_data([ $name ])->log_msg( 'by_name arg' );
		if( is_array( $name ) )
		{
			$file = array_pop( $name );
			array_push( $name, $file );
			$name = implode( '/', $name );

			if( $this->is_core( $file ) )
			{
				$filename = TPL_CORE . $name . '.html';
			}
			else
			{
				$filename = TPL_APP . $name . '.html';
			}
		}
		else
		{
			if( $this->is_core( $name ) )
			{
				$filename = TPL_CORE . $name . '.html';
			}
			else
			{
				$filename = TPL_APP . $name . '.html';
			}
		}

		if( file_exists( $filename ) )
		{
			$this->success( 'tpl_fetched' );
			return file_get_contents( $filename );
		}

		$this->fail( 'tpl_not_exist: ' . $name . ' ' . $filename );
		return FALSE;
	}
}
