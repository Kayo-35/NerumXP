<x-layout>
<div class="container mt-4">
    <!-- Cabeçalho da Página -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="bi bi-flag-fill text-primary fs-3"></i>
                            </div>
                            <div>
                                <h2 class="mb-1 text-dark">
                                    Visualizar Meta Genérica
                                </h2>
                                <p class="text-secondary mb-0">
                                    Acompanhe o progresso e detalhes da sua meta
                                </p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('meta.edit',$meta->cd_meta) }}" class="btn btn-outline-primary me-2">
                                <i class="bi bi-pencil me-1"></i>
                                Editar
                            </a>
                            <a href="{{ route('meta.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>
                                Voltar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Painel de Informações da Meta Principal -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="text-dark mb-4">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        Informações da Meta
                    </h4>

                    <div class="row mb-3">
                        <!-- Nome da Meta -->
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-bookmark text-secondary me-1"></i>
                                Nome da Meta
                            </label>
                            <div class="form-control bg-light d-flex align-items-center" style="min-height: 38px;">
                                {{ $meta->nm_meta }}
                            </div>
                        </div>

                        <!-- Data de Conclusão -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-calendar-check text-secondary me-1"></i>
                                Data de Conclusão
                            </label>
                            <div class="form-control bg-light d-flex align-items-center" style="min-height: 38px;">
                                {{ date('d/m/Y',strtotime($meta->dt_termino)) ?? 'Não concluída' }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Nível de Importância -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-star text-secondary me-1"></i>
                                Nível de Importância
                            </label>
                            <div class="form-control bg-light" style="min-height: 38px; display: flex; align-items: center;">
                                @for($i = 0; $i < $meta->nivel_imp()->first()->cd_nivel_imp; $i++)
                                    <i class="bi bi-star-fill text-primary mx-1"></i>
                                @endfor
                                <span class="badge text-bg-primary fw-bold">
                                    {{ $meta->nivel_imp()->first()->sg_nivel_imp }}
                                </span>
                            </div>
                        </div>

                        <!-- Status da Meta -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-activity text-secondary me-1"></i>
                                Status
                            </label>
                            <div class="form-control bg-light d-flex align-items-center" style="min-height: 38px;">
                                @if($meta->ic_status == 1)
                                    <span class="badge bg-success text-light">
                                        <i class="bi bi-check-lg me-1"></i>
                                        Concluída
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>
                                        Em Progresso
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Data de Criação -->
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-calendar-plus text-secondary me-1"></i>
                                Data de Criação
                            </label>
                            <div class="form-control bg-light d-flex align-items-center" style="min-height: 38px;">
                                {{ date('d/m/Y',strtotime($meta->created_at)) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-file-text text-secondary me-1"></i>
                                Descrição
                            </label>
                            <div class="form-control bg-light p-3" style="min-height: 100px">
                                {{ $meta->ds_descricao }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Painel de Metas Menores (Checklist) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="text-dark mb-0">
                            <i class="bi bi-list-check text-primary me-2"></i>
                            Objetivos
                        </h4>
                        <span class="badge bg-primary bg-opacity-10 text-primary fs-6">
                            {{ $numObjetivosConcluidos }} de {{ $numObjetivos }} concluídos
                        </span>
                    </div>

                    <div class="list-group list-group-flush">
                        @foreach($meta->objetivos()->get() as $objetivo)
                            <div class="list-group-item px-0 py-3">
                                <div class="row align-items-center">
                                    <!-- Checkbox -->
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                {{ $objetivo->ic_status == 1 ? 'disabled checked' : '' }}
                                                style="width: 24px; height: 24px; cursor: not-allowed;">
                                        </div>
                                    </div>

                                    <!-- Descrição -->
                                    <div class="col">
                                        <h6 class="mb-1 {{ $objetivo->ic_status == 1 ? 'text-decoration-line-through text-muted' : '' }}">
                                            {{ $objetivo->ds_descricao }}
                                        </h6>
                                </div>

                                    <!-- Data de Criação -->
                                    <div class="col-auto text-center" style="min-width: 120px;">
                                        <small class="text-secondary d-block fw-semibold">Criado em</small>
                                        <small class="text-dark">
                                            <i class="bi bi-calendar-plus text-secondary me-1"></i>
                                            {{ date('d/m/Y', strtotime($objetivo->created_at)) }}
                                        </small>
                                    </div>

                                    <!-- Data de Conclusão -->
                                    <div class="col-auto text-center" style="min-width: 120px;">
                                        <small class="text-secondary d-block fw-semibold">Concluído em</small>
                                        <small class="text-dark">
                                            @isset($objetivo->dt_conclusao)
                                                <i class="bi bi-check-circle text-success me-1"></i>
                                                {{ date('d/m/Y', strtotime($objetivo->dt_conclusao)) }}
                                            @else
                                                <span class="badge text-bg-warning fw-bold">
                                                    PENDENTE
                                                </span>
                                            @endisset
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
