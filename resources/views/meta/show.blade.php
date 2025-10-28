<x-layout>
    <div class="container mt-4">
        <!-- Header da Meta -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card  header-card shadow-lg">
                    <div class="card-body bg-dark rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle {{ $meta->cd_tipo_meta === 1 || $meta->cd_tipo_meta === 2  ? 'gradient-success' : 'gradient-danger' }} text-white me-4">
                                        <i class="bi bi-bullseye fs-2"></i>
                                    </div>

                                    <div>
                                        <h1 class="mb-2 fw-bold {{ $meta->cd_tipo_meta === 1 || $meta->cd_tipo_meta === 2  ? 'text-success' : 'text-danger' }}">
                                            {{ $meta->nm_meta }}
                                        </h1>
                                        <p class="text-secondary mb-0 fs-6 {{ $meta->cd_tipo_meta === 1 || $meta->cd_tipo_meta === 2  ? 'text-success' : 'text-danger' }}">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            Meta criada em {{ date('d/m/Y',strtotime($meta->created_at)) }} - Prazo até {{ date('d/m/Y',strtotime($meta->dt_termino)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <h1 class="mb-3 fw-bold text-light" style="font-size: 2.5rem;">
                                    @isset($meta->vl_valor_meta)
                                        R$ {{ number_format($meta->vl_valor_meta,2,decimal_separator: ',', thousands_separator: '.') }}
                                    @else
                                        {{ number_format($meta->pc_meta,2,decimal_separator: ',', thousands_separator: '.')}}%
                                    @endisset
                                </h1>
                                @if($meta->ic_status === 1)
                                    <span class="badge gradient-success text-white fs-6 px-4 py-2">
                                        <i class="bi bi-target me-2"></i>
                                            Meta Ativa
                                    </span>
                                @else
                                    <span class="badge gradient-danger text-white fs-6 px-4 py-2">
                                        <i class="bi bi-target me-2"></i>
                                            Meta Inativa
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progresso da Meta -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card stats-card shadow">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h5 class="card-title mb-0 text-dark fw-bold">
                            <i class="bi bi-graph-up-arrow me-2 text-primary"></i>
                            Progresso da Meta
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-bold mb-2">Valor Alvo</label>
                                    <h2 class="text-primary mb-3 fw-bold">
                                        {{ isset($meta->vl_valor_meta) ? 'R$' : ''}}
                                        {{ number_format($meta->vl_valor_meta, thousands_separator: '.', decimal_separator: ',') ?? number_format($meta->pc_meta,2,',')."%"}}
                                    </h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label text-secondary fw-bold mb-2">Valor Atual</label>
                                    <h2 class="text-warning mb-3 fw-bold">
                                        {{ isset($meta->vl_valor_meta) ? 'R$' : ''}}
                                        {{ number_format($meta->vl_valor_progresso, decimal_separator: ',') ?? number_format($meta->pc_progresso,2,',')."%"}}
                                    </h2>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress mb-2" style="height: 24px;">
                                    @isset($meta->pc_meta)
                                        <div class="progress-bar fw-bold" role="progressbar" style="width: {{ $meta->pc_progresso }}%">
                                            {{ number_format($meta->pc_progresso,'2',',') }}%
                                        </div>
                                        <div class="progress-goal" role="progressbar" style="width: {{ $meta->pc_meta }}%"></div>
                                    @else
                                        <div class="progress-bar fw-bold" role="progressbar" style="width: {{ ($meta->vl_valor_progresso/$meta->vl_valor_meta)*100 }}%">
                                            {{ number_format(($meta->vl_valor_progresso/$meta->vl_valor_meta)*100,2,',') }}%
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalhes Principais -->
        <div class="row mb-4">
            <!-- Informações Básicas -->
            <div class="col-12 mb-4">
                <div class="card h-100 shadow">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="card-title mb-0 text-dark fw-bold">
                            <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                            Informações Básicas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-between g-4">
                            <div class="col-md-3 col-sm-12">
                                <label class="form-label text-secondary fw-bold text-center">Categorias</label>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span class="badge gradient-primary text-white fs-6 px-3 py-2">
                                        @foreach($meta->categoria()->get() as $categoria)
                                            <x-helper.categoria cdCategoria="{{ $categoria->cd_categoria }}"></x-helper.categoria>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label class="form-label text-secondary fw-bold text-center">Nível de Prioridade</label>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="star-rating me-3">
                                        @for($i = 0; $i < $meta->cd_nivel_imp; $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor
                                    </div>
                                    <span class="badge bg-warning text-dark fw-bold">
                                        {{$meta->nivel_imp()->first()->sg_nivel_imp}} Prioridade
                                    </span>
                                </div>
                            </div>
                           <div class="col-md-3 col-sm-12">
                                <label class="form-label text-secondary fw-bold text-center">Status</label>
                                <div class="d-flex align-items-center justify-content-center">

                                    <span class="badge gradient-success text-white fs-6 px-3 py-2">
                                        <i class="bi bi-play-circle-fill me-2"></i>
                                        Em Andamento
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Cronograma e Marcos -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="card-title mb-0 text-dark fw-bold">
                            <i class="bi bi-calendar-event-fill me-2 text-info"></i>
                            Cronograma e Marcos
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="milestone-card bg-success bg-opacity-10 p-4 text-center">
                                    <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                                    <h5 class="text-success mb-2 fw-bold">25% Alcançado</h5>
                                    <p class="text-secondary mb-0">Março 2024</p>
                                    <small class="text-success fw-bold">✓ Concluído</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="milestone-card bg-primary bg-opacity-10 p-4 text-center">
                                    <i class="bi bi-hourglass-split text-primary fs-1 mb-3"></i>
                                    <h5 class="text-primary mb-2 fw-bold">50% Meta</h5>
                                    <p class="text-secondary mb-0">Dezembro 2024</p>
                                    <small class="text-primary fw-bold">⏳ Em progresso</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="milestone-card bg-warning bg-opacity-10 p-4 text-center">
                                    <i class="bi bi-flag-fill text-warning fs-1 mb-3"></i>
                                    <h5 class="text-warning mb-2 fw-bold">Meta Final</h5>
                                    <p class="text-secondary mb-0">
                                        {{ date('d/m/Y',strtotime($meta->dt_termino)) }}
                                    </p>
                                    <small class="text-warning fw-bold">🎯 Objetivo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descrição e Observações -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="card-title mb-0 text-dark fw-bold">
                            <i class="bi bi-file-text-fill me-2 text-secondary"></i>
                            Descrição e Observações
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-lg-8">
                                <p class="text-dark mb-0 lh-lg">
                                    {{ $meta->ds_descricao }}
                                </p>
                            </div>
                            <div class="col-lg-4 mt-5">
                                <div class="bg-light p-4 text-center rounded-3 border">
                                    <i class="bi bi-clock-fill text-primary fs-2 mb-2"></i>
                                    <small class="text-secondary fw-bold d-block">Tempo Restante</small>
                                    <span class="text-dark fs-2 fw-bold">
                                        {{
                                            date_diff(new DateTime(date('Y-m-d')),new DateTime($meta->dt_termino))->days
                                        }}
                                    </span>
                                    <small class="text-secondary d-block">dias</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Histórico de Contribuições -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="card-title mb-0 text-dark fw-bold">
                            <i class="bi bi-clock-history me-2 text-info"></i>
                            Registros Associados
                        </h5>
                    </div>
                    <div class="accordion" id="registrosAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingRegistros">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegistros" aria-expanded="false" aria-controls="collapseRegistros">
                                    Veja mais ...
                                </button>
                            </h2>
                            <div id="collapseRegistros" class="accordion-collapse collapse" aria-labelledby="headingRegistros" data-bs-parent="#registrosAccordion">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        @foreach($registrosMeta as $registro)
                                        <div class="col-md-4">
                                            <a href="{{ route('registro.show',["registro" => $registro->cd_registro]) }}" class="d-inline" style="text-decoration: none">
                                                <div class="contribution-card p-3">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="text-secondary fw-medium">
                                                            Criado em: {{ date('d/m/Y',strtotime($registro->created_at)) }}
                                                        </span>
                                                        @if($registro->ic_pago)
                                                            <span class="badge bg-success">Pago</span>
                                                        @endif
                                                    </div>
                                                    <h5 class="text-dark mb-0 fw-bold">
                                                        {{ $registro->nm_registro}} R$ {{ number_format($registro->vl_valor,2,',','.') }}
                                                    </h5>
                                                    <small class="text-success">
                                                        <x-helper.categoria :cdCategoria="$registro->cd_categoria"></x-helper.categoria>
                                                    </small>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="card-title mb-0 text-dark fw-bold">
                            <i class="bi bi-lightning-charge-fill me-2 text-warning"></i>
                            Ações Rápidas
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <button class="btn btn-outline-info w-100 py-3">
                                    <i class="bi bi-graph-up-arrow me-2"></i>
                                    <span class="fw-bold">Ver Relatório</span>
                                </button>
                            </div>

                            <div class="col-md-4">
                                <a class="btn btn-outline-secondary w-100 py-3" href="{{ route('meta.edit',$meta->cd_meta) }}">
                                    <i class="bi bi-pencil-square me-2"></i>
                                    <span class="fw-bold">Editar Meta</span>
                                </a>
                            </div>
                           <div class="col-md-4">
                               <form action="{{ route('meta.destroy', $meta->cd_meta) }}" method="POST">
                                   @csrf
                                   @method("DELETE")
                                    <button class="btn btn-outline-danger w-100 py-3">
                                        <i class="bi bi-trash-fill me-2"></i>
                                        <span class="fw-bold">Excluir Meta</span>
                                    </button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
