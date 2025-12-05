<x-layout>
    <main>
        <!-- ================= HERO ================= -->
        <header class="text-center py-5 hero-section">
            <div class="container">
                <div class="row align-items-center">

                    <!-- Texto principal -->
                    <div class="col-md-6 text-md-start p-1">
                        <h1 class="display-5 mb-3 hero-title">Organize sua vida financeira com facilidade.</h1>
                        <p class="lead my-4 hero-text">
                            Controle seus ganhos, acompanhe seus gastos e descubra onde seu dinheiro está indo — tudo em
                            um só lugar.
                        </p>
                        <a href="#planos" class="btn btn-lg btn-success shadow-sm btn-cta">Comece já</a>
                    </div>

                    <!-- Imagem ilustrativa -->
                    <div class="col-md-6 p-3">
                        <img src="{{ asset('img/ilustrativa1.png') }}" class="img-fluid"
                            alt="Ilustração de pessoa organizando finanças">
                    </div>
                </div>
        </header>

        <!-- ================= FUNCIONALIDADES ================= -->
        <section id="funcionalidades" class="py-5 section-gradient">
            <!-- Título da seção -->
            <div class="text-center mb-5">
                <h2 class="section-title">Funcionalidades</h2>
            </div>
            <div class="container">

                <!-- Cards -->
                <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">
                    <!-- Card 1 -->
                    <div class="col mx-3">
                        <div class="card h-100 shadow-sm card-custom">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-cash-coin fs-3 me-2 icon-success"></i>
                                    <h5 class="mb-0 card-title-custom">Controle de ganhos e despesas</h5>
                                </div>
                                <p class="mb-0 card-text-custom">Acompanhe entradas e saídas com categorias
                                    personalizadas.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col mx-3">
                        <div class="card h-100 shadow-sm card-custom">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-bar-chart-fill fs-3 me-2 icon-success"></i>
                                    <h5 class="mb-0 card-title-custom">Relatórios visuais</h5>
                                </div>
                                <p class="mb-0 card-text-custom">Visualize relatórios claros para entender melhor suas
                                    finanças.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col mx-3">
                        <div class="card h-100 shadow-sm card-custom">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-bell-fill fs-3 me-2 icon-success"></i>
                                    <h5 class="mb-0 card-title-custom">Lembretes e metas</h5>
                                </div>
                                <p class="mb-0 card-text-custom">Defina objetivos e receba notificações para manter a
                                    disciplina.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ================= PLANOS ================= -->
        <section id="planos" class="py-5 section-light">
            <div class="container">

                <!-- Título da seção -->
                <div class="text-center mb-5">
                    <h2 class="section-title">Planos</h2>
                </div>

                <div class="row g-4">
                    <!-- Plano Bronze (Grátis) -->
                    <div class="col-lg-4">
                        <div class="card text-center h-100 card-custom">
                            <div class="card-header card-header-success">
                                <h3 class="h4 mb-0 card-title-custom text-white">Bronze</h3>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="card-subtitle">Benefícios essenciais para começar a organizar suas finanças:
                                </p>
                                <ul class="list-unstyled text-start ms-3 card-text-custom">
                                    <br>
                                    <li>30 registros mensais</li>
                                    <li>Relatórios básicos</li>
                                </ul>
                                <br>
                                <a href="#" class="btn btn-success shadow-sm mt-auto btn-cta">ASSINE AGORA</a>
                            </div>
                        </div>
                    </div>

                    <!-- Plano Prata -->
                    <div class="col-lg-4">
                        <div class="card text-center h-100 shadow-sm card-custom">
                            <div class="card-header card-header-success">
                                <h3 class="h4 mb-0 card-title-custom text-white">Prata</h3>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="card-subtitle">Ferramentas avançadas para um controle completo:</p>
                                <ul class="list-unstyled text-start ms-3 card-text-custom">
                                    <br>
                                    <li>80 registros mensais</li>
                                    <li>Relatórios com filtragem</li>
                                    <li>10 metas</li>
                                </ul>
                                <a href="#" class="btn btn-success shadow-sm mt-auto btn-cta">ASSINE AGORA</a>
                            </div>
                        </div>
                    </div>

                    <!-- Plano Ouro -->
                    <div class="col-lg-4">
                        <div class="card text-center h-100 card-custom">
                            <div class="card-header card-header-success">
                                <h3 class="h4 mb-0 card-title-custom text-white">Ouro</h3>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="card-subtitle">Todos os recursos e suporte prioritário:</p>
                                <ul class="list-unstyled text-start ms-3 card-text-custom">
                                    <br>
                                    <li>120 registros mensais</li>
                                    <li>Relatórios com filtragem avançada</li>
                                    <li>20 metas</li>
                                </ul>
                                <br>
                                <a href="#" class="btn btn-success shadow-sm mt-auto btn-cta">ASSINE AGORA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= FAQ ================= -->
        <section id="duvidas" class="py-5 section-gradient">
            <div class="container">

                <!-- Título da seção -->
                <div class="text-center mb-5">
                    <h2 class="section-title">Dúvidas Frequentes</h2>
                </div>

                <div class="accordion" id="accordionDuvidas">

                    <!-- Pergunta 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne">
                                <strong class="accordion-question">O NerumXP é gratuito?</strong>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionDuvidas">
                            <div class="accordion-body accordion-text">
                                Sim! Você pode usar o plano gratuito sem tempo limite, com acesso às funcionalidades
                                essenciais.
                            </div>
                        </div>
                    </div>

                    <!-- Pergunta 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo">
                                <strong class="accordion-question">Meus dados estão seguros?</strong>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionDuvidas">
                            <div class="accordion-body accordion-text">
                                Claro. Usamos criptografia de ponta e práticas seguras de armazenamento para proteger
                                seus dados.
                            </div>
                        </div>
                    </div>

                    <!-- Pergunta 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree">
                                <strong class="accordion-question">Posso trocar de plano depois?</strong>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionDuvidas">
                            <div class="accordion-body accordion-text">
                                Sim. Você pode mudar de plano ou cancelar sua assinatura a qualquer momento, sem
                                burocracia.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layout>
