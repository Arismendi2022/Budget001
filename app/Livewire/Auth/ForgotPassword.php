<?php
	
	namespace App\Livewire\Auth;
	
	use Illuminate\Support\Facades\Password;
	use Livewire\Attributes\Layout;
	use Livewire\Component;
	
	#[Layout('components.layouts.auth')]
	class ForgotPassword extends Component
	{
		public string $email     = '';
		public bool   $emailSent = false;
		
		/**
		 * Send a password reset link to the provided email address.
		 */
		public function sendPasswordResetLink():void{
			$this->validate([
				'email' => ['required','string','email','exists:users,email'],
			],[
				'email.exists' => 'We couldn\'t find an account with that email.'
			]);
			
			Password::sendResetLink($this->only('email'));
			
			$this->emailSent = true; // Cambiar el estado a true cuando se envía exitosamente
			
			session()->flash('status',__('A reset link will be sent if the account exists.'));
		}
		
		public function render(){
			view()->share([
				'dataPage'    => 'passwords#new',
				'bodyClasses' => 'theme-light',
			]);
			return view('livewire.auth.forgot-password')->title('Reset Password | YNAB');
		}
	}
