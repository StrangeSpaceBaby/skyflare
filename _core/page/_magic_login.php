<?php

$token = $args;

if( $args && is_array( $args ) )
{
	$token = array_shift( $args );
}

global $_tpl;

if( $token )
{
	$o__mem_reset = new _mem_reset();
	$reset = $o__mem_reset->get_by_col([ '_mem_reset_token' => $token ]);

	if( $reset )
	{
		$created = new DateTime( $reset['_mem_reset_new'] );
		$expires = $created->modify( "+10 minutes" );
		$now = new DateTime();
		if( $now > $expires )
		{
			// create auth_token and pass it to COOKIE
			$o__auth_token = new _auth_token();
			$new_token = $o__auth_token->generate_token( $reset['fk__mem_id'] );

			$new_token['auth_token_expires'] = $expires->format( 'r' );

			$_tpl->assign( 'auth_token', $new_token['auth_token'] );
			$_tpl->assign( 'auth_token_expires', $new_token['auth_token_expires'] );

			$_tpl->assign( 'valid_token', 1 );

			// clear all magic resets
			// $o__mem_reset->expire_all__mem_resets( $reset['fk__mem_id'], 'magic' );
		}
		else
		{
			$_tpl->assign( 'valid_token', 0 );
			$_tpl->assign( 'token_state', 'expired' );
		}
	}
}
else
{
	$_tpl->assign( 'valid_token', 0 );
	$_tpl->assign( 'token_state', 'invalid' );
}
