<?php

class _verify extends _obj
{
	public function __construct()
	{
		parent::__construct( '_mem_reset' );
	}

	/**
	 * Currently only checks wether the email can be mark as verified
	 *
	 * @param array $vars
	 * @return array|boolean
	 */
	public function verify( array $vars ) : array|bool
	{
		$verified = NULL;
		switch( $vars['_mem_reset_type'] )
		{
			case 'email_verify':
				$_mem_reset = new _mem_reset();
				$reset = $_mem_reset->get_by_col([ '_mem_reset_type' => 'email_verify', '_mem_reset_token' => $vars['_mem_reset_token'], '_mem_reset_active' => 1 ]);

				if( !$reset )
				{
					$this->fail( 'no_reset_found_for_token_supplied' );
					return FALSE;
				}

				$_mem = new _mem();
				$saved = $_mem->save([ '_mem_id' => $reset['fk__mem_id'], '_mem_email_verified' => 1 ]);
				if( FALSE === $saved )
				{
					$this->fail( 'could_not_mark_email_verified' );
					return FALSE;
				}

				$this->success( 'email_verified' );
				$verified = $reset;
				break;
			default:
				$this->fail( 'not_a_valid_verification_action' );
				break;
		}

		return $verified;
	}

}
