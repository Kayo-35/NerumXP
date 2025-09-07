<x-layout>
    @guest
    <main>
    <!-- ================= HERO ================= -->
        <header class="text-center py-5 bg-light">
            <div class="container">
            <div class="row align-items-center">

                <!-- Texto principal -->
                <div class="col-md-6 text-md-start">
                <h1 class="display-4">Organize sua vida financeira com facilidade.</h1>
                <p class="lead my-4">
                    Controle seus ganhos, acompanhe seus gastos e descubra onde seu dinheiro está indo — tudo em um só lugar.
                </p>
                <a href="#planos" class="btn btn-success btn-lg mb-4">Comece já</a>
                </div>

                <!-- Imagem ilustrativa -->
                <div class="col-md-6">
                <img
                    src="{{ asset('img/ilustrativa1.jpeg')}}"
                    class="img-fluid"
                    alt="Ilustração de pessoa organizando finanças"
                >
                </div>

            </div>
            </div>
        </header>

        <!-- ================= FUNCIONALIDADES ================= -->
        <section id="funcionalidades" class="py-5">
            <div class="container">

            <!-- Título da seção -->
            <div class="text-center mb-5">
                <h1>Funcionalidades</h1>
            </div>

            <div class="row">
                <!-- Card 1 -->
                <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-cash-coin fs-3 text-success me-2"></i>
                        <h5 class="mb-0">Controle de ganhos e despesas</h5>
                    </div>
                    <p>Acompanhe todas as entradas e saídas com categorias personalizadas.</p>
                    </div>
                </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-bar-chart-fill fs-3 text-success me-2"></i>
                        <h5 class="mb-0">Relatórios visuais</h5>
                    </div>
                    <p>Visualize relatórios claros e intuitivos para entender melhor suas finanças.</p>
                    </div>
                </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-bell-fill fs-3 text-success me-2"></i>
                        <h5 class="mb-0">Lembretes e metas</h5>
                    </div>
                    <p>Defina objetivos e receba notificações para manter sua disciplina financeira.</p>
                    </div>
                </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-coin fs-3 text-success me-2"></i>
                        <h5 class="mb-0">Simulação de IR</h5>
                    </div>
                    <p>Calcule facilmente a estimativa do seu imposto de renda com base em seus ganhos.</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>

        <!-- ================= PLANOS ================= -->
        <section id="planos" class="py-5 bg-light">
            <div class="container">

            <!-- Título da seção -->
            <div class="text-center mb-5">
                <h1>Planos</h1>
            </div>

            <div class="row">
                <!-- Plano Grátis -->
                <div class="col-lg-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-header"><h3>Grátis</h3></div>
                    <div class="card-body d-flex flex-column">
                    <p>Benefícios essenciais para começar a organizar suas finanças.</p>
                    <a href="#" class="btn btn-outline-success mt-auto">Comece de graça</a>
                    </div>
                </div>
                </div>

                <!-- Plano Essencial -->
                <div class="col-lg-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-header"><h3>Essencial</h3></div>
                    <div class="card-body d-flex flex-column">
                    <p>Ferramentas avançadas para um controle financeiro completo.</p>
                    <a href="#" class="btn btn-outline-success mt-auto">Assinar agora</a>
                    </div>
                </div>
                </div>

                <!-- Plano Pro -->
                <div class="col-lg-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-header"><h3>Pro</h3></div>
                    <div class="card-body d-flex flex-column">
                    <p>Todos os recursos e suporte prioritário para usuários exigentes.</p>
                    <a href="#" class="btn btn-outline-success mt-auto">Assinar agora</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>

        <!-- ================= FAQ ================= -->
        <section id="duvidas" class="py-5">
            <div class="container">

            <!-- Título da seção -->
            <div class="text-center mb-5">
                <h1>Dúvidas Frequentes</h1>
            </div>

            <div class="accordion" id="accordionDuvidas">

                <!-- Pergunta 1 -->
                <div class="accordion-item">
                <h2 class="accordion-header">
                    <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    >
                    <strong>O NerumXP é gratuito?</strong>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                    Sim! Você pode usar o plano gratuito sem tempo limite, com acesso às funcionalidades essenciais.
                    </div>
                </div>
                </div>

                <!-- Pergunta 2 -->
                <div class="accordion-item">
                <h2 class="accordion-header">
                    <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo"
                    >
                    <strong>Meus dados estão seguros?</strong>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                    Claro. Usamos criptografia de ponta e práticas seguras de armazenamento para proteger seus dados.
                    </div>
                </div>
                </div>

                <!-- Pergunta 3 -->
                <div class="accordion-item">
                <h2 class="accordion-header">
                    <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseThree"
                    >
                    <strong>Posso trocar de plano depois?</strong>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionDuvidas">
                    <div class="accordion-body">
                    Sim. Você pode mudar de plano ou cancelar sua assinatura a qualquer momento, sem burocracia.
                    </div>
                </div>
                </div>

            </div>
        </section>
    </main>
    @endguest

    @auth
        <section class="d-flex justify-content-center">
            @if($resumo[0]->vl_debito !== null && $resumo[0]->vl_superavit !== null)
            <div class="container bg-dark row m-3 border rounded rounded-5 p-3">
                <div class="text-center">
                    <h1 class="text-center mb-2 fw-bold text-primary">
                        RESUMO
                        <i class="bi bi-pie-chart-fill fs-1 me-1 text-primary"></i>
                    </h1>
                </div>
                <div class="col-12">
                    <div class="row m-5">
                        <div class="col-md-6 col-sm-12">
                            <h2 class='text-primary text-center'>Estatisticas Base</h2>
                            <div class="card shadow-sm border-0 rounded-3 m-2">
                                <div class="card-header bg-primary text-white text-center fw-bold">
                                    Resumo Financeiro
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-borderless align-middle mb-0 text-center">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Débito</th>
                                                <th scope="col">Renda</th>
                                                <th scope="col">Balanço</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-secondary">
                                                <td class="text-danger">R$ {{ str_replace('.',',',$resumo[0]->vl_debito) }}</td>
                                                <td class="text-success">R$ {{ str_replace('.',',',$resumo[0]->vl_superavit) }}</td>
                                                <td class="fw-semibold {{ substr_count($resumo[0]->balanco,'-') == 0 ? 'text-success' : 'text-danger'}}">
                                                    R$ {{ str_replace('.',',',$resumo[0]->balanco) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="input-group p-1">
                                <span class="input-group-text bg-secondary text-light">Perído indicado</span>
                                <input type="text"
                                    class="form-control text-center"
                                    value="{{ date('d/m/Y',strtotime($resumo[0]->dt_inicio))." até ".date('d/m/Y',strtotime($resumo[0]->dt_termino))}}"
                                    id="intervalo"
                                    readonly>
                            </div>
                            <div class="input-group p-1">
                                <span class="input-group-text bg-success text-light">Registros de renda: </span>
                                <input type="text"
                                    class="form-control text-center"
                                    value="{{ $qtRenda }}"
                                    readonly>
                            </div>
                            <div class="input-group p-1">
                                <span class="input-group-text bg-danger text-light">Registros de despesa: </span>
                                <input type="text"
                                    class="form-control text-center"
                                    value="{{ $qtDespesa }}"
                                    readonly>
                            </div>
                            <div class="mt-4">
                                <!--Registros mais recentes-->
                                <div class="card shadow-sm border-0 rounded-3 m-2 bg-primary">
                                    <h6 class="text-light text-center mt-2">Registros Recentes</h6>
                                    <table class="table table-primary table-bordeless align-middle mb-0 text-center">
                                        <thead class="table-light">
                                            <th>Nome</th>
                                            <th>Categoria</th>
                                            <th>Status</th>
                                            <th>Valor R$</th>
                                        </thead>
                                        <tbody>
                                            @foreach($registrosRecentes as $registro)
                                                <tr class="{{ $registro->cd_tipo_registro == 1 ? 'table-success' : 'table-danger'}}">
                                                    <td class="fw-bold">
                                                        <a href="{{ route('registro.show',["registro" => $registro]) }}" class="link-dark">
                                                            {{$registro->nm_registro}}
                                                        </a>
                                                    </td>
                                                    <td class="text-primary">
                                                        <x-helper.categoria :cdCategoria="$registro->cd_categoria"/>
                                                    </td>
                                                    <td class="fs-6">
                                                        <span class="badge text-bg-dark">
                                                            {{ $registro->ic_pago == 1 ? 'PAGO' : 'NÃO PAGO' }}
                                                        </span>
                                                    </td>
                                                    <td>R${{ str_replace('.',',',$registro->vl_valor) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <input type="number" value="{{$resumo[0]->vl_superavit}}" id="renda" hidden>
                            <input type="number" value="{{$resumo[0]->vl_debito}}" id="despesa" hidden>
                            <input type="number" value="{{$resumo[0]->vl_juros_superavit}}" id="jurosRenda" hidden>
                            <input type="number" value="{{$resumo[0]->vl_juros_debito}}" id="jurosDespesa" hidden>
                            <input type="number" value="{{Auth::user()->cd_usuario}}" id="assinatura" hidden>

                            <h2 class="text-primary text-center">Balanço Monetário</h2>
                            <!--Gráfico-->
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <x-helper.nothing
                    icon="bi-question-circle"
                    title="Nenhum registro cadastrado"
                    text="Cadastre seus registro e os consulte nessa página sempre que necessário"
                    route="{{route('registro.create')}}"
                    label="Criar registro"
                    labelIcon="bi bi-journal-plus"
                />
            @endif
        </section>
    @endauth
</x-layout>
