<?php

use Postmark\PostmarkClient;
use Postmark\Models\PostmarkException;

/**
 *	_comm for all communication needs
 */

class _comm extends _obj
{
	private object $email_client;
	private string $from_email;

	public function __construct()
	{
		parent::__construct( '_comm' );
		$this->log_chan( '_comm' )->log_lvl( 'error' );

		$o_setting = new _setting();
		$api_key = $o_setting->by_key( 'email_api_key' );
		$this->from_email = $o_setting->by_key( 'system_from_email' );
		$this->email_client = new PostmarkClient( $api_key );
	}

	/**
	 * Sends an email via postmark.
	 *
	 * @param array $vars recipient(s), template, from_email, subject, body
	 * @return boolean TRUE on send, FALSE on error
	 */
	public function email( array $vars ) : mixed
	{
		$this->log_data( $vars )->log_msg( 'sending with vars' );
		try
		{
			if( is_array( $vars['recipient'] ) )
			{
				$vars['recipient'] = implode( ',', $vars['recipient'] );
			}

			if( $vars['template'] )
			{
				global $_tpl;
				$tpl_parts = explode( '/', $vars ['template'] );
				$tpl = array_pop( $tpl_parts );
				if( str_starts_with( $tpl, '_' ) )
				{
					$vars['body'] = $_tpl->parse( TPL_CORE . '/' . $vars['template'] . '.html' );
				}
				else
				{
					$vars['body'] = $_tpl->parse( TPL_APP . '/' . $vars['template'] . '.html' );
				}
			}

			$sent = $this->email_client->sendEmail(
				$vars['from_email'] ? $vars['from_email'] : $this->from_email,
				$vars['recipient'],
				$vars['subject'],
				$vars['body']
			);

			$this->log_data( $sent )->log_msg( 'sent return on email send' );
			$this->success( 'email_sent' );
			return $sent;
		}
		catch( PostmarkException $pex )
		{
			$this->log_data( $pex )->log_msg( 'email failed to send' );
			$this->fail( $pex );
			return FALSE;
		}
		catch( Exception $ex )
		{
			$this->log_data( $ex )->log_msg( 'general exception on failed email send' );
			$this->fail( $ex );
			return FALSE;
		}
	}
}
