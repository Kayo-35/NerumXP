<x-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                <div class="mb-4">
                    <h3 class="text-dark mb-4">
                        <i class="bi bi-target me-2"></i>
                        Tipos de Metas
                    </h3>

                    <a href="#" class="goal-creation-btn revenue">
                        <div class="goal-creation-icon">
                            <i class="bi bi-arrow-up-circle"></i>
                        </div>
                        <h5 class="mb-2 text-dark fw-bold">Metas de Receita</h5>
                        <p class="mb-0 text-muted">Defina objetivos para aumentar suas receitas e acompanhe seu progresso financeiro</p>
                    </a>

                    <a href="#" class="goal-creation-btn expense">
                        <div class="goal-creation-icon">
                            <i class="bi bi-arrow-down-circle"></i>
                        </div>
                        <h5 class="mb-2 text-dark fw-bold">Metas de Gastos</h5>
                        <p class="mb-0 text-muted">Controle seus gastos e estabeleça limites para diferentes categorias</p>
                    </a>

                    <a href="#" class="goal-creation-btn generic">
                        <div class="goal-creation-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h5 class="mb-2 text-dark fw-bold">Metas Genéricas</h5>
                        <p class="mb-0 text-muted">Objetivos personalizados para suas necessidades específicas</p>
                    </a>
                </div>

                <div class="dashboard-section p-4">
                    <h4 class="mb-4">
                        <i class="bi bi-pie-chart me-2"></i>
                        Dashboard de Metas
                    </h4>

                    <div class="row g-2">
                        <div class="col-4">
                            <div class="chart-card">
                                <h6 class="mb-2 text-center" style="font-size: 0.8rem;">
                                    <i class="bi bi-arrow-up-circle me-1"></i>
                                    Receita
                                </h6>
                                <div class="small-chart">
                                    <canvas id="revenueChart"></canvas>
                        <div class="col-6">
                            <div class="chart-card d-flex flex-column align-items-center justify-content-center">
                                <h6 class="mb-2 text-center" style="font-size: 0.8rem;">
                                    <i class="bi bi-arrow-up-circle me-1"></i>
                                    % Finalizadas
                                </h6>
                                <div class="small-chart">
                                    <canvas id="finalizadas"></canvas>
                                </div>
                                <div class="text-center mt-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="chart-card">
                                <h6 class="mb-2 text-center" style="font-size: 0.8rem;">
                                    <i class="bi bi-arrow-down-circle me-1"></i>
                                    Gastos
                                </h6>
                                <div class="small-chart">
                                    <canvas id="expenseChart"></canvas>
                                </div>
                                <div class="text-center mt-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="chart-card">
                                <h6 class="mb-2 text-center" style="font-size: 0.8rem;">
                                    <i class="bi bi-bullseye me-1"></i>
                                    Genéricas
                                </h6>
                                <div class="small-chart">
                                    <canvas id="genericChart"></canvas>
                        <div class="col-6">
                            <div class="chart-card d-flex flex-column align-items-center justify-content-center">
                                <h6 class="mb-2 text-center" style="font-size: 0.8rem;">
                                    <i class="bi bi-arrow-up-circle me-1"></i>
                                    Renda/Despesa
                                </h6>
                                <div class="small-chart">
                                    <canvas id="comparar"></canvas>
                                </div>
                                <div class="text-center mt-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <h3 class="text-dark mb-4">
                    <i class="bi bi-list-check me-2"></i>
                    Suas Metas
                </h3>

                <div class="goals-list">
                    <div class="accordion" id="goalsAccordion">
                        <!-- Goal 1 - Revenue -->
                        @foreach($metas as $key => $meta)
                            <x-meta.list id='{{ "goal$key" }}' :meta=$meta></x-meta.list>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const qt_metas_despesa = {{ $panorama->qt_metas_despesa }};
        const qt_metas_renda = {{$panorama->qt_metas_renda }};
        const pc_metas_finalizadas = {{$panorama->pc_metas_finalizadas }};
        const pc_metas_nao_finalizadas = {{ $panorama->pc_metas_nao_finalizadas}};
    </script>
</x-layout>
