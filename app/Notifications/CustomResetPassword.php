<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class CustomResetPassword extends Notification
{
	use Queueable;
	public $token;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($token)
	{
		//
		$this->token = $token;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->from('takuya7.msb@gmail.com', 'Takuya_ECsite')
			->subject('パスワード再設定')
			->line('下のボタンをクリックしてパスワードを再設定してください。')
			->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
			->line('もし心当たりがない場合は、本メッセージは破棄してください。');
	}
}
