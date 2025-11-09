<x-layout>
    <h1 class='text-center'>Relatórios</h1>
    <div class="row justify-content-around m-5">
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
            <div class="col-md-5 col-sm-12 border rounded rounded-5">
                <canvas id="despesaPorCategoria"></canvas>
            </div>
        @endunless
        @unless(empty($rendaPorCategoria))
            <div class="col-md-5 col-sm-12 border rounded rounded-5">
                <canvas id="ganhoPorCategoria"></canvas>
            </div>
        @endunless
        <div class="col-12">
            <canvas id="rendaDespesa"></canvas>
        </div>
    </div>
    <script>
        const rendaPorCategoria = @json($rendaPorCategoria);
        const despesaPorCategoria = @json($despesaPorCategoria);
        const despesaPorMes = @json($despesaPorMes);
        const rendaPorMes = @json($rendaPorMes);
    </script>
</x-layout>
