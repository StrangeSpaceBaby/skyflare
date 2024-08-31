<?php

/**
 * Provides core methods for retrieval of data object
 */
class _obj_data extends _fail
{
	public function __construct( string $obj_name )
	{
		parent::__construct();
		$this->log_chan( $obj_name . '_data' );
	}

	/**
	 * Returns cols defined in child data object
	 *
	 * @return array
	 */
	public function cols() : array|string
	{
		return $this->cols;
	}

	/**
	 * Returns array keys of $cols array
	 *
	 * @return array
	 */
	public function col_names() : array
	{
		return array_keys( $this->cols );
	}

	/**
	 * Returns array of col data by col name
	 *
	 * @param string $col
	 * @return array col array
	 */
	public function col( string $col ) : string
	{
		return $this->cols[$col] ?? FALSE;
	}

	/**
	 * Returns select_cols in requested format
	 *
	 * @param string $format
	 * @return array|string
	 */
	public function select_cols( string $format = 'string' ) : array|string
	{
		switch( $format )
		{
			case 'array':
				return array_keys( $this->select_cols );
			case 'string':
				return implode( ", ", array_keys( $this->select_cols ) );
		}

		return '';
	}

	/**
	 * Excludes passed column names from select_cols and returns the remaining cols in requested format
	 *
	 * @param array $exceptions
	 * @param string $format 'string' only
	 * @return string|array comma-separated string of col names or an array of col names
	 */
	public function filter_select_cols( array $exceptions = [], string $format = 'string' ) :string|array
	{
		$return = $this->select_cols;
		if( $exceptions )
		{
			foreach( $exceptions as $col_name )
			{
				unset( $return[$col_name] );
			}
		}

		return 'string' == $format ? implode( ", ", array_keys( $return ) ) : array_keys( $return );
	}

	/**
	 * Returns full_join array
	 *
	 * @return array
	 */
	public function full_join() : array
	{
		return $this->full_join;
	}
}
