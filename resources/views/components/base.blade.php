<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Termos e Condições de Uso - NerumXP</title>
    <meta name="description"
        content="Controle seus ganhos, acompanhe gastos e alcance metas com o NerumXP. Relatórios visuais e planos para todos.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/termos.css') }}">
</head>

<body>
    <header class="bg-success text-white py-2 mb-4">
        <div class="container text-center">
            <a href="{{ route('guest.home') }}">
                <img src="{{ asset('img/logo_projeto_fundo_branco.png') }}" width="50" class="d-block mx-auto">
            </a>
            <h1 class="fw-bold text-white">Termos e Condições de Uso</h1>
            <p class="mb-0">Última atualização: Novembro de 2025</p>
        </div>
    </header>

    <main class="container my-5">
        {{ $slot }}
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">© 2025 - NerumXP | Sistema de Gerenciamento Financeiro Pessoal | Todos os direitos
                reservados.</p>
        </div>
    </footer>
</body>

</html>
