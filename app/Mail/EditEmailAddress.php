<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditEmailAddress extends Mailable
{
	use Queueable, SerializesModels;

	protected $url;
	protected $title;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->view('emails.edit_email_address')
			->subject('メールアドレス変更確認メール')
			->with([
				'url' => $this->url,
			]);
	}
}
