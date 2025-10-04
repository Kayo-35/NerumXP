@props([
    "titulo",
    "meta",
    "route",
    "impotancias",
    "tiposMeta",
    "registrosDaMeta",
    "registros",
    "categorias",
    "modalidades",
    "importancias"
])
<!-- Container Principal -->
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
        <!-- Painel Superior - Dados da Meta -->
        @csrf
        @if(request()->is('meta/*/edit'))
            @method('PUT')
        @endif
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
                            <div class="col-md-8">
                                <label for="nm_meta" class="form-label fw-semibold">
                                    <i class="bi bi-bookmark text-secondary me-1"></i>
                                    Nome da Meta
                                </label>
                                <input type="text" class="form-control" id="nm_meta" name="nm_meta"
                                    placeholder="Digite o nome da sua meta" value="{{ old('nm_meta',$meta->nm_meta ?? '') }}">
                            </div>

                            <!-- Nível de Importância -->
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <label for="cd_nivel_imp" class="form-label fw-semibold">
                                    Tipo da Meta
                                </label>
                                <select class="form-select" id="cd_tipo_meta" name="cd_tipo_meta">
                                    <option value="">Selecione...</option>
                                    @foreach($tiposMeta as $tipo)
                                        <option value="{{ $tipo->cd_tipo_meta }}" {{ old('cd_tipo_meta', $meta->cd_tipo_meta ?? '') == $tipo->cd_tipo_meta ? 'selected' : '' }}>
                                            {{ $tipo->nm_meta }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="cd_nivel_imp" class="form-label fw-semibold">
                                    Modalidade dos Registros
                                </label>
                                <select class="form-select" id="cd_modalidade" name="cd_modalidade">
                                    <option value="">Selecione...</option>
                                    @foreach($modalidades as $modalidade)
                                        <option value="{{ $modalidade->cd_modalidade}}" {{ old('cd_modalidade', $meta->cd_modalidade ?? '') == $modalidade->cd_modalidade ? 'selected' : '' }}>
                                            {{ $modalidade->nm_modalidade}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold mb-2" for="categoriaAccordion">
                                    Categoria dos Registros
                                </label>
                                <div class="accordion" id="categoriaAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingCategorias">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategorias">
                                                Selecione as categorias
                                            </button>
                                        </h2>
                                        <div id="collapseCategorias" class="accordion-collapse collapse" data-bs-parent="#categoriaAccordion">
                                            <div class="accordion-body">
                                                @foreach($categorias as $categoria)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                                id="categoria_{{ $categoria->cd_categoria }}"
                                                                name="categorias[]"
                                                                value="{{ $categoria->cd_categoria }}"
                                                                @isset($meta)
                                                                {{ in_array($categoria->cd_categoria,$meta->categoria()->pluck('categoria.cd_categoria')->toArray()) ? 'checked' : ''}}
                                                                @else
                                                                    {{ in_array($categoria->cd_categoria, old('categorias') ?? []) ? 'checked' : '' }}
                                                                @endisset
                                                        <label class="form-check-label" for="categoria_{{ $categoria->cd_categoria }}">
                                                            {{ $categoria->nm_categoria }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            <x-helper.error campo="categorias"></x-helper.error>
                            <x-helper.error campo="ds_descricao"></x-helper.error>
                            <x-helper.error campo="pc_meta"></x-helper.error>
                            <x-helper.error campo="vl_valor_meta"></x-helper.error>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="row mb-3 p-3">
                        <h4 class="text-dark mb-4">
                            <i class="bi text-primary bi-currency-exchange"></i>
                            Definição de valores
                        </h4>
                        <div id="seletorValor" class="col-md-6">
                            <label for="pc_meta" class="form-label text-danger fw-semibold">
                                <i class="bi bi-question me-1"></i>
                                Selecione o tipo da meta!
                            </label>
                            <div class="input-group text-center">
                                <p class="form-control fs-6 fst-italic">
                                    Permite definir se associada a uma valor fixo ou percentual
                                </p>
                            </div>
                        </div>

                        <!-- Data de Término -->
                        <div class="col-md-6">
                            <label for="dt_termino" class="form-label fw-semibold">
                                <i class="bi bi-calendar-event text-secondary me-1"></i>
                                Data de Término
                            </label>
                            <input type="date" class="form-control" id="dt_termino" name="dt_termino"
                                value={{ old('dt_termino', $meta->dt_termino ?? '') }}>
                        </div>
                        @if($errors->any())
                            <x-helper.error campo="dt_termino"></x-helper.error>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Painel Inferior - Seleção de Registros -->
        <div class="row mb-4">
            <div class="col-12 w-100">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-dark mb-0">
                                <i class="bi bi-list-check text-primary me-2"></i>
                                Associar Registros à Meta
                            </h4>
                            <div>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    <span id="contadorSelecionados">0</span> selecionados
                                </span>

                                <span class="badge bg-info bg-opacity-10 text-primary px-3 py-2">
                                    <span id="contadorGeral">0</span> registros
                                </span>
                            </div>
                        </div>

                        <!-- Filtros de Busca
                        A SER CODIFICADO !!!!!!!!!
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control" id="filtroRegistros"
                                        placeholder="Buscar registros por nome ou descrição...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-outline-primary w-100" id="btnLimparFiltros">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Limpar Filtros
                                </button>
                            </div>
                        </div>
                        -->

                        <!-- Lista de Registros -->
                        <div id="painelRegistros" class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
                            <!-- Aqui os elementos são inseridos dinâmicamente com o script public/js/metas/create -->
                        </div>
                        <!-- Ações para Seleção -->
                        <div class="row mt-3 pt-3 border-top">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-primary w-100" id="btnSelecionarTodos">
                                    <i class="bi bi-check-all me-1"></i>
                                    Selecionar Todos
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-secondary w-100" id="btnDesmarcarTodos">
                                    <i class="bi bi-x-square me-1"></i>
                                    Desmarcar Todos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botões de Ação -->
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
<script>
    const registros = @json($registros);
    @isset($meta)
        const valorMeta = {{ $meta->vl_valor_meta ?? $meta->pc_meta }};
        const registrosDaMeta = @json($registrosDaMeta->pluck('cd_registro')->toArray());
        const tipoMeta = {{ $meta->cd_tipo_meta }};
    @endisset
</script>
