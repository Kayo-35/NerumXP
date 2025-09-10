<x-layout>
<section class="d-flex justify-content-center">
    @if($resumo[0]->vl_debito !== null && $resumo[0]->vl_superavit !== null)
    <div class="container bg-light row m-3 border rounded rounded-5 p-3">
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
</x-layout>
