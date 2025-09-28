<x-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-5 col-sm-12 mb-4">
                <div class="mb-4">
                    <h3 class="text-dark mb-4">
                        <i class="bi bi-target me-2"></i>
                        Tipos de Metas
                    </h3>
                    <a href="{{ route('meta.create',["tipo" => [1,2]]) }}" class="goal-creation-btn revenue">
                        <div class="goal-creation-icon">
                            <i class="bi bi-arrow-up-circle"></i>
                        </div>
                        <h5 class="mb-2 text-dark fw-bold">Metas de Receita</h5>
                        <p class="mb-0 text-muted">
                            Defina objetivos para aumentar suas receitas e
                            acompanhe seu progresso financeiro
                        </p>
                    </a>
                    <a href="{{ route('meta.create',["tipo" => [3,4,5,6]]) }}" class="goal-creation-btn expense">
                        <div class="goal-creation-icon">
                            <i class="bi bi-arrow-down-circle"></i>
                        </div>
                        <h5 class="mb-2 text-dark fw-bold">Metas de Gastos</h5>
                        <p class="mb-0 text-muted">
                            Controle seus gastos e estabeleça limites para
                            diferentes categorias
                        </p>
                    </a>
                    <a href="{{ route('meta.create',["tipo" => "generica"]) }}" class="goal-creation-btn generic">
                        <div class="goal-creation-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h5 class="mb-2 text-dark fw-bold">Metas Genéricas</h5>
                        <p class="mb-0 text-muted">
                            Objetivos personalizados para suas necessidades
                            específicas
                        </p>
                    </a>
                </div>
                <div class="dashboard-section p-4">
                    <h4 class="mb-4">
                        <i class="bi bi-pie-chart me-2"></i>
                        Dashboard de Metas
                    </h4>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div
                                class="chart-card d-flex flex-column align-items-center justify-content-center"
                            >
                                <h6
                                    class="mb-2 text-center"
                                    style="font-size: 0.8rem"
                                >
                                    <i class="bi bi-arrow-up-circle me-1"></i>
                                    Despesa/Renda
                                </h6>
                                <div
                                    class="small-chart d-flex justify-content-center h-100"
                                >
                                    <canvas id="comparar"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div
                                class="chart-card d-flex flex-column align-items-center justify-content-center"
                            >
                                <h6
                                    class="mb-2 text-center"
                                    style="font-size: 0.8rem"
                                >
                                    <i class="bi bi-arrow-up-circle me-1"></i>
                                    % Finalizadas
                                </h6>
                                <div
                                    class="small-chart d-flex justify-content-center h-100"
                                >
                                    <canvas id="finalizadas"></canvas>
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
                        @empty($metas)
                            <x-helper.nothing
                                icon="bi-question-circle"
                                title="Nenhuma meta encontrada"
                                text="Cadastre suas metas e as consulte nessa página sempre que necessário"
                                route="{{route('home')}}"
                                label="Home Page"
                            />
                        @else
                            @foreach ($metas as $key => $meta)
                                <x-meta.list
                                    id='{{ "goal$key" }}'
                                    :meta="$meta"
                                ></x-meta.list>
                            @endforeach
                            @if(method_exists($metas,'links'))
								<div>
									{{ $metas->links() }}
								</div>
                            @endif
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const qt_metas_despesa = {{ $panorama->qt_metas_despesa }};
        const qt_metas_renda = {{ $panorama->qt_metas_renda }};
        const pc_metas_finalizadas = {{ $panorama->pc_metas_finalizadas }};
        const pc_metas_nao_finalizadas =
            {{ $panorama->pc_metas_nao_finalizadas }};
    </script>
</x-layout>
