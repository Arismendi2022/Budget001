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
	<meta name="session-token">
	
	<title>{{ $title ?? 'Page Title Budget' }}</title>
	{{-- Styles --}}
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/favicon/Tree_Logo_Blurple.png') }}" rel="shortcut icon" type="image/x-icon">
	{{-- Fonts --}}
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<link id="googleidentityservice" type="text/css" media="all" href="https://accounts.google.com/gsi/style" rel="stylesheet">
</head>
<body class="ember-application">
<div class="layout">
	<div id="ember3" class="content-layout user-logged-in">
		<a href="#start-of-content" class="skip-to-content">
			Skip to content
		</a>
		<!--sidebar-->
		@include('partials.sidebar')
		
		<!-- Page Content -->
		{{ $slot }}
	
	</div>
</div>
</body>
</html>
