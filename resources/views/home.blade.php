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
</x-layout>
