<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NerumXP</title>
    @vite(['resources/css/app.css','resources/css/geral.css','resources/js/app.js'])
</head>
<body>
    <header>
        @include("components.navbar")
    </header>
    {{ $slot }}
    <footer
        class="bg-light m-auto p-4"
    >
        @include("components.footer")
    </footer>
</body>
</html>
