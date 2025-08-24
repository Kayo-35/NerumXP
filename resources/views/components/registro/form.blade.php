<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm transition-all-300 hover-shadow-lg hover-translate-y-1">
                <div class="card-header bg-success text-white">
                    <h2 class="card-title mb-0">
                        <i class="bi bi-cash-coin me-2"></i>
                        {{ $titulo }}
                    </h2>
                </div>
                <div class="card-body">
                    <form id="registroForm" method="POST"
                        @if(isset($registro))
                            action="{{ route($rotaProcessamento,$registro->cd_registro_fixo) }}">
                            @method('PUT')
                        @else
                            action="{{ route("registroFixo.store") }}">
                        @endif
                        @csrf
                        <!-- GRUPO I - Informações Essenciais -->
                        <div class="border border-light-subtle rounded-3 p-4 mb-4 bg-light">
                            <h4 class="text-secondary fw-semibold mb-3 pb-2 border-bottom border-success">
                                <i class="bi bi-1-circle-fill me-2"></i>
                                Informações Essenciais
                            </h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tipoRegistro" class="form-label">
                                        Tipo de Registro <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="tipoRegistro" name="cd_tipo_registro">
                                        <option value="">Selecione o tipo</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $tipo['cd_tipo_registro'] }}"
                                                @isset($registro)
                                                    {{$registro->cd_tipo_registro == $tipo['cd_tipo_registro'] ? 'selected' : ''}}
                                                @endisset
                                            >
                                                {{ $tipo['nm_tipo'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nomeRegistro" class="form-label">
                                        Nome do Registro <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nomeRegistro" name="nm_registro"
                                            placeholder="Ex: Salário, Aluguel, Conta de Luz..."
                                            @isset($registro)
                                                value="{{ $registro->nm_registro }}"
                                            @endisset
                                            >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="valor" class="form-label">
                                        Valor <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" class="form-control" id="valor" name="vl_valor"
                                            placeholder="0.00" step="0.01" min="0"
                                            @if(isset($registro))
                                                value="{{ $registro->vl_valor }}" >
                                            @else
                                                >
                                            @endif
                                   </div>
                                </div>

                                <div class="col-md-6 mb-3 d-flex align-items-end">
                                    <div class="form-check">
                                        <input type="hidden" name="ic_pago" value="0">
                                        <input class="form-check-input" type="checkbox" id="pago" name="ic_pago"
                                            @isset($registro)
                                                {{ $registro->ic_pago == 1 ? 'checked' : ''}}
                                            @endisset
                                            value="1"
                                        >
                                        <label class="form-check-label" for="pago">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Já foi pago?
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                                    <input type="date" class="form-control" id="dataPagamento" name="dt_pagamento">
                                </div>

                                <div class="col-md-6 mb-3 d-flex flex-column">
                                    <label for="metodoPagamento" class="form-label">Método de Pagamento</label>
                                        <button class="btn btn-secondary dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                        >
                                            Métodos De Pagamento
                                        </button>
                                        <ul class="dropdown-menu bg-secondary text-light p-2">
                                        @foreach($metodos as $metodo)
                                            <li>
                                                <input type="checkbox"
                                                    class="form-check-input"
                                                    value="{{ $metodo->cd_tipo_metodo}}"
                                                    name="metodos[]"
                                                    @if(!empty($metodosProprios))
                                                        {{ in_array($metodo->cd_tipo_metodo,$metodosProprios) ? 'checked' : ''}}
                                                    @endif
                                                >
                                                {{ $metodo->nm_tipo_metodo}}
                                            </li>
                                        @endforeach
                                        </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="formaPagamento" class="form-label">Forma de Pagamento</label>
                                    <select class="form-select" id="formaPagamento" name="cd_tipo_forma">
                                        <option value="">Selecione a forma</option>
                                        @foreach($formas as $forma)
                                            <option value="{{ $forma['cd_tipo_forma'] }}"
                                                @isset($registro)
                                                    {{ $forma['cd_tipo_forma'] == $registro->cd_forma_pagamento ? 'selected' : ''}}
                                                @endisset
                                            >
                                                {{ $forma['nm_tipo_metodos'] }}
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
                                                @isset($registro)
                                                    {{  $importancia['cd_nivel_imp'] == $registro->cd_nivel_imp ? 'selected' : ''}}
                                                @endisset
                                            >
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
                                                @isset($registro)
                                                    {{ $registro->cd_categoria == $categoria['cd_categoria'] ? 'selected' : ''}}
                                                @endisset
                                            >
                                                {{ $categoria['nm_categoria'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                        placeholder="Descrição detalhada do registro...">
                                            @isset($registro)
                                                {{ $registro->ds_descricao }}
                                            @endisset
                                    </textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="localizacao" class="form-label">Localização</label>
                                    <select class="form-select" id="localizacao" name="cd_localizacao">
                                        <option value="">Selecione a localização</option>
                                        @foreach($localizacaos as $localizacao)
                                            <option value="{{ $localizacao['cd_localizacao'] }}"
                                                @isset($registro)
                                                    {{ $registro->cd_localizacao == $localizacao['cd_localizacao'] ? 'selected' : ''}}
                                                @endisset
                                            >
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
                                                @isset($registro)
                                                    {{ $registro->cd_realizador == $realizador['cd_realizador'] ? 'selected' : ''}}
                                                @endisset
                                            >
                                                {{ $realizador['nm_realizador']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input type="hidden" name="ic_status" value="0">
                                        <input class="form-check-input" type="checkbox" id="status" name="ic_status"
                                            @isset($registro)
                                                {{ $registro->ic_status == 1 ? 'checked' : '' }}
                                            @endisset
                                            value="1"
                                        >
                                        <label class="form-check-label" for="status">
                                            <i class="bi bi-toggle-on me-1"></i>
                                            Registro ativo
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Limpar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i>
                                Salvar Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
