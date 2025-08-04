<div class="page-wrapper">
	<div class="logo-page-header">
		<a title="YNAB." href="/">
			<span class="logo-page-header__logo"></span>
			<span class="logo-page-header__label">YNAB.</span>
		</a></div>
	<noscript>
		<div class="no-javascript-container">
			<div>
				<h3>Enable JavaScript to see YNAB's standard view</h3>
				<p>
					The page you are viewing requires JavaScript for the best experience. Enable JavaScript
					by changing your browser settings, and then hit refresh to try again.
				</p>
			</div>
		</div>
	</noscript>
	<main role="main" class="page-main">
		<div data-controller="edit-passwords" data-edit-passwords-otp-form-outlet="#otp-form">
			<div class="passwords-container" data-edit-passwords-target="resetPasswordContainer">
				<div class="js-main_screen_or_otp_app_or_otp_backup_code">
					<h2>Reset your password</h2>
					<form class="form js-form" data-edit-passwords-target="resetForm"
						data-action="" wire:submit="resetPassword" accept-charset="UTF-8" data-remote="true" method="post" novalidate="novalidate">
						@csrf
						<input value="wt9nqZ8-hkRqo-vCJdZe" autocomplete="off" type="hidden" name="request_data[reset_password_token]" id="request_data_reset_password_token">
						<p>
							<em>Password tip</em>: Create a password using four random words. It's easy to remember, but hard to crack.
						</p>
						<p class="js-form-password" x-data="{ showPassword: false }">
							<label for="request_data_password">Enter a New Password:</label>
							<span class="password-toggle"><input class="required" autofocus="autofocus" autocapitalize="none" autocomplete="off" :type="showPassword ? 'text' : 'password'"
									name="request_data[password]"
									id="request_data_password" wire:model="password"><label><input type="checkbox" data-password-toggle="" x-model="showPassword">Show</label></span>
							@error('password')
							<label class="error" for="request_data_password">{{ $message }}</label>
							@enderror
						</p>
						<p data-edit-passwords-target="resetSubmitButton">
							<button name="button" type="submit" class="button button-primary" data-disable-with="Saving New Password...">Save New Password</button>
						</p>
						<div id="otp-form" data-controller="otp-form" data-otp-form-target="otpContainer" data-otp-form-using-backup-code-value="false" hidden="">
							<div>
								<p class="js-form-otp">
									<label data-otp-form-target="label" for="request_data_otp">Enter the 6-digit code from your authenticator app:</label>
									<input placeholder="6-digit code" maxlength="6" class="required" autocomplete="off" autofocus="autofocus" data-otp-form-target="input" size="6" type="text"
										name="request_data[otp]" id="request_data_otp">
									<label class="error" for="request_data_otp"></label>
								</p>
							</div>
							<br>
							<button name="button" type="submit" class="button button-primary" data-disable-with="Saving New Password...">Save New Password</button>
							<div>
								<p data-otp-form-target="showBackupLink">
									<a href="#" data-action="click-&gt;otp-form#showBackup">I'm having trouble</a>
								</p>
								<p data-otp-form-target="troubleshootLink" hidden="">
									<a rel="noopener noreferrer" target="_blank" href="https://support.ynab.com/en_us/how-to-protect-your-account-with-two-step-verification-rkKHuLlRc#troubleshoot">I
										don't have my backup code</a>
								</p>
							</div>
						</div>
					</form>
					<p>
						<a href="{{ route('login') }}">Return to log in</a>
					</p>
				</div>
			</div>
			<div data-edit-passwords-target="resetSuccessContainer" hidden="">
				<div data-edit-passwords-target="resetAndDisabledContainer" hidden="">
					<h2>We've reset your password and disabled Two-Step Verification</h2>
					<p>For your security, logging in with a single-use emergency backup code disables two-step verification. <br>
						You can re-enable it in a few simple steps.</p>
					<br>
					<a class="button button-primary" href="/settings/otp/new">Re-Enable Two-Step Verification</a>
					<br>
					<br>
					<div class="passwords-container-success-secondary">
						<p>
							<a class="button button-launch-app launch_app_button" id="launch_app_button" href="/">Open Plan</a>
						</p>
					</div>
				</div>
				<div data-edit-passwords-target="nonOTPSuccessContainer" hidden="">
					<h2>Your password has been reset.</h2>
					<p>
						You can now log in and make further edits in account settings.
					</p>
					<p>
						<a class="button button-launch-app launch_app_button" id="launch_app_button" href="{{ route('login') }}">Log In</a>
					</p>
				
				</div>
				<br>
				<p>
					Need help? Chat with us in the app or email us at <a href="mailto:help@ynab.com">help@ynab.com</a>.
				</p>
			</div>
		</div>
	</main>
</div>
@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Seleccionar los campos de entrada
			const passwordInput = document.getElementById('request_data_password');

			function removeErrorMessage(inputElement) {
				const errorLabel = inputElement.closest('.js-form-password')
					.querySelector('label.error');
				if (errorLabel) {
					errorLabel.remove();
				}
			}

			passwordInput.addEventListener('input', function () {
				removeErrorMessage(passwordInput);
			});
		});
	</script>
@endpush
