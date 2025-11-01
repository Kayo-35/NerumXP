@props([
    'titulo',
    'route',
    'importancias'
])
<div class="container mt-4">
    <!-- Cabeçalho da Página -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="bi bi-plus-circle text-primary fs-3"></i>
                        </div>
                        <div>
                            <h2 class="mb-1 text-dark">
                                {{ $titulo }}
                            </h2>
                            <p class="text-secondary mb-0">
                                Configure os parâmetros da sua meta financeira
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulário de Criação -->
    <form id="formCriarMeta" action="{{ $route == 'meta.put' ? route('meta.put',$meta->cd_meta) : route('meta.store') }}" method="POST">
        @csrf
        @if(request()->is('meta/*/edit'))
            @method('PUT')
        @endif
        <input type="hidden" name="cd_tipo_meta" value="7">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="text-dark mb-4">
                            <i class="bi bi-gear text-primary me-2"></i>
                            Configuração da Meta
                        </h4>
                        <div class="row mb-3">
                            <!-- Nome da Meta -->
                            <div class="col-md-6">
                                <label for="nm_meta" class="form-label fw-semibold">
                                    <i class="bi bi-bookmark text-secondary me-1"></i>
                                    Nome da Meta
                                </label>
                                <input type="text" class="form-control" id="nm_meta" name="nm_meta"
                                    placeholder="Digite o nome da sua meta" value="{{ old('nm_meta',$meta->nm_meta ?? '') }}">
                            </div>
                            <!-- Data de término -->
                            <div class="col-md-3">
                                <label for="dt_termino" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-event text-secondary me-1"></i>
                                    Data de Término
                                </label>
                                <input type="date" class="form-control" id="dt_termino" name="dt_termino"
                                    value={{ old('dt_termino', $meta->dt_termino ?? '') }}>
                            </div>
                            <!-- Nível de Importância -->
                            <div class="col-md-3">
                                <label for="cd_nivel_imp" class="form-label fw-semibold">
                                    <i class="bi bi-star text-secondary me-1"></i>
                                    Nível de Importância
                                </label>
                                <select class="form-select" id="cd_nivel_imp" name="cd_nivel_imp">
                                    <option value="">Selecione...</option>
                                    @foreach($importancias as $importancia)
                                        <option value="{{ $importancia->cd_nivel_imp }}"
                                            {{ old('cd_nivel_imp', $meta->cd_nivel_imp ?? '') == $importancia->cd_nivel_imp ? 'selected' : ''}}>
                                            {{ $importancia->sg_nivel_imp }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="ds_descricao" class="form-label fw-semibold">
                                    <i class="bi bi-file-text text-secondary me-1"></i>
                                    Descrição
                                </label>
                                <textarea class="form-control" id="ds_descricao" name="ds_descricao" rows="3"
                                    placeholder="Descreva os detalhes da sua meta...">{{ old('ds_descricao',$meta->ds_descricao ?? '') }}</textarea>
                            </div>
                        </div>
                        @if($errors->any())
                            <x-helper.error campo="nm_meta"></x-helper.error>
                            <x-helper.error campo="cd_nivel_imp"></x-helper.error>
                            <x-helper.error campo="cd_tipo_meta"></x-helper.error>
                            <x-helper.error campo="dt_termino"></x-helper.error>
                            <x-helper.error campo="ds_descricao"></x-helper.error>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="text-dark mb-4">
                            <i class="bi bi-list-check text-primary me-2"></i>
                            Objetivos da Meta
                        </h4>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="form-check me-3 mt-1">
                                        <input type="hidden" name="objetivo[status][]" value="off">
                                        <input class="form-check-input" type="checkbox" name="objetivo[]">
                                        <label class="form-check-label"></label>
                                    </div>

                                    <div class="flex-grow-1">
                                        <label class="form-label fw-semibold text-dark mb-1">
                                            Descrição:
                                        </label>
                                        <input type="text" class="form-control d-inline w-100" name="objetivo[]">
                                    </div>
                                </div>
                            </div>
                            <div class="row m-4">
                                <div class="col-12">
                                    <button type="button" class="btn btn-outline-primary">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Adicionar Novo Objetivo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-secondary w-100 me-2">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Cancelar
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ request()->is('meta/create') ? 'Criar Meta' : 'Editar Meta'}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
