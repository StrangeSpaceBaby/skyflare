<?php

/**
 *	_mem_reset_ctlr auto-generated
 */

class _mem_reset_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_mem_reset' );
	}

	public function reset( array $token ) : bool
	{
		$reset = $this->obj->valid_reset_token( $token );

		if( !$reset )
		{
			$this->fail( 'reset_token_invalid_or_expired' );
			return FALSE;
		}

		switch( $reset['_mem_reset_type'] )
		{
			case 'password':
				if( !$_POST['reset_login'] || !$_POST['reset_password'] )
				{
					$this->fail( 'login_or_password_missing_for_reset' );
					return FALSE;
				}

				$_mem_auth = new _mem_auth();
				$auth = $_mem_auth->get_current_auth( $reset['fk__mem_id'] );

				if( !$auth )
				{
					$this->fail( 'no_current_auth_for_user' );
					return FALSE;
				}

				if( $auth['_mem_auth_del'] || $auth['_mem_auth_arch'] || !$auth['_mem_auth_active'] )
				{
					$this->fail( 'invalid_token_or_expired' );
					return FALSE;
				}

				$_mem = new _mem();
				$mem = $_mem->get_by_id( $reset['fk__mem_id'] );

				if( $mem['_mem_email'] != $_POST['reset_login'] )
				{
					$this->fail( 'email_does_not_match_account' );
					return FALSE;
				}

				$password_saved = $_mem_auth->save_new_password( $auth['_mem_auth_id'], $_POST['reset_password'] );
				if( FALSE === $password_saved )
				{
					$this->fail( 'could_not_save_new_password' );
					return FALSE;
				}

				$this->obj->expire_reset( $reset['_mem_reset_id'] );
				$this->success( 'password_updated' );
				break;
			default:
				$this->fail( 'invalid_reset_type' );
				return FALSE;
		}

		return TRUE;
	}
}
