<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NerumXP - Plataforma de Gerenciamento Financeiro</title>
    <meta name="description"
        content="Controle seus ganhos, acompanhe gastos e alcance metas com o NerumXP. Relatórios visuais e planos para todos.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/termos.css') }}">
    @if(request()->is("register/create") || request()->is("login/create"))
        <link rel="stylesheet" href="{{ asset('css/loginCadastro.css') }}">
    @endif
</head>

<body class="d-flex flex-column min-vh-100">
    <main>
        {{ $slot }}
    </main>
    @guest
        @if(request()->is('register/create'))
            <script src="{{ asset("js/contas/create.js") }}"></script>
        @endif
    @endguest
</body>

</html>
