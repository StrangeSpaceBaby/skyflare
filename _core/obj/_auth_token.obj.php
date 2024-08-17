<?php

class _auth_token extends _obj
{
	public function __construct()
	{
		parent::__construct( '_auth_token' );
		$this->log_lvl( 'error' );
	}

	/**
	 * Expires all tokens of a certain type for current user. 'password' is default
	 *
	 * @param string $type type fo token to expire
	 * @return boolean TRUE on success, FALSE on error
	 */
	public function expire_all_tokens( string $type = 'password' ) : bool
	{
		$auth_token = $this->get_token();

		if( $auth_token )
		{
			$token = $this->get_by_col([ '_auth_token' => $auth_token ]);
			if( $token )
			{
				$mem_id = $token['fk__mem_id'];
				$q = "UPDATE _auth_token SET _auth_token_expired = 1 WHERE fk__co_id = ? AND fk__mem_id = ? and _auth_token_type = ?";
				$sth = $this->query( $q, [ $this->_co_id, $mem_id, $type ]);

				if( '00000' == $sth->errorCode() )
				{
					$this->success( 'all_tokens_expired' );
					return TRUE;
				}

				$this->fail( 'tokens_could_not_be_expired' );
				return FALSE;
			}
			else
			{
				$this->fail( 'no_valid_token_found_from_header' );
				return FALSE;
			}
		}

		$this->success( 'no_tokens_to_expire' );
		return TRUE;
	}

	/**
	 * Generates a new 8-hour token for the passed _mem_id
	 *
	 * @param integer $mem_id auto increment id of _mem
	 * @param string $type type of token to generate
	 * @return array|boolean array of token details or FALSE on error
	 */
	public function generate_token( int $mem_id, string $type = 'password' ) : array|bool
	{

		$new_token = $this->hash( $this->generate_ulid() );
		$expires = new DateTime();
		$expires->modify( "+8 HOUR" );
		$expires = $expires->format( 'Y-m-d H:i:s' );

		$saved = $this->save([ 'fk__mem_id' => $mem_id, '_auth_token' => $new_token, '_auth_token_expires' => $expires, '_auth_token_type' => $type ]);

		if( FALSE === $saved )
		{
			$this->log_data([ 'error' => $this->get_error_msg() ])->log_msg( 'could_not_save_auth_token' );
			$this->fail( 'auth_token_not_generated' );
			return FALSE;
		}

		$this->log_data([ [ 'auth_token' => $new_token, 'expires' => $expires, 'saved' => $saved ], $this->get_error_msg() ])->log_msg( 'auth_token_return' );
		$this->success( 'auth_token_generated' );
		return [ 'auth_token' => $new_token, 'expires' => $expires ];
	}

	/**
	 * Gets token from apache request headers
	 *
	 * @return string auth_token
	 */
	public function get_token() : ?string
	{
		return apache_request_headers()['auth_token'];
	}

	/**
	 * Gets auth_token from _COOKIE
	 *
	 * @return string auth_token
	 */
	public function get_cookie() : ?string
	{
		return $_COOKIE['auth_token'];
	}

	/**
	 * Gets token from either headers or cookie, finds token in database,
	 * Determines if token is still valid
	 *
	 * @return array|boolean token data if valid token, FALSE on error or invalid token
	 */
	public function verify_token() : array|bool
	{
		$auth_token = $this->get_token();
		$this->log_data([ 'header_auth_token' => $auth_token ]);

		if( !$auth_token )
		{
			$auth_token = $this->get_cookie();
			$this->log_data([ 'cookie_auth_token' => $auth_token ]);
		}

		if( $auth_token )
		{
			$token = $this->get_by_col([ '_auth_token' =>  $auth_token ], FALSE, TRUE, [], "*");
			$this->log_data([ 'token_fetched' => $token ]);

			if( $token['_auth_token_id'] && !$token['_auth_token_expired'] )
			{
				header( 'auth_token: ' . $token['_auth_token'] );
				header( 'auth_token_expires: ' . $token['_auth_token_expires'] );

				$now = new DateTimeImmutable();
				$expires = new DateTimeImmutable( $token['_auth_token_expires'] );
				if( $expires >= $now && !$token['_auth_token_expired'] )
				{
					$this->log_msg( 'valid_auth_token' );
					$this->success( 'valid_auth_token' );
					return $token;
				}
				else
				{
					$this->log_msg( 'token expired' );
					$this->expire_token( $token['_auth_token_id'] );

					header( 'auth_token: ' . $token['_auth_token'] );
					header( 'auth_token_expired: ' . $token['_auth_token_expires'] );

					$this->fail( 'expired_auth_token' );
					return FALSE;
				}
			}
		}

		$this->log_msg( 'no token found' );
		$this->fail( 'missing_auth_token' );
		return FALSE;
	}

	/**
	 * Sets token_id token to expired regardless of expires timestamp
	 *
	 * @param integer $token_id auto increment id of token
	 * @return integer|boolean token_id that was expired if expired, FALSE on error
	 */
	public function expire_token( int $token_id ) : int|bool
	{
		$this->log_data([ 'token_id' => $token_id ]);

		$expired = $this->save([ '_auth_token_id' => $token_id, '_auth_token_expired' => 1 ]);
		if( FALSE === $expired )
		{
			$this->log_lvl( 'error' )->log_msg( 'db fail' );
			$this->fail( 'db_error' );
			return FALSE;
		}

		$this->log_msg( 'token_was_expired' );
		$this->success( 'token_was_expired' );
		return $token_id;
	}
}
