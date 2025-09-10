<x-layout>
   <div class="row justify-content-center w-100">
        <div class="col-11">
            <x-registro.filterPanel :tipos=$tipos :importancias=$importancias :categorias=$categorias :modalidades=$modalidades/>
        </div>
    </div>

    <section id="painelCards" class="mx-5 mt-2">
        <div class="row mx-4">
            @if($registros->isEmpty())
                @if($qtRegistros === 0)
                    <x-helper.nothing
                        icon="bi-question-circle"
                        title="Nenhum registro encontrado"
                        text="Cadastre seus registros e os consulte nessa página sempre que necessário"
                        route="{{route('registro.create')}}"
                        label="Criar registro"
                        />
                @else
                    <x-helper.nothing
                        icon="bi-search"
                        title="Nenhum registro encontrado"
                        text="Parâmetros de consulta não atendem a nenhum registro cadastrado"
                        route="{{route('registro.index')}}"
                        label="Recarregar Página"
                        labelIcon="bi-arrow-clockwise"
                        />
                @endif
            @else
                @foreach($registros as $registro)
                <a href="{{ route('registro.show',["registro" => $registro->cd_registro]) }}"
                    class="col-md-4"
                    style="text-decoration: none"
                >
                    <x-registro.card :registro="$registro"></x-registro.card>
                </a>
                @endforeach
                @if(method_exists($registros,"links"))
                    <div>
                        {{ $registros->links() }}
                    </div>
                @endif
            @endempty
            <!-- Paginação com bootstrap-->
        </div>
    </section>
</x-layout>
