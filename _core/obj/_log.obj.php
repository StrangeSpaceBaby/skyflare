<?php

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 *	_log manages everything related to logging in the application.  Using Monolog,
 *	_log manages channels for message differentiation and logs to the appropriate channels.
 */

 #[AllowDynamicProperties]
class _log
{
	protected $channels;
	protected $curr_channel;
	protected $log_level = 'debug';
	protected $log_level_num;
	protected $log_msg;
	protected $log_data;

	public function __construct()
	{
		$this->channels = [];
	}

	/**
	 * Adds or appends passed data to log_data array
	 *
	 * @param mixed $data data to log
	 * @param boolean $append whether or not to append to existin data or overwrite existing data array
	 * @return object $this
	 */
	protected function log_data( mixed $data, bool $append = TRUE ) : object 
	{
		if( !$append )
		{
			$this->log_data = $data;
		}
		else
		{
			$this->log_data[] = $data;
		}

		return $this;
	}

	/**
	 * Sets log channel
	 *
	 * @param string $channel_name
	 * @return object $this
	 */
	protected function log_chan( string $channel_name ) : object
	{
		$this->channel( $channel_name );
		$this->curr_channel = $channel_name;
		return $this;
	}

	/**
	 * Sets log level to ignore lower log level messages
	 *
	 * @param string $lvl debug,info,notice,warning,error,critical,alert,emergency
	 * @return object
	 */
	protected function log_lvl( string $lvl ) : object
	{
		$lvl = strtolower( $lvl );
		switch( $lvl )
		{
			case 'debug':
				$this->log_level = 'DEBUG';
				$this->log_level_num = 100;
				break;
			case 'info':
				$this->log_level = 'INFO';
				$this->log_level_num = 200;
				break;
			case 'notice':
				$this->log_level = 'NOTICE';
				$this->log_level_num = 250;
				break;
			case 'warning':
				$this->log_level = 'WARNING';
				$this->log_level_num = 300;
				break;
			case 'error':
				$this->log_level = 'ERROR';
				$this->log_level_num = 400;
				break;
			case 'critical':
				$this->log_level = 'CRITICAL';
				$this->log_level_num = 500;
				break;
			case 'alert':
				$this->log_level = 'ALERT';
				$this->log_level_num = 550;
				break;
			case 'emergency':
				$this->log_level = 'EMERGENCY';
				$this->log_level_num = 600;
				break;
		}

		return $this;
	}

	/**
	 * Sets log_msg and returns the log object.
	 *
	 * @param string $msg
	 * @return object $this->log()
	 */
	protected function log_msg( string $msg ) : object
	{
		$this->log_msg = $msg;
		return $this->log();
	}

	/**
	 *	channel() checks to see if the requested channel exists.  If not, the
	 *	channel is automatically created and logging starts.
	 *
	 * @param string $channel_name
	 * @return object $this
	 */
	protected function channel( string $channel_name ) : object
	{
		if( $channel_name && !$this->channels[$channel_name] )
		{
			$this->channels[$channel_name] = new Logger( $channel_name );

			$stream = new StreamHandler( LOG . $channel_name . '.log' );
			$stream->setFormatter( new JsonFormatter() );
			$this->channels[$channel_name]->pushHandler( $stream );
		}

		return $this;
	}

	/**
	 * Returns an array of all log settings
	 *
	 * @return array
	 */
	protected function get_log_opts() : array
	{
		return [
			'chan' => $this->curr_channel,
			'type' => $this->log_level,
			'context' => $this->log_data,
			'msg' => $this->log_msg
		];
	}

	/**
	 *	log() is the workhorse. Accepting an array of options like chan, msg, type, and context,
	 *	log() manages the formation fo the log message and its direction to the correct channel.
	 *
	 *	@param   array 	$opts	Array of options to define the log message
	 *	@return  object	$this
	 */
	public function log( array $opts = [] ) : object
	{
		if( !$opts )
		{
			$opts = $this->get_log_opts();
		}

		if( !$this->channels[$opts['chan']] )
		{
			$this->channel( $opts['chan'] );
		}

		$type = $opts['type'];
		if( !$opts['context'] )
		{
			$opts['context'] = [];
		}

		if( !is_array( $opts['context'] ) )
		{
			$opts['context'] = array( $opts['context'] );
		}

		$opts['context']['class'] = get_called_class();

		$this
		->channels[$opts['chan']]
		->$type( $opts['msg'], $opts['context'] );

		return $this;
	}
}
