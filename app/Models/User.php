<?php
	
	namespace App\Models;
	
	use App\Notifications\CustomResetPassword;
	use App\Notifications\CustomVerifyEmail;
	use Illuminate\Contracts\Auth\MustVerifyEmail;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Foundation\Auth\User as Authenticatable;
	use Illuminate\Notifications\Notifiable;
	use Illuminate\Support\Str;
	
	class User extends Authenticatable implements MustVerifyEmail
	{
		/** @use HasFactory<\Database\Factories\UserFactory> */
		use HasFactory,Notifiable;
		
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var list<string>
		 */
		protected $fillable = [
			'email',
			'password',
		];
		
		/**
		 * Send the password reset notification using CMail helper.
		 */
		public function sendPasswordResetNotification($token){
			$notification = new CustomResetPassword($token);
			$notification->sendViaCMail($this);
		}
		
		/**
		 * Send the email verification notification using CMail helper.
		 */
		public function sendEmailVerificationNotification(){
			$notification = new CustomVerifyEmail;
			$notification->sendViaCMail($this);
		}
		
		/**
		 * The attributes that should be hidden for serialization.
		 *
		 * @var list<string>
		 */
		protected $hidden = [
			'password',
			'remember_token',
		];
		
		/**
		 * Get the attributes that should be cast.
		 *
		 * @return array<string, string>
		 */
		protected function casts():array{
			return [
				'email_verified_at' => 'datetime',
				'password'          => 'hashed',
			];
		}
		
		/**
		 * Get the user's initials
		 *  elimar al crear el nuevo sidebar.
		 */
		public function initials():string{
			return Str::of($this->name)
				->explode(' ')
				->take(2)
				->map(fn($word) => Str::substr($word,0,1))
				->implode('');
		}
	}
