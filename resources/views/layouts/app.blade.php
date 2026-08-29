<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', config('company.name') . ' | Zambia')</title>
<meta name="description" content="@yield('description', 'MV Industrial and Mining Supplies Limited is a wholly Zambian-owned supplier of industrial and mining products, procurement, labour hire, construction, civil and mechanical engineering services.')">
<link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<a class="skip-link" href="#main">Skip to main content</a>

@include('partials.header')

<main id="main">
    @yield('content')
</main>

@include('partials.footer')
@include('partials.whatsapp-float')

<script src="{{ asset('js/site.js') }}"></script>
</body>
</html>
