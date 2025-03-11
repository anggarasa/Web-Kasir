<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
<link rel="shortcut icon" href="{{ asset('imgs/logo/R.A-Mart-logo-no-bg(2).png') }}" type="image/x-icon">

<title>{{ $title ?? env('APP_NAME') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

{{-- Font Awesome Icons --}}
<script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance