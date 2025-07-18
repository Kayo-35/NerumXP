<x-layout>
    <div class="container mt-3">
        <h1>Assinaturas</h1>
        <table class="table">
            <thead class="table-success">
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
</x-layout>
