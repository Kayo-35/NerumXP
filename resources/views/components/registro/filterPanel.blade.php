@props(
["tipos","categorias","importancias","modalidades"]
)
<div class="container-fluid p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button
            class="btn btn-outline-primary border-0 rounded-3 px-4 py-2 shadow-sm d-flex align-items-center"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#painelFiltragem">
            <div class="bg-primary bg-opacity-10 rounded-2 p-1 me-2">
                <i class="bi bi-funnel text-primary"></i>
            </div>
            <span class="fw-medium">Filtros Avançados</span>
            <i class="bi bi-chevron-down ms-2 transition-rotate" id="chevronIcon"></i>
        </button>

        <div class="m-3">
            <div class="me-3 rounded rounded-5">
                <a class="btn btn-lg btn-outline-primary px-5 py-0" href="{{ route("registro.create") }}">
                    <i class="bi bi-plus fs-2"></i>
                </a>
            </div>
        </div>

        <!--Incluir JavaScript futuro para visualização de contagem-->
        <span
            class="badge bg-primary rounded-pill"
            id="filtrosAtivos"
            style="display: none">
            <i class="bi bi-filter me-1"></i>
            <span id="contadorFiltros">0</span> filtros ativos
        </span>
    </div>

    <div class="collapse" id="painelFiltragem">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form method="GET">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-lg-3 col-md-6">
                            <label
                                for="tipoRegistro"
                                class="form-label text-muted fw-medium small">
                                Tipo de Registro
                            </label>
                            <select
                                class="form-select border-0 bg-light rounded-3 py-2"
                                id="tipoRegistro"
                                name="cd_tipo_registro">
                                <option value="">Selecione o tipo</option>
                                @foreach($tipos as $tipo)
                                <option value="{{$tipo->cd_tipo_registro}}"
                                    {{ old('cd_tipo_registro') == $tipo->cd_tipo_registro ? 'selected' : '' }}>
                                    {{$tipo->nm_tipo}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label
                                for="modalidades"
                                class="form-label text-muted fw-medium small">
                                Modalidade
                            </label>
                            <select
                                class="form-select border-0 bg-light rounded-3 py-2"
                                id="modalidades"
                                name="modalidades">
                                <option value="">Selecione a modalidade</option>
                                @foreach($modalidades as $modalidade)
                                <option value="{{$modalidade->cd_modalidade}}"
                                    {{ $modalidade->cd_modalidade == old('modalidades') ? 'selected' : '' }}>
                                    {{ $modalidade->nm_modalidade }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label
                                for="dt_inicio"
                                class="form-label text-muted fw-medium small">
                                Data de Início
                            </label>
                            <input
                                type="date"
                                class="form-control border-0 bg-light rounded-3 py-2"
                                id="dt_inicio"
                                name="dt_inicio"
                                value="{{ old('dt_inicio')}}" />
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label for="dt_fim" class="form-label text-muted fw-medium small">
                                Data de Término
                            </label>
                            <input
                                type="date"
                                class="form-control border-0 bg-light rounded-3 py-2"
                                id="dt_fim"
                                name="dt_fim"
                                value="{{ old('dt_fim') }}" />
                        </div>
                    </div>

                    <!-- Segunda linha de filtros -->
                    <div class="row g-3 mb-4">
                        <div class="col-lg-4 col-md-6">
                            <label for="valor" class="form-label text-muted fw-medium small">
                                Valor Mínimo
                            </label>
                            <div class="input-group">
                                <span
                                    class="input-group-text border-0 bg-light text-muted rounded-start-3">
                                    R$
                                </span>
                                <input
                                    type="number"
                                    class="form-control border-0 bg-light rounded-end-3 py-2"
                                    id="valor"
                                    name="vl_valor_minimo"
                                    placeholder="0,00"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('vl_valor_minimo') }}" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <label
                                for="categorias"
                                class="form-label text-muted fw-medium small">
                                Categorias
                            </label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-light border-0 rounded-3 py-2 w-100 text-start d-flex justify-content-between align-items-center"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="text-muted">Selecione as categorias</span>
                                    <i class="bi bi-chevron-down text-muted"></i>
                                </button>
                                <ul class="dropdown-menu border-0 shadow-sm rounded-3 w-100">
                                    @foreach($categorias as $categoria)
                                    <li class="px-3 py-2">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="{{$categoria->cd_categoria}}"
                                                id="categoria_{{$categoria->cd_categoria}}"
                                                name="categorias[]"
                                                @unless(empty(old('categorias')))
                                                {{ in_array($categoria->cd_categoria,old('categorias')) ? 'checked' : '' }}
                                                @endunless />
                                            <label
                                                class="form-check-label text-dark"
                                                for="categoria_{{$categoria->cd_categoria}}">
                                                {{$categoria->nm_categoria}}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <label
                                for="urgencia"
                                class="form-label text-muted fw-medium small">
                                Urgência
                            </label>
                            <div class="dropdown">
                                <button
                                    class="btn btn-light border-0 rounded-3 py-2 w-100 text-start d-flex justify-content-between align-items-center"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="text-muted">Selecione a urgência</span>
                                    <i class="bi bi-chevron-down text-muted"></i>
                                </button>
                                <ul class="dropdown-menu border-0 shadow-sm rounded-3 w-100">
                                    @foreach($importancias as $importancia)
                                    <li class="px-3 py-2">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="{{$importancia->cd_nivel_imp}}"
                                                name="nivel_imp[]"
                                                id="urgencia_{{$importancia->cd_nivel_imp}}"
                                                @unless(empty(old('nivel_imp')))
                                                {{ in_array($importancia->cd_nivel_imp,old('nivel_imp')) ? 'checked' : '' }}
                                                @endunless />
                                            <label
                                                class="form-check-label text-dark"
                                                for="urgencia_{{$importancia->cd_nivel_imp}}">
                                                {{$importancia->sg_nivel_imp}}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Terceira linha - Checkboxes e botões -->
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-6 col-md-8">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="pago"
                                        name="ic_pago"
                                        value="1" />
                                    <label
                                        class="form-check-label text-dark fw-medium"
                                        for="pago">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        Já foi pago?
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="ativo"
                                        name="ic_status"
                                        value="1" />
                                    <label
                                        class="form-check-label text-dark fw-medium"
                                        for="ativo">
                                        <i class="bi bi-toggle-on text-primary me-2"></i>
                                        Ativo?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4">
                            <div class="d-flex justify-content-end gap-2">
                                <button
                                    type="reset"
                                    class="btn btn-outline-secondary border-0 rounded-3 px-4 py-2"
                                    onclick="limparFiltros()">
                                    <i class="bi bi-arrow-clockwise me-2"></i>
                                    Limpar
                                </button>
                                <button
                                    type="submit"
                                    class="btn btn-primary rounded-3 px-4 py-2 shadow-sm">
                                    <i class="bi bi-search me-2"></i>
                                    Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-6">
                        <x-helper.error campo="cd_tipo_registro"/>
                        <x-helper.error campo="modalidades"/>
                        <x-helper.error campo="dt_inicio"/>
                        <x-helper.error campo="dt_fim"/>
                        <x-helper.error campo="vl_valor_minimo"/>
                        <x-helper.error campo="ic_status"/>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
