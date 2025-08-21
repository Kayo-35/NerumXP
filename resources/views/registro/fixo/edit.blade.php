<x-layout>
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm transition-all-300 hover-shadow-lg hover-translate-y-1">
                <div class="card-header bg-danger text-white">
                    <h2 class="card-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Editar Registro Fixo
                    </h2>
                </div>
                <div class="card-body">
                    <form id="registroForm" method="POST"
                        action="{{ route("registroFixo.put", $registro['cd_registro_fixo']) }}"
                    >
                        @csrf
                        @method('PUT')
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
                                    <select class="form-select" id="tipoRegistro" name="cd_tipo_registro" required>
                                        <option value="">Selecione o tipo</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $registro['cd_tipo_registro'] }}"
                                                {{ ($registro['cd_tipo_registro'] == $tipo['cd_tipo_registro'])
                                                ?
                                                    "selected"
                                                :
                                                    ''
                                                }}
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
                                    <input type="text" class="form-control" id="nomeRegistro" name="nm_registroFixo"
                                            placeholder="Ex: Salário, Aluguel, Conta de Luz..." value="{{ $registro->nm_registroFixo }}" required>
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
                                                placeholder="0.00" step="0.01" min="0" value="{{ $registro->vl_valor }}" required>
                                   </div>
                                </div>

                                <div class="col-md-6 mb-3 d-flex align-items-end">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pago" name="ic_pago" {{ $registro->ic_pago ? "checked" : "" }}>
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
                                    <input type="date" class="form-control" id="dataPagamento" name="dt_pagamento" value="{{ $registro->dt_pagamento }}">
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
                                        <!--
                                            Essa estrutura é um pouco complexa por lidar com tabelas
                                            associativas, mas basicamente o laço de repetição externo
                                            constroe a marcação html de cada um dos métodos de pagamento,
                                            dos quais são constituidos como checkboxes.

                                            Durante sua execução utilizo da função built-in in_array()
                                            para verificar se o código do método sendo construido
                                            no momento está presente na lista de métodos do registro
                                        -->
                                        @foreach($metodos as $metodo)
                                            <li>
                                                <input type="checkbox"
                                                    class="form-check-input"
                                                    value="{{ $metodo->cd_tipo_metodo}}"
                                                    {{ in_array($metodo->cd_tipo_metodo,$metodosProprios) ? 'checked' : ''}}
                                                >
                                                {{ $metodo->nm_tipo_metodo}}
                                            </li>
                                        @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 d-flex flex-column">
                                    <label for="formaPagamento" class="form-label">Forma de Pagamento</label>
                                    <select class="form-select" id="formaPagamento" name="cd_forma_pagamento">
                                        <option value="">Selecione o nível</option>
                                        @foreach($formas as $forma)
                                            <option value="{{ $forma["cd_tipo_forma"] }}"
                                                {{ $registro->cd_forma_pagamento == $forma["cd_tipo_forma"] ? "selected" : "" }}
                                            >
                                                {{ $forma['nm_tipo_metodos'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nivelImportancia" class="form-label">Nível de Importância</label>
                                    <select class="form-select" id="nivelImportancia" name="cd_nivel_importancia">
                                        <option value="">Selecione o nível</option>
                                        @foreach($importancias as $importancia)
                                            <option value="{{ $importancia["cd_nivel_imp"] }}"
                                                {{ $registro->cd_nivel_imp == $importancia["cd_nivel_imp"] ? "selected" : "" }}
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
                                    <select class="form-select" id="categoria" name="categoria">
                                        <option value="">Selecione a categoria</option>
                                        <option value="">Alimentação</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria["cd_categoria"] }}" {{ $registro->cd_categoria == $categoria["cd_categoria"] ? "selected" : "" }}>
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
                                    <textarea class="form-control" id="descricao" name="descricao" rows="3"
                                                placeholder="Descrição detalhada do registro..." >{{ $registro->ds_descricao }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="localizacao" class="form-label">Localização</label>
                                    <select class="form-select" id="localizacao" name="localizacao">
                                        <option value="">Selecione a localização</option>
                                        @foreach($localizacaos as $localizacao)
                                            <option value="{{ $localizacao["cd_localizacao"] }}" {{ $registro->cd_localizacao == $localizacao["cd_localizacao"] ? "selected" : "" }}>
                                                {{ $localizacao['nm_localizacao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="realizador" class="form-label">Realizador</label>
                                    <select class="form-select" id="realizador" name="realizador">
                                        <option value="">Quem realizou?</option>
                                        @foreach($realizadores as $realizador)
                                            <option value="{{ $realizador["cd_realizador"] }}" {{ $registro->cd_realizador == $realizador["cd_realizador"] ? "selected" : "" }}>
                                                {{ $realizador['nm_realizador']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" {{ $registro->status ? "checked" : "" }}>
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
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-save me-1"></i>
                                Atualizar Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
