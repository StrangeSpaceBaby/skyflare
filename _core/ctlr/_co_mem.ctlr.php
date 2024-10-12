<?php

class _co_mem_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_co_mem' );
	}

	public function get__co_mems() : array|bool
	{
		$mems = $this->obj->get_co_mems();
		if( FALSE === $mems )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( '_co_mems_fetched' );
		return $mems;
	}

	/**
	 * Saves _co_mem
	 *
	 * @TODO all logic should be moved to obj
	 * @return boolean TRUE on save, FALSE on error
	 */
	public function save() : bool
	{
		if( $_POST['_mem_email'] )
		{
			$_mem_auth = new _mem_auth();

			// $login_exists will be either 0 for available or the _mem_id of the login
			$login_exists = $_mem_auth->check_login_exists( $_POST['_mem_email'] );
			if( FALSE === $login_exists )
			{
				$this->fail( 'could_not_check_login_for_co_mem_save' );
				return FALSE;
			}

			if( $login_exists && $login_exists != $_POST['_co_mem_id'] )
			{
				$this->fail( 'login_already_in_use' );
				return FALSE;
			}
		}

		if( $_POST['_mem_dob'] )
		{
			try
			{
				$dob = new DateTime( $_POST['_mem_dob'] );
				$_POST['_mem_dob'] = $dob->format( 'Y-m-d' );
			}
			catch( Exception $e )
			{
				$this->fail( 'invalid_dob' );
				return FALSE;
			}
		}

		if( $_POST['_mem_fname'] && $_POST['_mem_lname'] )
		{
			$_POST['_mem_name'] = implode( ' ', [ $_POST['_mem_fname'], $_POST['_mem_lname'], ] );
		}

		$co_mem = [];
		if( $_POST['_co_mem_id'] )
		{
			$co_mem = $this->fetch( $_POST['_co_mem_id'] );
		}
		else
		{
			$_mem = new _mem();
			$existing_mem_id = $_mem->check_email_exists( $_POST['_mem_email'] );
			if( $existing_mem_id )
			{
				$_POST['fk__mem_id'] = $existing_mem_id;
			}
			else
			{
				$new_mem = $_mem->new_mem( $_POST );
				if( FALSE === $new_mem )
				{
					$this->fail( 'could_not_create_new_mem' );
					return FALSE;
				}

				$_mem_id = $new_mem['_mem_id'];
				$_POST['fk__mem_id'] = $_mem_id;

				$_mem_auth = new _mem_auth();
				$_mem_auth->save([ 'fk__mem_id' => $_mem_id, '_mem_login' => $_POST['_mem_email'] ]);

				$_mem_reset = new _mem_reset();
				$reset_id = $_mem_reset->create_reset([ 'fk__mem_id' => $_mem_id, '_mem_reset_type' => 'email_verify', '_mem_reset_new_value' => $_POST['_mem_email'] ]);
				$reset = $_mem_reset->get_by_id( $reset_id );

				global $_tpl;

				$_setting = new _setting();
				$app_domain = $_setting->get_by_col([ '_setting_key' => 'app_domain' ])['_setting_value'];
				$product_name = $_setting->get_by_col([ '_setting_key' => 'product_name' ])['_setting_value'];

				$_co = new _co();
				$_tpl->assign( 'recipient_name', $_POST['_mem_name'] );
				$_tpl->assign( 'email_token', $reset['_mem_reset_token'] );

				$domain = $_co->sub( '_co_domain' ) . '.' . $app_domain;
				$_tpl->assign( 'subscriber_domain', $domain );

				$_comm = new _comm();
				$_comm->email([ 'recipient' => $_POST['_mem_email'], 'subject' => 'Welcome to ' . $product_name . '!', 'template' => 'email/_email_verify' ]);
			}
		}

		$co_mem_id = $this->obj->save( $_POST );

		if( FALSE === $co_mem_id )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$this->success( 'member_saved' );
		return $co_mem_id;
	}
}
