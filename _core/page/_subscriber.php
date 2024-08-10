<?php

$_tpl->assign( '_co', $_co->sub() );

$_co_pref = new _co_pref();
$prefs = $_co_pref->list();

if( $prefs )
{
	$sub_prefs = [];
	foreach( $prefs as $pref_id => $pref )
	{
		$sub_prefs[$pref['_co_pref_key']] = $pref['_co_pref_val'];
	}

	$_tpl->assign( 'sub_prefs', $sub_prefs );
}
