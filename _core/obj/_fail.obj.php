<?php

/**
 *	_fail is the bubble up final container for errors within a class.  Since most
 *	things are classed, this caprures roughly 90% of all reported errors.
 */

class _fail extends _log
{
	protected array $err = [ 'error' => 0, 'token' => 'General error' ];

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	/**
	 * err() returns the $this->err which is populated by the various methods
	 * in this class. Generally calling
	 * <code>if( $obj->failed() ) { print $obj->err(); }</code>
	 * will provide the debug info for the reported error.
	 *
	 * @return  array	$this->err
	 */
	public function err() : array
	{
		return $this->err;
	}

	/**
	 * Returns just the error message for last action
	 *
	 * @return string error message
	 */
	public function get_error_msg() : string
	{
		return $this->err['token'];
	}

	/**
	 * failed() returns TRUE if $this->err['result'] == 0
	 * @return bool $this->err['result']
	 */

	public function failed() : bool
	{
		return $this->err['error'] ? FALSE : TRUE;
	}

	/**
	 * fail() is called prior to a method return to identify the object error
	 * state and provide an error message.
	 *
	 * @param string $token	The error token that will then be translated on the front end
	 * @return object $this
	 */
	public function fail( string $token = '' ) : object
	{
		$this->err['error'] = 0;
		if( $token )
		{
			$this->err['token'] = $token;
		}

		header( 'result_message: ' . $token, TRUE );
		return $this;
	}

	/**
	 * success() is called prior to a method return to identify the object error
	 * state as successful and provide a success message
	 *
	 * @param string $token	The success token that will then be translated on the front end
	 * @return object $this
	 */
	public function success( string $token = '' ) : object
	{
		$this->err['error'] = 1;
		if( $token )
		{
			$this->err['token'] = $token;
		}

		header( 'result_message: ' . $token, TRUE );
		return $this;
	}

	/**
	 * init() is called by __construct() but could theoretically be called
	 * at any time you want to reset an error state such as in a foreach.
	 *
	 * @return  object	$this
	 */
	protected function init() : object
	{
		$this->err = [ 'error' => 0, 'token' => 'General error' ];

		return $this;
	}
}
