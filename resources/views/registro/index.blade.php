<x-layout>
   <div class="row justify-content-center">
        <div class="col-11">
            <x-registro.filterPanel :tipos=$tipos :importancias=$importancias :categorias=$categorias :modalidades=$modalidades/>
        </div>
    </div>

    <section id="painelCards" class="mx-5 mt-2">
        <div class="row mx-4">
            @empty($registros->toArray())
                <div class="container-fluid d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="text-muted mb-3">Nenhum resultado encontrado</h3>
                        <p class="text-muted mb-4 lead">
                            Não foram encontrados recursos que correspondam aos filtros selecionados.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
                            <a class="btn btn-outline-primary" href="{{ route('registro.index') }}">
                                <i class="bi bi-arrow-clockwise me-2"></i>
                                Recarregar Página
                            </a>
                        </div>
                    </div>
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
