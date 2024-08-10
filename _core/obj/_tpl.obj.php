<?php

class _tpl extends _obj
{
	private array $assigned;
	private string $tpl;

	public function __construct()
	{
		$this->assigned = [];
	}

	/**
	 * Adds key/value pair to assigned array
	 *
	 * @param string $key
	 * @param string $val
	 * @return object $this
	 */
	public function assign( string $key, mixed $val ) : object
	{
		$this->assigned[$key] = $val;
		return $this;
	}

	/**
	 * Parses template for all tpl commands
	 *
	 * @param string $template
	 * @return string interpolated tpl content
	 */
	public function parse( string $template ) : string
	{
		$this->tpl = file_get_contents( $template );

		$this->replace_includes(); // Must come first to interpolate everything at once
		// Maybe these two should be switched in order.  Removing if blocks would reduce the number of assignments to replace
		$this->replace_assigned(); // Assigned values go second so they can be removed and reduce ambiguity
		$this->parse_ifs(); // Display or remove any if blocks

		return $this->tpl;
	}

	/**
	 * Shoudl parse if statements but currently exits for no reason.
	 *
	 * @TODO fix this
	 * @return void
	 */
	protected function parse_ifs() : void
	{
		preg_match_all( '/\~\~if\:(.+)\~\~/', $this->tpl, $matches, PREG_SET_ORDER );

		if( $matches )
		{
			foreach( $matches as $match => $conditional )
			{
				$if = $conditional[0];
				$val = $conditional[1];
				$pattern = "/\~\~if\:{$val}\~\~\s*(.+)\s*\~\~\/if\:{$val}\~\~/is";
				preg_match( $pattern, $this->tpl, $if_block );
			}

			exit;
		}
	}

	/**
	 * Searches $this->tpl for all include statements and
	 * then finds the templates to include and replaces the include command
	 *
	 * @return void
	 */
	protected function replace_includes() : void
	{
		preg_match_all( '/\~\~include\:(.+)\~\~/', $this->tpl, $matches, PREG_PATTERN_ORDER );

		if( $matches )
		{
			while( $matches[1] )
			{
				$match = array_shift( $matches[1] );

				if( FALSE !== strpos( $match, '/' ) )
				{
					$match_parts = explode( '/', $match );
					$tpl = array_pop( $match_parts );
					if( str_starts_with( $tpl, '_' ) )
					{
						$filename = TPL_CORE . $match . '.html';
					}
					else
					{
						$filename = TPL_APP . $match . '.html';
					}
				}
				else
				{
					$filename = TPL_APP . $match . '.html';
					if( '_' == substr( $match, 0, 1 ) )
					{
						$filename = TPL_CORE . $match . '.html';
					}
				}

				$contents = file_get_contents( $filename );
				if( !$contents )
				{
					$contents = '<!-- No contents for ' . $filename . ' -->';
				}
				$this->tpl = str_replace( '~~include:' . $match . '~~', $contents, $this->tpl );

				preg_match_all( '/\~\~include\:(.+)\~\~/', $this->tpl, $matches, PREG_PATTERN_ORDER );
			}
		}
	}

	/**
	 * Using the assign array, loops through the keys to find
	 * the merge and replace it with the assigned value.
	 *
	 * @return void
	 */
	protected function replace_assigned() : void
	{
		foreach( $this->assigned as $key => $val )
		{
			if( is_array( $val ) )
			{
				$this->replace_array( $key, $val );
			}
			else
			{
				$this->tpl = str_replace( '~~' . $key . '~~', $val, $this->tpl );
			}
		}
	}


	/**
	 * Thjis allows for one-depth array value to be interpolated
	 *
	 * @param string $array_name
	 * @param array $array
	 * @return void
	 */
	protected function replace_array( string $array_name, array $array ) : void
	{
		foreach( $array as $key => $val )
		{
			if( is_array( $val ) )
			{
				$this->replace_array( $key, $val );
			}
			else
			{
				$this->tpl = str_replace( '~~' . $array_name . '.' . $key . '~~', $val, $this->tpl );
			}
		}
	}

	public function get_assigned() : array
	{
		return $this->assigned;
	}
}
