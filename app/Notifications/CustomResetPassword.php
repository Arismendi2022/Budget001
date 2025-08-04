<?php
	
	namespace App\Notifications;
	
	use App\Helpers\CMail;
	use Illuminate\Bus\Queueable;
	use Illuminate\Notifications\Notification;
	
	class CustomResetPassword extends Notification
	{
		use Queueable;
		
		/**
		 * Create a new notification instance.
		 */
		public function __construct($token){
			$this->token = $token;
		}
		
		/**
		 * Get the notification's delivery channels.
		 *
		 * @return array<int, string>
		 */
		public function via(object $notifiable):array{
			return [];
		}
		
		/**
		 * Override the send method to use CMail directly
		 */
		public function send($notifiable,$notification){
			return $this->sendViaCMail($notifiable);
		}
		
		/**
		 * Send email using CMail helper
		 */
		public function sendViaCMail($notifiable){
			$actionlink = url(route('password.reset',[
				'token' => $this->token,
				'email' => $notifiable->getEmailForPasswordReset(),
			],false));
			
			$emailBody = view('emails.reset-password',[
				'url'        => $actionlink,
				'actionlink' => $actionlink,
				'user'       => $notifiable,
				'app_name'   => config('app.name'),
			])->render();
			
			$config = [
				'recipient_address' => $notifiable->email,
				'recipient_name'    => $notifiable->name,
				'subject'           => 'Reset Password - '.config('app.name'),
				'body'              => $emailBody,
			];
			
			return CMail::send($config);
		}
		
	}
