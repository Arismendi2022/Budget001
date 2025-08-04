<div class="page-wrapper">
	<header class="authentications-page-header">
		<div class="authentications-page-header__inner">
			<a title="Back to ynab.com" class="authentications-page-header__logo" href="/"><img alt="" src="{{ asset('assets/images/ynab-logo-buttermilk.svg') }}"></a>
			<a class="authentications-page-header__back-button" href="/">
				<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" fill="#FEF9ED" viewBox="0 0 18 18" width="0.75em" height="0.75em">
					<path fill="inherit"
						d="M.8 9c0-.3 0-.5.2-.7l5.8-5.8.3-.2h.3c.2 0 .4 0 .6.2l.2.5a.8.8 0 0 1-.2.6l-2 2-3.5 3.1-.2-.4 2.9-.2h11.1l.6.2.2.6-.2.6-.6.2H5.2l-2.9-.2.2-.4L6 12.3l2 2 .1.2.1.3c0 .2 0 .4-.2.6l-.6.2c-.2 0-.4-.1-.5-.3L1 9.5a.8.8 0 0 1-.3-.6Z">
					</path>
				</svg>
				Back to ynab.com
			</a>
		</div>
	</header>
	<main role="main" class="page-main">
		<section id="signup-screen" class="authentications-section" data-controller="signup">
			<div class="authentications-section__inner">
				<aside class="authentications-aside">
					<div class="authentications-aside__image authentications-aside__image--default"><img src="{{ asset('assets/images/doodle-logo.svg') }}"></div>
					<h2>Try YNAB free for <span class="subscription-period">34 days</span></h2>
					<p>The average YNABer saves $600 in their first two months (and you seem above average, honestly).</p>
				</aside>
				<div class="authentications-panel">
					<div class="authentications-panel__content">
						<h2>Sign Up</h2>
						<p>
							Have an account?
							<a href="{{ Route('login') }}" wire:navigate>Log in.</a>
						</p>
					</div>
					<form wire:submit="register" class="authentications-panel__form" data-redirect-url="/" data-dirty-tracking="false" data-signup-target="form"
						data-action="" accept-charset="UTF-8" data-remote="true" method="post" novalidate="novalidate"
						x-data="{ agreed: false }">
						@csrf
						<p class="authentications-panel__input-group js-form-email">
							<label for="request_data_email_signup" class="u-sr-only">Email:</label>
							<input class="authentications-panel__email-field required" id="request_data_email_signup" autofocus="autofocus" spellcheck="false" placeholder="Email address"
								type="email" name="request_data[email]" wire:model="email">
							@error('email')
							<label class="error" for="request_data_email_signup">{{ $message }}</label>
							@enderror
						</p>
						<p class=" authentications-panel__input-group js-form-password" x-data="{ showPassword: false }">
							<label for="request_data_password_signup" class="u-sr-only">Password:</label>
							<span class="password-toggle"><input class="authentications-panel__password-field required" id="request_data_password_signup" placeholder="Password"
									autocapitalize="none" autocomplete="off" :type="showPassword ? 'text' : 'password'" wire:model="password" name="request_data[password]"><label>
									<input type="checkbox" id="togglePassword" data-password-toggle="" x-model="showPassword">Show</label>
							</span>
							@error('password')
							<label class="error" for="request_data_password_signup">{{ $message }}</label>
							@enderror
						</p>
						<p class="authentications-panel__terms">
							<input type="checkbox" name="request_data[agreement]" id="request_data_agreement" value="true" class="required"
								data-signup-target="agreementCheckbox"
								x-model="agreed"
								data-action="change-&gt;signup#toggleSubmitButton">
							<label for="request_data_agreement">I agree to the YNAB <a rel="noopener noreferrer" target="_blank" href="#">Privacy Policy</a>
								and <a rel="noopener noreferrer" target="_blank" href="#">Terms of Service</a>.</label>
						</p>
						<p>
							<button name="sign_up" type="submit" id="sign_up" class="authentications-panel__form-button button button-primary" data-disable-with="Signing Up..."
								data-signup-target="submitButton" :disabled="!agreed">Sign Up
							</button>
						</p>
						<div class="authentications-sso-buttons">
							<hr class="u-hr-text authentications-sso-buttons__separator" data-content="or">
							<div class="u-sr-only">Or sign up with your Apple or Google account</div>
							<div class="authentications-sso-buttons__button">
								<a class="sso-button sso-button--apple" data-label="Continue with Apple" data-trigger-action="false" data-signup-target="appleButton"
									href="#"><span class="sso-button__logo"><img class="sso-provider-logo" alt=""
											src="{{ asset('assets/images/apple-logo.svg') }}"></span><span class="sso-button__label">Continue with Apple</span></a>
								<p class="authentications-sso-button__error authentications-sso-button__error--apple"></p>
							</div>
							<div class="authentications-sso-buttons__button">
								<div class="sso-button sso-button--google" data-login-target="googleButton">
									<div class="sso-button__inner "><span class="sso-button__logo"><img class="sso-provider-logo"
												src="{{ asset('assets/images/google-logo.svg') }}"/></span><span
											class="sso-button__label">Continuar con Google</span></div>
								</div>
								<p class="authentications-sso-button__error authentications-sso-button__error--google"></p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</main>
</div>

@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Seleccionar los campos de entrada
			const emailInput = document.getElementById('request_data_email_signup');
			const passwordInput = document.getElementById('request_data_password_signup');

			function removeErrorMessage(inputElement) {
				const errorLabel = inputElement.closest('.authentications-panel__input-group')
					.querySelector('label.error');
				if (errorLabel) {
					errorLabel.remove();
				}
			}

			emailInput.addEventListener('input', function () {
				removeErrorMessage(emailInput);
			});
			passwordInput.addEventListener('input', function () {
				removeErrorMessage(passwordInput);
			});
		});
	</script>
@endpush
