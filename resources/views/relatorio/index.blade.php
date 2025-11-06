<x-layout>
    <h1 class='text-center'>Relatórios</h1>
    <div class="row justify-content-around m-5">
        <div class="col-md-5 col-sm-12 border rounded rounded-5">
            <canvas id="despesaPorCategoria"></canvas>
        </div>
        <div class="col-md-5 col-sm-12 border rounded rounded-5">
            <canvas id="ganhoPorCategoria"></canvas>
        </div>
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
