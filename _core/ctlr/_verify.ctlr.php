<?php

class _verify_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_verify' );
	}

	/**
	 * Incomplete method
	 *
	 * @TODO Fix or remove
	 * @deprecated
	 * @param array $token
	 * @return void
	 */
	public function email( array|string $token ) : void
	{
		if( is_array( $token ) )
		{
			$token = array_shift( $token );
		}

		$verified_mem_id = $this->obj->verify([ 'mem_reset_type' => 'email_verify', 'reset_token' => $token ]);
		if( $verified_mem_id )
		{
			global $_mem;

			$_mem->set_me( $verified_mem_id );

p( $_mem->me() );
exit;
			header( 'Location: /', true, 303 ); // redirect to the dashboard if verified since they are now logged in
			exit;
		}
		else
		{
			switch( $this->obj->get_error_msg() )
			{
				case 'token_expired':
					break;
				case 'invalid_token':
					break;
			}
		}
	}
}
