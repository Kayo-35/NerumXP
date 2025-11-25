<x-layout>
    <div class="row justify-content-center w-100">
        <div class="col-11">
            <x-registro.filterPanel
                :tipos="$tipos"
                :importancias="$importancias"
                :categorias="$categorias"
                :modalidades="$modalidades"
            />
        </div>
    </div>

    <section id="painelCards" class="container-fluid my-3">
        <div class="row g-4">
            @if ($registros->isEmpty())
                @if ($qtRegistros === 0)
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
                @foreach ($registros as $registro)
                    <div
                        class="col-12 col-md-6 col-lg-4 d-flex justify-content-center"
                    >
                        <a
                            href="{{ route("registro.show", ["registro" => $registro->cd_registro]) }}"
                            class="w-100"
                            style="
                                text-decoration: none;
                                max-width: 400px;
                            "
                        >
                            <x-registro.card
                                :registro="$registro"
                            ></x-registro.card>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="d-flex justify-content-end me-5">
            @if (method_exists($registros, "links") && !$registros->isEmpty())
                <div class="d-flex justify-content-center mt-4">
                    {{ $registros->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layout>
