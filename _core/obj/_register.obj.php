<?php

class _register extends _obj
{
	public function __construct()
	{
		parent::__construct( '_register' );
	}

	public function register__co( array $vars ) : array|bool
	{
		p( 'register__co' );
		$username = $vars['_mem_login'];

		$o__co = new _co();
		$o__mem = new _mem();

		/**
		 * Check if _mem with username already exists.
		 * Just because there is a _mem row, doesn't
		 * mean that they own a _co. A _mem can only 
		 * own one _co
		 */

		$_mem_id = $o__mem->is_duplicate_email( $username );
		if( !$_mem_id )
		{
			$_mem_auth = new _mem_auth();
			$_mem_id = $_mem_auth->check_login_exists( $username );
			if( TRUE === $_mem_id )
			{
				$this->fail( 'could_not_check_for_unique__co_owner' );
				return FALSE;
			}
		}

		if( $_mem_id )
		{
			$_co = $o__co->get_by_owner__mem_id( $_mem_id );
			if( FALSE === $_co )
			{
				$this->fail( $o__co->get_error_msg() );
				return FALSE;
			}

			if( $_co )
			{
				$this->fail( '_mem_already_owns__co' );
				return FALSE;
			}
		}
p( $_mem_id );
		if( $_mem_id )
		{
			p( 'getting_mem by id' );
			$_mem = $o__mem->get_by_id( $_mem_id );
		}
		else
		{
			p( 'creating new mem' );
			$_mem = $o__mem->new_mem( $vars );
		}
p( $_mem );
		if( !$_mem )
		{
			$this->fail( 'could_not_create_new__mem' );
			return FALSE;
		}

		$mem_id = $_mem['_mem_id'];
		$vars['fk__mem_id'] = $mem_id;

		if( !$vars['_co_domain'] )
		{
			$now = new DateTime();
			$vars['_co_domain'] = strtolower( $this->alphaID( $username . $now->format( 'Uu' ) ) );
		}

		if( !$vars['_co_name'] )
		{
			$vars['_co_name'] = 'New company for ' . $_POST['_mem_fname'];
		}

		$vars['_co_ulid'] = $this->generate_ulid();
p( $vars );

		$co = $o__co->new__co( $vars );
		if( FALSE === $co )
		{
			$this->fail( 'co_could_not_be_created' );
			return FALSE;
		}

		$co_id = $co['_co_id'];

		if( $co_id )
		{
			$vars['fk__co_id'] = $co_id; // This will be used in the _mem_auth query in new_mem

			$vars['_mem_reset_type'] = 'email_verify';
			$_mem_reset = new _mem_reset();
			$reset = $_mem_reset->create_reset([ 'fk__mem_id' => $_mem_id, '_mem_reset_type' => 'email_verify', 'fk__co_id' => $co_id ]);
			if( FALSE === $reset )
			{
				$this->fail( '_mem_reset_could_not_be_created' );
				return FALSE;
			}

			// The one exception to the no globals rule
			global $_tpl;

			$_setting = new _setting();
			$setting = $_setting->get_by_col([ '_setting_key' => 'app_domain' ]);
			$app_domain = $setting['_setting_value'];
	
			$setting = $_setting->get_by_col([ '_setting_key' => 'product_name' ]);
			$product_name = $setting['_setting_value'];
	
			$_tpl->assign( 'recipient_name', $vars['_mem_name'] );
			$_tpl->assign( 'email_token', $reset['_mem_reset_token'] );
			$vars['_co_domain'] = $vars['_co_domain'] . '.' . $app_domain;
			$_tpl->assign( 'subscriber_domain', $vars['_co_domain'] );

			$_comm = new _comm();
			$_comm->email([ 'recipient' => $username, 'subject' => 'Welcome to ' . $product_name . '!', 'template' => 'email/_new_co' ]);
			$this->success( '_co_registered' );
			return $vars;
		}

		$this->fail( $this->get_error_msg() );
		return FALSE;
	}
}
