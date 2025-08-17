<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NerumXP</title>
    @vite(['resources/css/app.css','resources/css/geral.css','resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        @include("components.nav.navbar")
    </header>

    <section class="flex-grow-1">
        {{ $slot }}
    </section>

    <footer
        class="bg-light p-4"
    >
        @include("components.nav.footer")
    </footer>
</body>
</html>
