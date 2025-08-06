<div class="page-wrapper">
	<div class="logo-page-header">
		<a title="YNAB." href="#"  wire:click="logout">
			<span class="logo-page-header__logo"></span>
			<span class="logo-page-header__label">YNAB.</span>
		</a>
	</div>
	<main role="main" class="page-main">
		<div id="passwords-screen" data-controller="new-passwords">
			<section data-new-passwords-target="passwordsSuccessContainer">
				<h2>Verify your email?</h2>
				<p>
					Email verification instructions have been sent to: <strong class="js-email">{{ $email }}</strong>.
				</p>
				<p>
					<a class="button button-primary" wire:click="logout">Log Out</a>
				</p>
				<br>
				<p>
					Need help? Chat with us in the app or email us at <a href="mailto:help@ynab.com">help@ynab.com</a>.
				</p>
			</section>
		</div>
	</main>
</div>

