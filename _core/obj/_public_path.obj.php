<?php

/**
 *	_public_path auto-generated
 */

class _public_path extends _obj
{
	public function __construct()
	{
		parent::__construct( '_public_path' );
		$this->log_chan( '_public_path' )->log_lvl( 'error' );
	}

	/**
	 * Confirms if path arg is a public path.
	 *
	 * @param string $path full requested path
	 * @return array|boolean _public_path row or FALSE one rror
	 */
	public function is_public_path( string $requested_path ) : array|bool
	{
        list( $ctlr_level, $path, $deep_path, $args ) = explode( '/', $requested_path, 4 );
        $path = $ctlr_level . '/' . $path;
		$deep_path = $deep_path ? $path . '/' . $deep_path : $this->generate_ulid; // Generating a ulid so that the deep path can never be found if there is no deep path

		$public_path = $this->get_by_col([ '_public_path' => [ $ctlr_level, $path, $deep_path ] ]);
		if( FALSE !== $public_path )
		{
			$this->log_data([ $path, $public_path ])->log_msg( 'path_is_public' );
			$this->success( 'is_public_path' );
			return $public_path;
		}

		$this->log_data([ $path ])->log_msg( 'could_not_fetch_path' );
		$this->fail();
		return FALSE;
	}

}
