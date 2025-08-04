<?php
	
	namespace App\Livewire\Auth;
	
	use App\Models\User;
	use Illuminate\Auth\Events\Registered;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Validation\Rules;
	use Livewire\Attributes\Layout;
	use Livewire\Component;
	
	#[Layout('components.layouts.auth')]
	class Register extends Component
	{
		
		public string $email    = '';
		public string $password = '';
		
		/**
		 * Handle an incoming registration request.
		 */
		public function register():void{
			$validated = $this->validate([
				'email'    => ['required','string','lowercase','email','max:255','unique:'.User::class],
				'password' => ['required','string',Rules\Password::defaults()],
			]);
			
			$validated['password'] = Hash::make($validated['password']);
			
			event(new Registered(($user = User::create($validated))));
			
			Auth::login($user);
			
			$this->redirect(route('budget',absolute:false));
		}
		
		public function render(){
			view()->share([
				'dataPage'    => 'authentications#signup',
				'bodyClasses' => 'theme-dark body-background--dark-shapes-inverted theme-light',
			]);
			return view('livewire.auth.register')->title('YNAB | Sign - Up');
		}
		
	}
