<?php
	
	namespace App\Livewire\Auth;
	
	use Illuminate\Auth\Events\PasswordReset;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Password;
	use Illuminate\Support\Str;
	use Illuminate\Validation\Rules;
	use Livewire\Attributes\Layout;
	use Livewire\Attributes\Locked;
	use Livewire\Component;
	
	#[Layout('components.layouts.auth')]
	class ResetPassword extends Component
	{
		#[Locked]
		public string $token    = '';
		public string $email    = '';
		public string $password = '';
		
		public $resetSuccess = false;
		
		/**
		 * Mount the component.
		 */
		public function mount(string $token):void{
			$this->token = $token;
			
			$this->email = request()->string('email');
		}
		
		/**
		 * Reset the password for the given user.
		 */
		public function resetPassword():void{
			$this->validate([
				'token'    => ['required'],
				'email'    => ['required','string','email'],
				'password' => ['required','string',Rules\Password::defaults()],
			]);
			
			// Here we will attempt to reset the user's password. If it is successful we
			// will update the password on an actual user model and persist it to the
			// database. Otherwise we will parse the error and return the response.
			$status = Password::reset(
				$this->only('email','password','password_confirmation','token'),
				function($user){
					$user->forceFill([
						'password'       => Hash::make($this->password),
						'remember_token' => Str::random(60),
					])->save();
					
					event(new PasswordReset($user));
				}
			);
			
			// Check if the status indicates an invalid or expired token
			if($status === Password::INVALID_TOKEN){
				$this->addError('password',__('The reset password token is invalid or expired. Please request a new one.'));
				return;
			}
			
			// Cambiar el estado para mostrar el mensaje de éxito
			$this->resetSuccess = true;
			
		}
		
		public function render(){
			view()->share([
				'dataPage'    => 'passwords#edit',
				'bodyClasses' => 'theme-light',
			]);
			return view('livewire.auth.reset-password')->title('Reset Password | YNAB');
		}
	}
