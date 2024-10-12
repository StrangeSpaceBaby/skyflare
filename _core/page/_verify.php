<?php

$_verify = new _verify();
$_mem_auth = new _mem_auth();
$_mem_reset = new _mem_reset();

$token = $args;
if( is_array( $args ) )
{
	$token = array_shift( $args );
}

$verified = $_verify->verify([ '_mem_reset_type' => 'email_verify', '_mem_reset_token' => $token ]);
if( $verified )
{
	$sub = $_co->sub();
	$setup = $sub['_co_setup'];
	$owner_id = $sub['fk__mem_id'];

	$curr_auth = $_mem_auth->get_by_col([ 'fk__mem_id' => $owner_id ]);
	$owner = $_mem->get_by_id( $owner_id );

	if( !$setup )
	{
		if( !$curr_auth['_mem_auth_id'] )
		{
			$mem_auth_id = $_mem_auth->save([ 'fk__mem_id' => $owner_id, '_mem_login' => $owner['_mem_email'] ]);
			$curr_auth = $_mem_auth->get_by_id( $mem_auth_id );
		}

		$_role = new _role();
		$admin_roles = $_role->get_admin_roles();
		$admin_role = NULL;

		if( $admin_roles )
		{
			$admin_role = array_shift( $admin_roles );
		}

		if( !$admin_role );
		{
			$admin_role = $_role->create_admin_role();
		}

		$_co_mem = new _co_mem();
		$sub_mem = $_co_mem->save([ 'fk__mem_id' => $owner_id, 'fk__role_id' => $admin_role['_role_id'] ]);

		$_co->save([ '_co_id' => $sub['_co_id'], '_co_setup' => 1 ]);
	}

	$_mem_reset->expire_reset( $verified['_mem_reset_id'] );

	if( $curr_auth && !$curr_auth['_mem_password'] )
	{
		$_mem_reset->create_reset([ '_mem_reset_type' => 'password', 'fk__mem_id' => $verified['fk__mem_id'] ]);
	}
}
else
{
	// Display not verified token page and exit early
	print $o_tpl->parse( TPL_CORE . '/error/_expired_link.html' );
	exit;
}

// Get current resets pending
$password_resets = $_mem_reset->get_mem_resets( $verified['fk__mem_id'], 'password' );
if( $password_resets )
{
	$reset = array_shift( $password_resets );
	header( 'Location: /page/password_reset/' . $reset['_mem_reset_token'] );
	exit;
}

// Then redirect to index which figures out if it needs configuring
header( 'Location: /page/index' );
exit;
