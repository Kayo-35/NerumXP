<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NerumXP - Organize sua vida financeira</title>
    <meta name="description" content="Controle seus ganhos, acompanhe gastos e alcance metas com o NerumXP. Relatórios visuais e planos para todos.">
    @vite(['resources/css/app.css','resources/css/geral.css','resources/js/app.js'])

    @auth
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"></link>
        <link rel="stylesheet" href="{{ asset('css/resumo.css') }}"></link>
    @endauth
    @guest
        <link rel="stylesheet" href="{{ asset('css/guest.css') }}"></link>
    @endguest

    <link rel="stylesheet" href="{{ asset('css/meta.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('css/components/accountPanel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/sideBar.css') }}"></link>
    @if(request()->is("registro"))
        <link rel="stylesheet" href="{{ asset('css/registro/card.css')}}"></link>
        <link rel="stylesheet" href="{{ asset('css/registro/registro.css')}}"></link>
    @endif
    @if(request()->is("meta/*"))
        <link rel="stylesheet" href="{{ asset('css/meta.show.css') }}"></link>
    @endif
</head>
<body class="{{ Auth::check() ? 'bg-light-green' : 'bg-white' }} d-flex flex-column min-vh-100">
    <header>
        @guest
            @include("components.nav.navbar")
        @endguest
        @auth
            @include("components.nav.authBar")
        @endauth
    </header>

    @guest
        <section class="flex-grow-1">
            {{ $slot }}
        </section>

        <footer
            class="footer py-3 border-top mt-0 footer-custom"
        >
            @include("components.nav.footer")
        </footer>
    @endguest

    @auth
        <main class="content bg-light-green py-5 ps-lg-4 flex-grow-1">
            {{ $slot }}
        </main>
        <footer
            class="footer py-3 border-top mt-0 footer-custom"
        >
            @include("components.nav.footer")
        </footer>
    @endauth
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
            @if(request()->query->all()['tipo'][0] != 7)
                <script src="{{ asset("js/metas/create.js") }}"></script>
            @else
                <script src="{{ asset("js/metas/createGenerica.js") }}"></script>
            @endif
        @endif

        @if(request()->is('meta/*/edit'))
            <script src="{{ asset("js/metas/edit.js") }}"></script>
            <script src="{{ asset("js/metas/createGenerica.js") }}"></script>
        @endif

        @if(request()->is('relatorio*'))
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="{{ asset("js/relatorios/categoria.js") }}"></script>
        @endif
    @endauth
</body>
</html>
