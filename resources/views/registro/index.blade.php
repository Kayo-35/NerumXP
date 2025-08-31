<x-layout>
    <div class="d-flex justify-content-end row mt-3">
        <div class="col-1 me-3">
            <a class="btn btn-primary" href="{{ route("registro.create") }}">
                <i class="bi bi-plus">
                    Criar
                </i>
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <x-registro.filterPanel :tipos=$tipos :importancias=$importancias :categorias=$categorias :modalidades=$modalidades/>
        </div>
    </div>

    <section id="painelCards" class="mx-5 mt-2">
        <div class="row mx-4">
            @empty($registros)
                <div class="container">
                    <h1>Nada a ser exibido...</h1>
                </div>
            @else
                @foreach($registros as $registro)
                <a href="{{ route('registro.show',["registro" => $registro]) }}"
                    class="col-md-4"
                    style="text-decoration: none"
                >
                    <x-registro.card :registro="$registro"></x-registro.card>
                </a>
                @endforeach
            @endempty
            <!-- Paginação com bootstrap-->
            @if(method_exists($registros,"links"))
                <div>
                    {{ $registros->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layout>
