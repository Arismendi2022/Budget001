<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="color-scheme" value="light dark">
	<meta name="description"
		content="Personal home budget software built with Four Simple Rules to help you quickly gain control of your money, get out of debt, and reach your financial goals!">
	<meta name="robots" content="noindex">
	{{-- Token --}}
	<meta name="csrf-param" content="authenticity_token">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- Styles --}}
	<link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/favicon/Tree_Logo_Blurple.png') }}" rel="shortcut icon" type="image/x-icon">
	
	<title>{{ $title ?? 'Page Title' }}</title>
	{{-- Fonts --}}
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800;900&amp;display=swap"
		rel="stylesheet">
</head>

<body data-page="{{ $dataPage }}" data-ynab-device="web" class="{{ $bodyClasses }}">
{{ $slot }}
<!-- Footer -->
<div class="application__footer">
	<footer class="page-footer">
		<a rel="noopener noreferrer" target="_blank" href="#" onclick="return false;">Terms of Service</a>
		<a rel="noopener noreferrer" target="_blank" href="#" onclick="return false;">Privacy Policy</a>
		<a rel="noopener noreferrer" target="_blank" href="#" onclick="return false;">California Privacy Policy</a>
		<button class="page-footer__privacy-choices js-open-preference-center">Your Privacy Choices</button>
		<div class="copyright">© Copyright {{ date('Y') }} YNAB LLC. All rights reserved.</div>
	</footer>
</div>

@stack('scripts')
</body>
</html>

