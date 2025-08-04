<div class="page-wrapper">
	<div class="logo-page-header">
		<a title="YNAB." href="/">
			<span class="logo-page-header__logo"></span>
			<span class="logo-page-header__label">YNAB.</span>
		</a>
	</div>
	<main role="main" class="page-main">
		<div id="passwords-screen" data-controller="new-passwords">
			<section data-new-passwords-target="passwordsContainer" @if($emailSent) style="display: none;" @endif>
				<h2>Forgot your password?</h2>
				<p>
					No sweat. Enter the email address you signed up with and we'll send you instructions to reset your password.
				</p>
				<hr>
				<form class="form js-form" data-new-passwords-target="initiateForm" wire:submit="sendPasswordResetLink" accept-charset="UTF-8" data-remote="true" method="post"
					novalidate="novalidate">
					@csrf
					<p class="js-form-email">
						<label for="request_data_email">Email:</label>
						<input class="required" autofocus="autofocus" spellcheck="false" data-new-passwords-target="emailInput" type="email"
							name="request_data[email]" id="request_data_email"
							wire:model="email">
						@error('email')
						<label class="error" for="request_data_email">{{ $message }}</label>
						@endif
					</p>
					<p>
						<button name="button" type="submit" class="button button-primary" data-disable-with="Sending Reset Instructions...">Send Reset Instructions</button>
					</p>
					<p>
						<a href="{{ route('login') }}" wire:navigate>Return to log in</a>
					</p>
				</form>
			</section>
			<section data-new-passwords-target="passwordsSuccessContainer" @if(!$emailSent) style="display: none;" @endif>
				<h2>Reset password instructions sent!</h2>
				<p>
					Instructions to reset your password have been sent to <strong class="js-email">{{ $email }}l</strong>.
				</p>
				<p>
					<a class="button" href="{{ route('login') }}" wire:navigate>Return to log in</a>
				</p>
			</section>
		</div>
	
	</main>
</div>
@push('scripts')
	<script>

		document.addEventListener('DOMContentLoaded', function () {
			// Seleccionar los campos de entrada
			const emailInput = document.getElementById('request_data_email');

			function removeErrorMessage(inputElement) {
				const errorLabel = inputElement.closest('.js-form-email')
					.querySelector('label.error');
				if (errorLabel) {
					errorLabel.remove();
				}
			}

			emailInput.addEventListener('input', function () {
				removeErrorMessage(emailInput);
			});
		});
	
	</script>
@endpush
