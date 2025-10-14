<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NerumXP</title>
    @vite(['resources/css/app.css','resources/css/geral.css','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('css/meta.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('css/components/accountPanel.css') }}">
    @if(request()->is("registro"))
        <link rel="stylesheet" href="{{ asset('css/registro/card.css')}}"></link>
    @endif
    @if(request()->is("meta/*"))
        <link rel="stylesheet" href="{{ asset('css/meta.show.css') }}"></link>
    @endif
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
    @guest
        @if(request()->is('register/create'))
            <script src="{{ asset("js/contas/create.js") }}"></script>
        @endif
    @endguest
    @auth
        @if(request()->is('home'))
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="{{ asset('js/registro/grafico.js') }}"></script>
            <script src="{{ asset("js/metas/resumo.js") }}"></script>
        @endif

        @if(request()->is('meta'))
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="{{ asset("js/metas/resumo.js") }}"></script>
        @endif

        @if(request()->is('meta/create'))
            <script src="{{ asset("js/metas/create.js") }}"></script>
        @endif

        @if(request()->is('meta/*/edit'))
            <script src="{{ asset("js/metas/edit.js") }}"></script>
        @endif

        @if(request()->is('relatorio*'))
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="{{ asset("js/relatorios/categoria.js") }}"></script>
        @endif
    @endauth
</body>
</html>
