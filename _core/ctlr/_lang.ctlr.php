<?php

/**
 *	lang_ctlr handles everything related to language translation.
 */

class _lang_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_lang' );
	}

	/**
	 * xl8() is special because it has to function in some non-intuitive ways.
	 * This function prints out the translation as a bare text for speed and exits.
	 * 
	 * @TODO Make this work
	 * @param	string	$token	Tokenized language placeholder
	 * @param	string	$lang	Two letter abbreviation of the language to tranlsate into
	 */

	public function xl8( string $token, string $lang = 'en' ) : void
	{
		$this->success( 'token_xl8ed' );
		print $token;
		exit;
	}
}
