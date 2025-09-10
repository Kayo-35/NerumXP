<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NerumXP</title>
    @vite(['resources/css/app.css','resources/css/geral.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"></link>
</head>
<body class="d-flex flex-column min-vh-100 w-100">
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
    <!-- Scripts js -->
    @if(request()->is('registro/create*'))
        <script src="{{ asset("js/registro/create.js") }}"></script>
    @endif
    @if(request()->is('registro/*/edit'))
        <script src="{{ asset("js/registro/edit.js") }}"></script>
    @endif

    <!--Chart.js-->
    @auth
        @if(request()->is('home'))
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="{{ asset('js/registro/grafico.js') }}"></script>
        @endif
    @endauth
</body>
</html>
