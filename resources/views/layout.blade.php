<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ env('APP_NAME') }}</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/normalize.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.min.css') }}">
	</head>
	<body>
		@yield('content')
		
		<script src="{{ asset('assets/js/main.min.js') }}"></script>
	</body>
</html>

