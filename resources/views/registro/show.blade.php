<x-layout>
    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Header da Transação -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="bg-primary bg-opacity-10 p-3 rounded-circle me-3"
                                    >
                                        <i
                                            class="bi bi-wallet text-primary fs-3"
                                        ></i>
                                    </div>
                                    <div>
                                        <h2 class="mb-1 text-dark">
                                            {{ $registro->nm_registro }}
                                        </h2>
                                        <p class="text-secondary mb-0">
                                            Transação realizada em
                                            {{ date("d/m/Y", strtotime($registro->created_at)) }}
                                            às
                                            {{ date("H:m", strtotime($registro->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <h1
                                    class="text-{{ $registro->cd_tipo_registro == 1 ? "success" : "danger" }} mb-2"
                                >
                                    R$
                                    {{ str_replace(".", ",", $registro->vl_valor) }}
                                </h1>
                                @if ($registro->cd_tipo_registro == 1)
                                    <span
                                        class="badge bg-success fs-6 px-3 py-2"
                                    >
                                        <i
                                            class="bi bi-arrow-up-circle me-1"
                                        ></i>
                                        Renda
                                    </span>
                                @else
                                    <span
                                        class="badge bg-danger fs-6 px-3 py-2"
                                    >
                                        <i
                                            class="bi bi-arrow-down-circle me-1"
                                        ></i>
                                        Despesa
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalhes Principais -->
        <div class="row mb-4">
            <!-- Informações Básicas -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="bi bi-info-circle me-2"></i>
                            Informações Básicas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Categoria
                                </label>
                                <div class="d-flex align-items-center">
                                    @isset($registro->cd_categoria)
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary fs-6 px-3 py-2"
                                        >
                                            <x-helper.categoria
                                                :cdCategoria="$registro->cd_categoria"
                                            />
                                        </span>
                                    @else
                                        <x-helper.notice
                                            titulo="Sem categoria"
                                            desc="Esse registro não possui nenhuma categoria associada"
                                        />
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Nível de Importância
                                </label>
                                <div class="d-flex align-items-center">
                                    @isset($registro->cd_nivel_imp)
                                        @for ($i = 0; $i < $registro->cd_nivel_imp;$i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor
                                    @else
                                        <x-helper.notice
                                            titulo="Nivel de importância não definido"
                                            desc="Esse registro não possui nenhuma categoria associada"
                                        />
                                    @endisset
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Responsável
                                </label>
                                <div class="d-flex align-items-center">
                                    @isset($registro->cd_responsavel)
                                        <div
                                            class="bg-dark bg-opacity-10 p-2 rounded-circle me-2"
                                        >
                                            <i
                                                class="bi bi-person text-dark"
                                            ></i>
                                        </div>
                                        <span class="text-dark">
                                            {{ $registro->responsavel()->nm_responsavel }}
                                        </span>
                                    @else
                                        <x-helper.notice
                                            titulo="Realização Própria"
                                            desc="Esse registro fora realizador por você mesmo"
                                        />
                                    @endisset
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Localização
                                </label>
                                <div class="d-flex align-items-center">
                                    @isset($registro->cd_localizacao)
                                        <div
                                            class="bg-secondary bg-opacity-10 p-2 rounded-circle me-2"
                                        >
                                            <i
                                                class="bi bi-geo-alt text-secondary"
                                            ></i>
                                        </div>
                                        <span class="text-dark">
                                            {{ $registro->localizacao->first()->nm_localizacao }}
                                        </span>
                                    @else

                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forma de Pagamento -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="bi bi-credit-card me-2"></i>
                            Forma de Pagamento
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Tipo de Pagamento
                                </label>
                                <div class="d-flex align-items-center">
                                    @isset($registro->cd_forma_pagamento)
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary fs-6 px-3 py-2"
                                        >
                                            <i class="bi bi-check-circle me-1">
                                                {{ $registro->forma_pagamento->nm_forma }}
                                            </i>
                                        </span>
                                    @else
                                        <x-helper.notice
                                            titulo="Não definida"
                                            desc="Nenhuma forma de pagamento definida"
                                        />
                                    @endisset
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Método(s)
                                </label>
                                <div class="d-flex align-items-center">
                                    @if ($metodos->isNotEmpty())
                                        <div class="d-flex flex-column">
                                            @foreach ($metodos as $metodo)
                                                <div
                                                    class="bg-dark bg-opacity-10 p-2 rounded rounded-2 m-1"
                                                >
                                                    <i
                                                        class="bi bi-currency-exchange text-secondary"
                                                    >
                                                        <span class="text-dark">
                                                            {{ $metodo->nm_metodo }}
                                                        </span>
                                                    </i>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <x-helper.notice
                                            titulo="Não definidos"
                                            desc="Nenhum método de pagamento definido"
                                        />
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <label
                                    class="form-label text-secondary fw-bold"
                                >
                                    Status
                                </label>
                                <div class="d-flex align-items-center">
                                    <span
                                        class="badge border border-success fs-6 px-3 py-2"
                                    >
                                        @if ($registro->ic_status == 1)
                                            <i
                                                class="bi bi-check-circle text-primary me-1 p-1"
                                            >
                                                Ativo
                                            </i>
                                        @else
                                            <x-helper.notice
                                                titulo="Registro Inativo"
                                                desc="Você definiu esse registro como inativo"
                                            />
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descrição Detalhada -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="bi bi-file-text me-2"></i>
                            Descrição Detalhada
                        </h5>
                    </div>
                    @isset($registro->ds_descricao)
                        <div class="card-body">
                            <div class="row g-3">
                                <p class="text-dark mb-3 col-12 col-md-8">
                                    {{ $registro->ds_descricao }}
                                </p>
                                <div class="col-12 col-md-4">
                                    <div
                                        class="bg-light p-3 text-center fs-6 rounded"
                                    >
                                        <small
                                            class="text-secondary fw-bold d-block"
                                        >
                                            Quantidade de palavras
                                        </small>
                                        <span class="text-dark">
                                            {{ str_word_count($registro->ds_descricao) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <x-helper.notice
                            titulo="Descrição Indefinida"
                            desc="Nenhuma descrição para o registro fora definida"
                        />
                    @endisset
                </div>
            </div>
        </div>

        <!-- Informações de Juros Flutuantes -->
        @if ($registro->cd_modalidade == 2)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h5 class="card-title mb-0 text-dark">
                                <i class="bi bi-percent me-2"></i>
                                Informações de Juros
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @isset($registro->cd_tipo_juro)
                                    <div class="col-md-6 m-1">
                                        <label
                                            class="form-label text-secondary fw-bold"
                                        >
                                            Tipo de Juros
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="bg-success bg-opacity-10 p-2 rounded-circle me-2"
                                            >
                                                <i
                                                    class="bi bi-graph-up text-success"
                                                ></i>
                                            </div>
                                            <span class="text-dark">
                                                {{ $registro->juro()->first()->nm_tipo_juro }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <x-helper.notice
                                        titulo="Juros não definidos"
                                        desc="Nenhum tipo de juros associado ao registro, isso pode proporcionar relatórios incompletos"
                                    />
                                @endisset

                                @isset($registro->pc_taxa_juros)
                                    <div class="col-md-6">
                                        <label
                                            class="form-label text-secondary fw-bold"
                                        >
                                            Taxa de Juros
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="bg-dark bg-opacity-10 p-2 rounded-circle me-2"
                                            >
                                                <i
                                                    class="bi bi-calculator text-dark"
                                                ></i>
                                            </div>
                                            <span class="text-dark">
                                                {{ $registro->pc_taxa_juros . "%" }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <x-helper.notice
                                        titulo="Taxa de juros indefinida"
                                        desc="Nenhuma taxa de juros fora atribuida, o que impede a geração de relatórios futuros"
                                    />
                                @endisset

                                @isset($registro->qt_meses_incidencia)
                                    <div class="col-md-6">
                                        <label
                                            class="form-label text-secondary fw-bold"
                                        >
                                            Período de Capitalização
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="bg-secondary bg-opacity-10 p-2 rounded-circle me-2"
                                            >
                                                <i
                                                    class="bi bi-calendar-event text-secondary"
                                                ></i>
                                            </div>
                                            <span class="text-dark">
                                                @unless ($registro->qt_meses_incidencia == 1)
                                                    {{ $registro->qt_meses_incidencia }}
                                                    meses
                                                @else
                                                    {{ $registro->qt_meses_incidencia }}
                                                    mês
                                                @endunless
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <x-helper.notice
                                        titulo="Perído não definido"
                                        desc="Sem o período de capitalização definido relatórios envolvendo esse registro serão limitados"
                                    />
                                @endisset

                                @isset($registro->dt_vencimento)
                                    <div class="col-md-6">
                                        <label
                                            class="form-label text-secondary fw-bold"
                                        >
                                            Data de Vencimento
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="bg-success bg-opacity-10 p-2 rounded-circle me-2"
                                            >
                                                <i
                                                    class="bi bi-calendar-check text-success"
                                                ></i>
                                            </div>
                                            <span class="text-dark">
                                                {{ date("d/m/Y", strtotime($registro->dt_vencimento)) }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <x-helper.notice
                                        titulo="Data de vencimento não definida"
                                        desc="A ausência da data de vencimento nos impede de definir o período de vigência de juros"
                                    />
                                @endisset

                                <div
                                    class="mt-3 p-3 bg-success bg-opacity-10 rounded"
                                >
                                    <div class="d-flex align-items-center">
                                        <i
                                            class="bi bi-info-circle text-success me-2"
                                        ></i>
                                        <small class="text-success fw-bold">
                                            Registro Flutuante Ativo
                                        </small>
                                    </div>
                                    <small class="text-secondary d-block mt-1">
                                        Este registro possui juros flutuantes
                                        que serão aplicados conforme os
                                        parâmetros definidos acima.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm bg-light">
                        <div
                            class="card-header bg-secondary bg-opacity-10 border-0"
                        >
                            <h5 class="card-title mb-0 text-secondary">
                                <i class="bi bi-percent me-2"></i>
                                Informações de Juros
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-3">
                                <i
                                    class="bi bi-lock text-secondary fs-1 mb-2"
                                ></i>
                                <h6 class="text-secondary mb-1">
                                    Registro Fixo - Não se aplica
                                </h6>
                                <small class="text-secondary">
                                    Este registro possui valor fixo e não está
                                    sujeito a variações de juros.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Timeline da Transação -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="bi bi-clock-history me-2"></i>
                            Histórico da Transação
                        </h5>
                    </div>
                    @empty($historicos)
                        <div class="p-3">
                            <x-helper.notice
                                titulo="A incluir timeline do historico"
                                desc="Historico valido apenas agurdando codificar"
                            />
                        </div>
                    @else
                        <div class="p-3">
                            <div class="row justify-content-center">
                                <div class="p-3">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="row border-bottom py-2 mb-3 bg-light rounded d-none d-md-flex">
                                                <div class="col-2 fw-bold text-uppercase text-primary small">No.</div>
                                                <div class="col-3 fw-bold text-uppercase text-primary small">Atualizado em:</div>
                                                <div class="col-3 fw-bold text-uppercase text-primary small text-end">Valor</div>
                                                <div class="col-4 fw-bold text-uppercase text-primary small text-end">Diferença</div>
                                            </div>

                                            @foreach($historicos as $key => $historico)
                                                <div class="row border-bottom py-2 align-items-center mb-2 rounded">
                                                    <div class="col-6 col-md-2 text-primary fw-bold fs-5 mb-2 mb-md-0">
                                                        <span class="d-md-none text-muted small ms-2">No.</span>
                                                        <span class="badge bg-primary">{{ $key + 1 }}</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 text-end text-md-start mb-2 mb-md-0">
                                                        <span class="d-md-none text-muted small d-block">Atualizado em:</span>
                                                        <span class="text-muted small fst-italic">{{ date('H:i:s d/m/Y', strtotime($historico->updated_at)) }}</span>
                                                    </div>
                                                    <div class="col-6 col-md-3 text-end fw-semibold text-dark fs-5 mb-2 mb-md-0">
                                                        <span class="d-md-none text-muted small d-block">Valor</span>
                                                        R$ {{ number_format($historico->vl_valor, 2, ',', '.') }}
                                                    </div>
                                                    <div class="col-6 col-md-4 text-end fw-semibold fs-5">
                                                        {{--
                                                            As entradas de historico estão ordenadas das mais recentes as mais antigas, a cada iteração uma entrada mais antiga é indicada,
                                                            ou seja para obter a diferença utiliza-se atual - proxima, com a precaução de não se estourar o array.
                                                        --}}
                                                        @php

                                                            $proximaChave = $key + ($key != array_key_last($historicos) ? 1 : 0);
                                                            $diff = $historico->vl_valor - ($proximaChave < count($historicos) ? $historicos[$proximaChave]->vl_valor : 0);
                                                            $color = $diff >= 0 ? 'success' : 'danger';
                                                        @endphp
                                                        <span class="d-md-none text-muted small d-block">Diferença</span>
                                                        <span class="badge bg-{{ $color }} rounded-pill">R$ {{ number_format($diff, 2, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    @endempty
                </div>
            </div>
        </div>

        <!-- Ações -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div
                        class="card-body text-center row justify-content-center"
                    >
                        <div class="col-6">
                            <a
                                class="btn btn-outline-success me-2"
                                href="{{ route("registro.edit", [$registro]) }}"
                            >
                                <i class="bi bi-pencil me-1"></i>
                                Editar
                            </a>
                        </div>
                        <div class="col-6">
                            <form
                                method="POST"
                                action="{{ route("registro.destroy", [$registro]) }}"
                            >
                                @csrf
                                @method("DELETE")
                                <button
                                    class="btn btn-outline-danger"
                                    type="submit"
                                >
                                    <i class="bi bi-trash me-1"></i>
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
