<?php


class _comm_ctlr extends _ctlr
{
	public function __construct()
	{
		parent::__construct( '_comm' );
	}

	private function send_test()
	{
		// html_body, subject, plaintext_body, sender_email, recipient_emails
		return $this->obj->email([
			'body' => '<h1>AWS Amazon Simple Email Service Test Email</h1><p>This email was sent with <a href="https://aws.amazon.com/ses/">Amazon SES</a> using the <a href="https://aws.amazon.com/sdk-for-php/">AWS SDK for PHP</a>.</p>',
			'subject' => 'Amazon SES test (AWS SDK for PHP)',
			'recipient' => ['greg@thinkbuildpush.com', 'suneater@gmail.com']
		]);
	}

}
