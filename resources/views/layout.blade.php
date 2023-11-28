<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel')  }}</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <!-- meta description etc. -->
</head>
<body class="antialiased">
@yield('content')
</body>
</html>
