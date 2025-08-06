<?php
	
	namespace App\Livewire\Auth;
	
	use App\Livewire\Actions\Logout;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Session;
	use Livewire\Attributes\Layout;
	use Livewire\Component;
	
	#[Layout('components.layouts.auth')]
	class VerifyEmail extends Component
	{
		public string $email;
		
		public function mount(){
			$this->email = Auth::user()->email;
		}
		
		/**
		 * Send an email verification notification to the user.
		 */
		public function sendVerification():void{
			if(Auth::user()->hasVerifiedEmail()){
				$this->redirectIntended(default:route('budget',absolute:false),navigate:true);
				
				return;
			}
			
			Auth::user()->sendEmailVerificationNotification();
			
			Session::flash('status','verification-link-sent');
		}
		
		/**
		 * Log the current user out of the application.
		 */
		public function logout(Logout $logout):void{
			$logout();
			
			$this->redirect('/',navigate:true);
		}
		
		public function render(){
			view()->share([
				'dataPage'    => 'confirmations#show',
				'bodyClasses' => 'theme-light',
			]);
			return view('livewire.auth.verify-email')->title('YNAB | Verify Email');
		}
		
	}
