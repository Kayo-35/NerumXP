<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <h1>Assinaturas</h1>
        <table class="table">
            <thead class="table-primary">
                <th>Código</th>
                <th>Nome</th>
            </thead>
            <tbody>
                @foreach($assinaturas as $assinatura)
                    <tr>
                        <td>{{ $assinatura['cd_assinatura'] }}</td>
                        <td>{{ $assinatura['nm_assinatura'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
