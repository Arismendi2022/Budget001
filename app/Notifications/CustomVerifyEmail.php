<?php
	
	namespace App\Notifications;
	
	use App\Helpers\CMail;
	use Illuminate\Bus\Queueable;
	use Illuminate\Notifications\Notification;
	use Illuminate\Support\Carbon;
	use Illuminate\Support\Facades\URL;
	
	class CustomVerifyEmail extends Notification
	{
		use Queueable;
		
		/**
		 * Get the notification's delivery channels.
		 */
		public function via($notifiable){
			return []; // Empty array to avoid using Laravel channels
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
			$verificationUrl = $this->verificationUrl($notifiable);
			
			// Render the email view
			$emailBody = view('emails.verify-email',[
				'verificationUrl' => $verificationUrl,
				'user'            => $notifiable,
			])->render();
			
			$config = [
				'recipient_address' => $notifiable->email,
				'recipient_name'    => $notifiable->name,
				'subject'           => 'Verify Email Address - '.config('app.name'),
				'body'              => $emailBody,
			];
			
			return CMail::send($config);
		}
		
		/**
		 * Get the verification URL for the given notifiable.
		 */
		protected function verificationUrl($notifiable){
			return URL::temporarySignedRoute(
				'verification.verify',
				Carbon::now()->addMinutes(60),
				['id' => $notifiable->getKey(),'hash' => sha1($notifiable->getEmailForVerification())]
			);
		}
	}
	
	
	