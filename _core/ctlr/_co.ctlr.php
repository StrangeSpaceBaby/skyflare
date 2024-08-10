<?php

class _co_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_co' );
	}

	/**
	 * Should be moved to _co_pref ctlr
	 *
	 * @deprecated
	 * @return bool
	 */
	public function save_email_footer() : bool
	{
		$_co_pref = new _co_pref();
		$footer = $_co_pref->pref( 'email_footer' );

		if( FALSE === $_co_pref->pref( 'email_footer', _POST['new_email_footer'] ) )
		{
			$this->fail( 'could_not_update_email_footer' );
			return FALSE;
		}

		$this->success( 'footer_updated' );
		return TRUE;
	}

	/**
	 * Allows for changing the subdomain of an existing _co.
	 *
	 * @TODO logic should be moved to _co obj
	 * @return string|boolean
	 */
	public function save_subdomain() : string|bool
	{
		// Clean subdomain of incoming for illegal chars
		_POST['new_subdomain'] = strtolower( html_entity_decode( _POST['new_subdomain'] ) );

		if( _POST['new_subdomain'] == $this->obj->sub( '_co_domain' ) )
		{
			$this->fail( 'subdomain_is_unchanged' );
			return FALSE;
		}

		if( str_starts_with( _POST['new_subdomain'], '-' ) || str_ends_with( _POST['new_subdomain'], '-' ) )
		{
			$this->fail( 'subdomain_cannot_start_or_end_with_hyphen' );
			return FALSE;
		}

		preg_match_all( '/[^A-Za-z0-9\-]/', _POST['new_subdomain'], $matches );

		if( $matches[0] )
		{
			$this->fail( 'illegal_characters_in_subdomain: "' . implode( " ", $matches[0] ) . '"');
			return FALSE;
		}

		$saved = $this->obj->save_subdomain( _POST['new_subdomain'] );
		if( FALSE === $saved )
		{
			$this->fail( $this->obj->get_error_msg() );
			return FALSE;
		}

		$_setting = new _setting();
		$app_domain = $_setting->by_key( 'app_domain' );

		$this->success( 'subdomain_changed' );
		return _POST['new_subdomain'] . '.' . $app_domain;
	}

	/**
	 * Should be moved to _co_mem ctlr
	 *
	 * @deprecated
	 * @return void
	 */
	public function save_user() : void
	{
		if( !_POST['fk__mem_id'] )
		{
			$_mem = new _mem();
			$mem_exists = $_mem->get_by_col([ '_mem_email' => _POST['_mem_email'] ]);
			p( 'mem_exists' );
			p( $mem_exists );

			$_mem_auth = new _mem_auth();
			$mem_auth_exists = $_mem_auth->get_by_col([ '_mem_login' => _POST['_mem_email'] ]);
			p( 'mem_auth_exists' );
			p( $mem_auth_exists );
		}

		exit;
	}

	/**
	 * Gets all users(?)
	 *
	 * @TODO confirm usage and logic
	 * @return array|boolean
	 */
	public function get_users() :array|bool
	{
		$users = $this->obj->get_users();
		if( FALSE === $users )
		{
			$this->fail( 'failed_getting_users' );
			return FALSE;
		}

		$this->success( 'users_gotten' );
		return $users;
	}

	/**
	 * new() only allows for new subscribers to be created from _POST. It automatically
	 * checks that the subscriber subdomain is not already taken.
	 * 
	 * @TODO must add the first user
	 * @return bool TRUE if saved, FALSE on any error.
	 */

	public function new() : bool
	{
		// this is so that it can be checked before save is called
		$exists = $this->obj->check_subdomain([ 'sub_domain' => _POST['sub_domain'] ]);
		if( $exists['sub_id'] )
		{
			$this->fail( 'subdomain_already_exists' );
			return FALSE;
		}

		$saved = $this->obj->save([ 'sub_name' => _POST['sub_name'], 'sub_domain' => _POST['sub_domain'], 'sub_ulid' => $this->obj->generate_ulid() ]);
		if( $saved )
		{
			$this->success( 'subscriber_registered' );
			return TRUE;
		}

		$this->fail( $this->obj->get_error_msg() );
		return FALSE;
	}

	/**
	 * A sub may not be saved via the save method. Saves can only be made 
	 * with controls within the application for atomic changes by 
	 * instantiating the _co obj directly.
	 *
	 * @return boolean
	 */
	public function save() : bool
	{
		$this->fail( 'cannot_save_co_this_way' );
		return FALSE;
	}
}
