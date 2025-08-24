<x-layout>
    <div class="d-flex justify-content-end row">
        <div class="col-1 me-3">
            <a class="btn btn-primary" href="{{ route("registroFixo.create") }}">
                <i class="bi bi-plus">
                    Criar
                </i>
            </a>
        </div>
    </div>
    <section id="painelCards" class="mx-5 mt-2">
        <div class="row">
            @empty($registros)
                <div class="container">
                    <h1>Nada a ser exibido...</h1>
                </div>
            @else
                @foreach($registros as $registro)
                <a href="{{ route('registroFixo.show',["registroFixo" => $registro->cd_registro_fixo]) }}"
                    class="col-md-4"
                    style="text-decoration: none">
                    <x-registro.card :registro="$registro"></x-registro.card>
                </a>
                @endforeach
            @endempty
            <!-- Paginação com bootstrap-->
            <div>
                {{ $registros->links() }}
            </div>
        </div>
    </section>
</x-layout>
