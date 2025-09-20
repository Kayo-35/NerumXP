<x-layout>
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
                                <h2 class="mb-1 text-dark">Criar Nova Meta</h2>
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
        <form id="formCriarMeta">
            <!-- Painel Superior - Dados da Meta -->
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
                                        placeholder="Digite o nome da sua meta">
                                </div>

                                <!-- Nível de Importância -->
                                <div class="col-md-4">
                                    <label for="cd_nivel_imp" class="form-label fw-semibold">
                                        <i class="bi bi-star text-secondary me-1"></i>
                                        Nível de Importância
                                    </label>
                                    <select class="form-select" id="cd_nivel_imp" name="cd_nivel_imp">
                                        <option value="">Selecione...</option>
                                        <option value="1">Baixa</option>
                                        <option value="2">Média</option>
                                        <option value="3">Alta</option>
                                        <option value="4">Crítica</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!-- Valor da Meta -->
                                <div class="col-md-4">
                                    <label for="vl_valor_meta" class="form-label fw-semibold">
                                        <i class="bi bi-currency-dollar text-secondary me-1"></i>
                                        Valor da Meta (R$)
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="number" class="form-control" id="vl_valor_meta" name="vl_valor_meta"
                                            step="0.01" min="0" placeholder="0,00">
                                    </div>
                                </div>

                                <!-- Percentual da Meta -->
                                <div class="col-md-4">
                                    <label for="pc_meta" class="form-label fw-semibold">
                                        <i class="bi bi-percent text-secondary me-1"></i>
                                        Percentual da Meta (%)
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="pc_meta" name="pc_meta"
                                            step="0.01" min="0" max="100" placeholder="0,00">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>

                                <!-- Data de Término -->
                                <div class="col-md-4">
                                    <label for="dt_termino" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-event text-secondary me-1"></i>
                                        Data de Término
                                    </label>
                                    <input type="date" class="form-control" id="dt_termino" name="dt_termino">
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="ds_descricao" class="form-label fw-semibold">
                                        <i class="bi bi-file-text text-secondary me-1"></i>
                                        Descrição
                                    </label>
                                    <textarea class="form-control" id="ds_descricao" name="ds_descricao" rows="3"
                                        placeholder="Descreva os detalhes da sua meta..."></textarea>
                                </div>
                            </div>

                            <!-- Checkboxes de Configuração -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ic_status" name="ic_status" checked>
                                        <label class="form-check-label fw-semibold" for="ic_status">
                                            <i class="bi bi-check-circle text-success me-1"></i>
                                            Meta Ativa
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ic_recorrente" name="ic_recorrente">
                                        <label class="form-check-label fw-semibold" for="ic_recorrente">
                                            <i class="bi bi-arrow-repeat text-primary me-1"></i>
                                            Meta Recorrente
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="ic_finalizada" name="ic_finalizada">
                                        <label class="form-check-label fw-semibold" for="ic_finalizada">
                                            <i class="bi bi-check2-circle text-success me-1"></i>
                                            Meta Finalizada
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <!-- Espaço reservado para alinhamento -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Painel Inferior - Seleção de Registros -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-dark mb-0">
                                    <i class="bi bi-list-check text-primary me-2"></i>
                                    Associar Registros à Meta
                                </h4>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                    <span id="contadorSelecionados">0</span> selecionados
                                </span>
                            </div>

                            <!-- Filtros de Busca -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input type="text" class="form-control" id="filtroRegistros"
                                            placeholder="Buscar registros por nome ou descrição...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="filtroTipo">
                                        <option value="">Todos os tipos</option>
                                        <option value="receita">Receitas</option>
                                        <option value="despesa">Despesas</option>
                                        <option value="investimento">Investimentos</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-outline-primary w-100" id="btnLimparFiltros">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Limpar Filtros
                                    </button>
                                </div>
                            </div>

                            <!-- Lista de Registros -->
                            <div class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">

                                <!-- Registro 1 -->
                                <div class="list-group-item border-0 px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input registro-checkbox" type="checkbox"
                                                    value="1" id="registro1">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                                <i class="bi bi-arrow-up-circle text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">Salário Mensal</h6>
                                                    <small class="text-secondary">Receita recorrente - Categoria: Trabalho</small>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="text-success mb-0">R$ 5.000,00</h6>
                                                    <small class="text-secondary">15/09/2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Registro 2 -->
                                <div class="list-group-item border-0 px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input registro-checkbox" type="checkbox"
                                                    value="2" id="registro2">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="bg-danger bg-opacity-10 p-2 rounded-circle">
                                                <i class="bi bi-arrow-down-circle text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">Aluguel</h6>
                                                    <small class="text-secondary">Despesa fixa - Categoria: Habitação</small>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="text-danger mb-0">R$ 1.200,00</h6>
                                                    <small class="text-secondary">10/09/2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Registro 3 -->
                                <div class="list-group-item border-0 px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input registro-checkbox" type="checkbox"
                                                    value="3" id="registro3">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                                <i class="bi bi-graph-up text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">Investimento CDB</h6>
                                                    <small class="text-secondary">Investimento - Categoria: Renda Fixa</small>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="text-primary mb-0">R$ 2.000,00</h6>
                                                    <small class="text-secondary">05/09/2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Registro 4 -->
                                <div class="list-group-item border-0 px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input registro-checkbox" type="checkbox"
                                                    value="4" id="registro4">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="bg-danger bg-opacity-10 p-2 rounded-circle">
                                                <i class="bi bi-arrow-down-circle text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">Supermercado</h6>
                                                    <small class="text-secondary">Despesa variável - Categoria: Alimentação</small>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="text-danger mb-0">R$ 350,00</h6>
                                                    <small class="text-secondary">03/09/2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Registro 5 -->
                                <div class="list-group-item border-0 px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input registro-checkbox" type="checkbox"
                                                    value="5" id="registro5">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                                <i class="bi bi-arrow-up-circle text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">Freelance</h6>
                                                    <small class="text-secondary">Receita extra - Categoria: Trabalho</small>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="text-success mb-0">R$ 800,00</h6>
                                                    <small class="text-secondary">01/09/2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Registro 6 -->
                                <div class="list-group-item border-0 px-0">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="form-check">
                                                <input class="form-check-input registro-checkbox" type="checkbox"
                                                    value="6" id="registro6">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                                <i class="bi bi-credit-card text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="mb-1">Cartão de Crédito</h6>
                                                    <small class="text-secondary">Despesa cartão - Categoria: Diversos</small>
                                                </div>
                                                <div class="text-end">
                                                    <h6 class="text-warning mb-0">R$ 650,00</h6>
                                                    <small class="text-secondary">30/08/2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        Criar Meta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>
