<?php

class _api extends _fail
{
	protected int $_co_id = 0;
	protected ?string $_co_ulid = '';
	protected array $envelope;

	public function __construct()
	{
		// Doesn't correlate to a table
		parent::__construct();
		$this->log_chan( '_api' )->log_lvl( 'error' );

		global $_co;

		if( $_co )
		{
			$this->_co_id = $_co->_co( '_co_id' );;
			$this->_co_ulid = $_co->_co( '_co_ulid' );
		}

		$this->new_envelope();
	}

	/**
	 * send() outputs the correct json based on the envelope, sets correct content-type
	 *
	 * @return void
	 */
	public function send() : void
	{
		header( 'Content-Type: application/json' );
		print json_encode( $this->envelope, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_IGNORE | JSON_INVALID_UTF8_SUBSTITUTE | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR );
		exit;
	}

	/**
	 * custom() adds custom information to the envelope under the 'custom' key.
	 * This allows for passthru values to be sent back to the caller.
	 *
	 * @param mixed $add any type of custom data
	 * @param boolean $append whether to append to existing custom data or reset custom data array
	 * @return object $this
	 */
	public function custom( mixed $add = [], bool $append = TRUE ) : object
	{
		if( $append )
		{
			$this->envelope['custom'][] = $add;
		}
		else
		{
			$this->envelope['custom'] = [ $add ];
		}

		return $this;
	}


	/**
	 *	data() accepts any input to create the data header in the envelope.
	 *	Unlike custom(), data() never appends; it always overwrites data.
	 *
	 * @param mixed $data any data to add to envelope
	 * @return object $this
	 */
	public function data( mixed $data = [] ) : object
	{
		if( $data )
		{
			$this->envelope['data'] = $data;
			if( is_array( $data ) )
			{
				$this->envelope['count'] = count( $data );
			}
			else
			{
				$this->envelope['count'] = 0;
			}
		}
		else
		{
			$this->envelope['data'] = array();
			$this->envelope['count'] = 0;
		}

		return $this;
	}

	/**
	 *	_api->fail() is NOT the same as _fail->fail(). Because this method masks the underlying fail method for _fail,
	 *	_fail->fail() does not get called from _api at all. This helps trap all API related errors in one place.
	 *
	 * @param string $msg
	 * @return object $this
	 */
	public function fail( string $msg = '' ) : object
	{
		$this->envelope['msg'] = $msg;
		$this->envelope['return'] = 0;

		return $this;
	}

	/**
	 *	_api->success() is NOT the same as _fail->success(). Because this method masks the underlying success method for _fail,
	 *	_fail->success() does not get called from _api at all.
	 *	@param   string	$msg	A string value of the msg to be sent in the envelope
	 *	@return  object	$this
	 */
	public function success( string $msg = '' ) : object
	{
		$this->envelope['msg'] = $msg;
		$this->envelope['return'] = 1;

		return $this;
	}

	/**
	 *	new_envelope is essentially a reset of the envelope with default values but is also called from __construct()
	 *	@return  object	$this;
	 */
	public function new_envelope() : object
	{
		$this->envelope = [
			'return'	=> 0,
			'msg'		=> 'default_error',
			'data'		=> [],
			'count'		=> 0,
			'custom'	=> []
		];

		return $this;
	}

}
