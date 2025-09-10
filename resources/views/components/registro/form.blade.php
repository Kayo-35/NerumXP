<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm transition-all-300 hover-shadow-lg hover-translate-y-1">
                <div class="card-header bg-primary text-white row d-flex justify-content-between align-items-center m-0">
                    <h2 class="card-title mb-0 col-8">
                        <i class="bi bi-cash-coin me-2"></i>
                        {{ $titulo }}
                    </h2>
                    @if(Auth::user()->cd_assinatura > 1)
                        <div class="bg-light text-dark pt-1 py-2 rounded rounded-5 d-flex justify-content-center col-2">
                            <div class="form-check form-switch mt-1">
                                <input class="form-check-input w-50 h-75" type="checkbox" role="switch" id="acionador"
                                    {{ old('cd_modalidade', $registro->cd_modalidade ?? '') == 2 ? 'checked' : '' }}>
                                <label class="form-check-label text-primary fw-bold" for="acionador">Flutuante</label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <form id="registroForm" method="POST"
                        action="{{ isset($registro) ? route($rotaProcessamento, $registro->cd_registro) : route('registro.store') }}">
                        @csrf
                        @isset($registro)
                            @method('PUT')
                        @endisset

                        <!-- GRUPO I - Informações Essenciais -->
                        <div class="border border-light-subtle rounded-3 p-4 mb-4 bg-light">
                            <h4 class="text-secondary fw-semibold mb-3 pb-2 border-bottom border-success">
                                <i class="bi bi-1-circle-fill me-2"></i>
                                Informações Essenciais
                            </h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tipoRegistro" class="form-label">Tipo de Registro <span class="text-danger">*</span></label>
                                    <select class="form-select" id="tipoRegistro" name="cd_tipo_registro">
                                        <option value="">Selecione o tipo</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $tipo['cd_tipo_registro'] }}"
                                                @isset($registro)
                                                    {{$registro->cd_tipo_registro == $tipo['cd_tipo_registro'] ? 'selected' : ''}}
                                                @endisset
                                                @if((old('cd_tipo_registro' !== null)))
                                                    {{ old('cd_tipo_registro') == $tipo['cd_tipo_registro'] ? 'selected' : '' }}
                                                @endif
                                            >
                                                {{ $tipo['nm_tipo'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nomeRegistro" class="form-label">Nome do Registro <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomeRegistro" name="nm_registro"
                                        placeholder="Ex: Salário, Aluguel, Conta de Luz..."
                                        value="{{ old('nm_registro', $registro->nm_registro ?? '') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="valor" class="form-label">Valor <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" class="form-control" id="valor" name="vl_valor"
                                            placeholder="0.00" step="0.01" min="0"
                                            value="{{ old('vl_valor', $registro->vl_valor ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2 d-flex align-items-end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pago" name="ic_pago" value="1"
                                            {{ old('ic_pago', $registro->ic_pago ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pago">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Já foi pago?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @if($errors->any())
                                <div>
                                    <x-helper.error campo="vl_valor"/>
                                    <x-helper.error campo="cd_tipo_registro"/>
                                    <x-helper.error campo="nm_registro"/>
                                    <x-helper.error campo="ic_pago"/>
                                </div>
                            @endif
                        </div>

                        <!-- GRUPO II - Detalhes de Pagamento e Classificação -->
                        <div class="border border-light-subtle rounded-3 p-4 mb-4 bg-light">
                            <h4 class="text-secondary fw-semibold mb-3 pb-2 border-bottom border-success">
                                <i class="bi bi-2-circle-fill me-2"></i>
                                Detalhes de Pagamento e Classificação
                            </h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dataPagamento" class="form-label">Data de Pagamento</label>
                                    <input type="date" class="form-control" id="dataPagamento" name="dt_pagamento"
                                        value="{{ old('dt_pagamento', $registro->dt_pagamento ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3 d-flex flex-column">
                                    <label for="metodoPagamento" class="form-label">Método de Pagamento</label>
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Métodos De Pagamento
                                    </button>
                                    <ul class="dropdown-menu bg-secondary text-light p-2">
                                        @foreach($metodos as $metodo)
                                            <li>
                                                <input type="checkbox" class="form-check-input" value="{{ $metodo->cd_metodo }}"
                                                    name="metodos[]"
                                                    {{ in_array($metodo->cd_metodo, old('metodos', $metodosProprios ?? [])) ? 'checked' : '' }}>
                                                {{ $metodo->nm_metodo }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="formaPagamento" class="form-label">Forma de Pagamento</label>
                                    <select class="form-select" id="formaPagamento" name="cd_forma">
                                        <option value="">Selecione a forma</option>
                                        @foreach($formas as $forma)
                                            <option value="{{ $forma['cd_forma'] }}"
                                                {{ (string) old('cd_forma', $registro->cd_forma_pagamento ?? '') === (string) $forma['cd_forma'] ? 'selected' : '' }}>
                                                {{ $forma['nm_forma'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nivelImportancia" class="form-label">Nível de Importância</label>
                                    <select class="form-select" id="nivelImportancia" name="cd_nivel_imp">
                                        <option value="">Selecione o nível</option>
                                        @foreach($importancias as $importancia)
                                            <option value="{{ $importancia['cd_nivel_imp'] }}"
                                                {{ (string) old('cd_nivel_imp', $registro->cd_nivel_imp ?? '') === (string) $importancia['cd_nivel_imp'] ? 'selected' : '' }}>
                                                {{ $importancia['sg_nivel_imp'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select class="form-select" id="categoria" name="cd_categoria">
                                        <option value="">Selecione a categoria</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria['cd_categoria'] }}"
                                                {{ (string) old('cd_categoria', $registro->cd_categoria ?? '') === (string) $categoria['cd_categoria'] ? 'selected' : '' }}>
                                                {{ $categoria['nm_categoria'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if($errors->any())
                                <div>
                                    <x-helper.error campo="dt_pagamento"/>
                                    <x-helper.error campo="cd_forma_pagamento"/>
                                    <x-helper.error campo="metodos.*"/>
                                    <x-helper.error campo="cd_nivel_imp"/>
                                    <x-helper.error campo="cd_categoria"/>
                                </div>
                            @endif
                        </div>

                        <!-- GRUPO III - Informações Adicionais -->
                        <div class="border border-light-subtle rounded-3 p-4 mb-4 bg-light">
                            <h4 class="text-secondary fw-semibold mb-3 pb-2 border-bottom border-success">
                                <i class="bi bi-3-circle-fill me-2"></i>
                                Informações Adicionais
                            </h4>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="descricao" name="ds_descricao" rows="3"
                                        placeholder="Descrição detalhada do registro...">{{ old('ds_descricao', $registro->ds_descricao ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="localizacao" class="form-label">Localização</label>
                                    <select class="form-select" id="localizacao" name="cd_localizacao">
                                        <option value="">Selecione a localização</option>
                                        @foreach($localizacaos as $localizacao)
                                            <option value="{{ $localizacao['cd_localizacao'] }}"
                                                {{ (string) old('cd_localizacao', $registro->cd_localizacao ?? '') === (string) $localizacao['cd_localizacao'] ? 'selected' : '' }}>
                                                {{ $localizacao['nm_localizacao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="realizador" class="form-label">Realizador</label>
                                    <select class="form-select" id="realizador" name="cd_realizador">
                                        <option value="">Quem realizou?</option>
                                        @foreach($realizadores as $realizador)
                                            <option value="{{ $realizador['cd_realizador'] }}"
                                                {{ (string) old('cd_realizador', $registro->cd_realizador ?? '') === (string) $realizador['cd_realizador'] ? 'selected' : '' }}>
                                                {{ $realizador['nm_realizador'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="ic_status" value="1"
                                            {{ old('ic_status', $registro->ic_status ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            <i class="bi bi-toggle-on me-1"></i>
                                            Registro ativo
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @if($errors->any())
                                <div>
                                    <x-helper.error campo="ds_descricao"/>
                                    <x-helper.error campo="cd_localizacao"/>
                                    <x-helper.error campo="cd_realizador"/>
                                    <x-helper.error campo="ic_status"/>
                                </div>
                            @endif
                        </div>

                        <input type="hidden" id="modalidade" name="cd_modalidade" value="{{ old('cd_modalidade', $registro->cd_modalidade ?? 1) }}">

                        <input id='modalidade' value="1" name="cd_modalidade" hidden>
                        @if(Auth::user()->cd_assinatura > 1)
                            <!-- GRUPO IV - Modalidade Flutuante -->
                            <div id='flutuante' class="border border-light-subtle rounded-3 p-4 mb-4 bg-light" style="display: none">
                                <h4 class="text-secondary fw-semibold mb-3 pb-2 border-bottom border-success">
                                    <i class="bi bi-4-circle-fill me-2"></i>
                                    Modalidade
                                </h4>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="modalidade" class="form-label">Modalidade</label>
                                        <div class="form-control" id="legenda">
                                            {{ (old('cd_modalidade', $registro->cd_modalidade ?? 1) == 2) ? 'Flutuante' : 'Fixo' }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="juros" class="form-label">Tipo de Juros</label>
                                        <select class="form-select Flutuante" id="juros" name="cd_tipo_juro">
                                            <option value="">Selecione o tipo...</option>
                                            @foreach($juros as $juro)
                                                <option value="{{ $juro['cd_tipo_juro'] }}"
                                                    @isset($registro)
                                                        {{ $registro->cd_tipo_juro == $juro['cd_tipo_juro'] ? 'selected' : ''}}
                                                    @endisset
                                               >
                                                    {{ $juro['nm_tipo_juro']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="taxa_juros" class="form-label">Taxa de Juros</label>
                                        <div class="input-group">
                                            <span class="input-group-text">%</span>
                                            <input type="number" class="form-control Flutuante" id="taxa_juros" name="pc_taxa_juros"
                                                placeholder="0.00" step="0.01" min="0"
                                                @isset($registro)
                                                    value="{{ $registro->pc_taxa_juros }}"
                                                @endisset
                                                >
                                       </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="incidencia" class="form-label">Período de Capitalização</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Meses</span>
                                            <input type="number" class="form-control Flutuante" id="incidencia" name="qt_meses_incidencia" min="0"
                                                value="{{ old('qt_meses_incidencia', $registro->qt_meses_incidencia ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                @if($errors->any())
                                    <div>
                                        <x-helper.error campo="cd_modalidade"/>
                                        <x-helper.error campo="cd_tipo_juro"/>
                                        <x-helper.error campo="pc_taxa_juros"/>
                                        <x-helper.error campo="qt_meses_incidencia"/>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Limpar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>
                                Salvar Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
