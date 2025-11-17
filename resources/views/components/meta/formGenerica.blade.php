@props([
    'meta',
    'titulo',
    'route',
    'importancias',
    'objetivos'
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
                            <div id="secaoObj" class="col-12">
                                @if(empty($objetivos))
                                    <div class="row d-flex align-items-center">
                                        <div class="col-11">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="form-check me-3 mt-1">
                                                    <input class="form-check-input" type="checkbox" name="objetivo1[]">
                                                </div>

                                                <div class="flex-grow-1">
                                                    <label class="form-label fw-semibold text-dark mb-1">
                                                        Objetivo 1
                                                    </label>
                                                    <input type="text" class="form-control d-inline w-100" name="objetivo1[]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 d-flex align-items-center">
                                            <button type="button" id="remove1" class="btn btn-lg btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    @foreach($objetivos as $key => $objetivo)
                                        <div class="row d-flex align-items-center" id="{{ $key + 1}}obj">
                                            <div class="col-11">
                                                <div class="d-flex align-items-start mb-2">
                                                    <input type="hidden" name="objetivo{{ $key + 1}}[cd_objetivo_meta]" value="{{ $objetivo->cd_objetivo_meta }}">
                                                    <div class="form-check me-3 mt-1">
                                                        <input class="form-check-input" type="checkbox" name="objetivo{{ $key + 1 }}[]" {{ $objetivo->ic_status === 1 ? 'checked' : '' }}>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <label class="form-label fw-semibold text-dark mb-1">
                                                            Objetivo {{ $key + 1 }}:
                                                        </label>
                                                        <input type="text" class="form-control d-inline w-100" name="objetivo{{ $key + 1 }}[]" value="{{ $objetivo->ds_descricao }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1 d-flex align-items-center">
                                                <button type="button" id="remove{{$key + 1}}" class="btn btn-lg btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                           <div class="row m-4">
                                <div class="col-12">
                                    <button id="adicionaObjetivo" type="button" class="btn btn-outline-primary">
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
                                <a class="btn btn-outline-secondary w-100 me-2" href="{{ route('meta.index') }}">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Cancelar
                                </a>
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
@if(request()->is('meta/*/edit'))
    <script src="{{ asset('js/metas/createGenerica.js')}}"></script>
@endif
