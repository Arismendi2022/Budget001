<x-layouts.app :title="__('Plan | Arismendi´s Plan | YNAB')">
	<div style="margin-top: 50px; margin-left: 50px; ">
		<form method="POST" action="{{ route('logout') }}" class="w-full">
			@csrf
			<button class="ynab-button primary" type="submit">
				Log Out
			</button>
		</form>
	</div>
</x-layouts.app>
