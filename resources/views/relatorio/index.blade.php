<x-layout>
    <h1 class='text-center'>Relatórios</h1>
     <div class="mx-5">
        <div class="py-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-success text-white p-3 rounded-top-3">
                    <h5 class="mb-0">📅 Buscar por Período</h5>
                </div>
                <div class="card-body p-4">
                    <form method="GET">
                        <div class="row align-items-end g-3">
                            <div class="col-md-5 col-sm-12">
                                <label for="dt_inicio" class="form-label fw-bold text-success">Data de Início</label>
                                <input type="date" class="form-control shadow-sm border-success" id="dt_inicio" name="dt_inicio" required>
                            </div>

                            <div class="col-md-5 col-sm-12">
                                <label for="dt_fim" class="form-label fw-bold text-success">Data de Fim</label>
                                <input type="date" class="form-control shadow-sm border-success" id="dt_fim" name="dt_fim" required>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <button type="submit" class="btn btn-success btn-lg w-100 mt-3 mt-md-0 rounded-3 shadow-sm">
                                    Buscar <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around mx-5 my-3">
        @if(empty($despesaPorCategoria) && empty($rendaPorCategoria))
            <x-helper.nothing
                title="Dados insuficientes"
                text="Registros insuficientes para geração de relatórios"
                route="{{ route('home') }}"
                label="Home Page"
                icon="bi-question-circle"
                labelIcon="bi-arrow-return-left"
            >
            </x-helper.nothing>
        @endif
        @unless(empty($despesaPorCategoria))
            <div class="col-md-5 col-sm-12">
                <div class="card shadow-lg border-0 rounded-5">
                    
                    <div class="card-header bg-danger text-white p-3 rounded-top-5">
                        <h5 class="mb-0">📉 Despesas por Categoria</h5>
                    </div>
                    
                    <div class="card-body p-4 border border-4 border-danger rounded-bottom-5">
                        <canvas id="despesaPorCategoria"></canvas>
                    </div>
                    
                </div>
            </div>
        @endunless
        @unless(empty($rendaPorCategoria))
            <div class="col-md-5 col-sm-12">
                <div class="card shadow-lg border-0 rounded-5">
                    
                    <div class="card-header bg-success text-white p-3 rounded-top-5">
                        <h5 class="mb-0">📈Ganhos por Categoria</h5>
                    </div>
                    
                    <div class="card-body p-4 border border-4 border-success rounded-bottom-5">
                        <canvas id="ganhoPorCategoria"></canvas>
                    </div>
                    
                </div>
            </div>
        @endunless
        <div class="col-12 mt-5">
            <div class="card shadow-lg border-0 rounded-4">
                
                <div class="card-header bg-white border-bottom p-3">
                    <h5 class="mb-0 text-dark opacity-75 fw-normal">📈 Visão Geral de Renda e Despesa</h5>
                </div>
                
                <div class="card-body p-4">
                    <canvas id="rendaDespesa"></canvas>
                </div>
                
            </div>
        </div>
    </div>
    <script>
        const rendaPorCategoria = @json($rendaPorCategoria);
        const despesaPorCategoria = @json($despesaPorCategoria);
        const despesaPorMes = @json($despesaPorMes);
        const rendaPorMes = @json($rendaPorMes);
    </script>
</x-layout>
