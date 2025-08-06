<?php
	
	namespace App\Livewire\Auth;
	
	use Illuminate\Auth\Events\Lockout;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\RateLimiter;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Str;
	use Illuminate\Validation\Rules;
	use Illuminate\Validation\ValidationException;
	use Livewire\Attributes\Layout;
	use Livewire\Component;
	
	#[Layout('components.layouts.auth')]
	class Login extends Component
	{
		public bool   $remember = false;
		public string $email    = '';
		public string $password = '';
		
		/**
		 * Handle an incoming authentication request.
		 */
		public function login():void{
			$validated = $this->validate([
				'email'    => ['required','string','exists:users,email'],
				'password' => ['required','string',Rules\Password::defaults()],
			],[
				'email.exists' => 'We couldn\'t find an account with that email.'
			]);
			
			$this->ensureIsNotRateLimited();
			
			if(!Auth::attempt(['email' => $this->email,'password' => $this->password],$this->remember)){
				RateLimiter::hit($this->throttleKey());
				
				throw ValidationException::withMessages([
					'password' => 'Incorrect password.',
				]);
			}
			
			// Check if the user's email is verified
			if(!Auth::user()->hasVerifiedEmail()){
				// Log the user out to prevent access
				Auth::logout();
				
				// Throw a validation exception with a custom message in English
				throw ValidationException::withMessages([
					'email' => ['Your email address is not verified. Please check your inbox to verify your email.'],
				]);
			}
			
			RateLimiter::clear($this->throttleKey());
			Session::regenerate();
			
			$this->redirectIntended(default:route('budget',absolute:false));
		}
		
		/**
		 * Ensure the authentication request is not rate limited.
		 */
		protected function ensureIsNotRateLimited():void{
			if(!RateLimiter::tooManyAttempts($this->throttleKey(),5)){
				return;
			}
			
			event(new Lockout(request()));
			
			$seconds = RateLimiter::availableIn($this->throttleKey());
			
			throw ValidationException::withMessages([
				'email' => __('auth.throttle',[
					'seconds' => $seconds,
					'minutes' => ceil($seconds / 60),
				]),
			]);
		}
		
		/**
		 * Get the authentication rate limiting throttle key.
		 */
		protected function throttleKey():string{
			return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
		}
		
		public function render(){
			view()->share([
				'dataPage'    => 'authentications#new',
				'bodyClasses' => 'theme-dark body-background--dark-shapes theme-light',
			]);
			return view('livewire.auth.login')->title('YNAB | Sign-In');
		}
		
		
	}
