<x-layout>
  
  @if($resumo[0]->vl_debito !== null && $resumo[0]->vl_superavit !== null)
    <div class="container">
      <div class="row g-4">
        <!-- Saudação -->
        <div class="col-12 text-lg-start text-center mb-4">
          <h1 class="fw-bold">{{ saudacao() }}{{ Auth::user()->nm_usuario }}{{ emojiSaudacao() }}</h1>
        </div>

        <!-- Coluna Esquerda -->
        <div class="col-12 col-lg-7">
          <!-- Estatísticas Base -->
          <div class="card shadow-sm border-0 rounded-4 p-3 mb-4">
            <h2 class="text-start mb-3 fw-bold">Estatísticas Base</h2>

            <!-- Cards de Resumo Financeiro -->
            <div class="row g-3 text-center mb-1">
              <!-- Débito -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card rounded-4 bg-gray-light">
                  <div class="card-body text-start">
                    <h6 class="text-muted">Débito</h6>
                    <p class="fs-5 fw-bold text-danger">R${{ str_replace('.', ',',$resumo[0]->vl_debito) }}</p>
                  </div>
                </div>
              </div>

              <!-- Renda -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card rounded-4 bg-gray-light">
                  <div class="card-body text-start">
                    <h6 class="text-muted">Renda</h6>
                    <p class="fs-5 fw-bold text-success">R${{ str_replace('.', ',',$resumo[0]->vl_superavit) }}</p>
                  </div>
                </div>
              </div>

              <!-- Balanço -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="card rounded-4 bg-gray-light">
                  <div class="card-body text-start">
                    <h6 class="text-muted">Balanço</h6>
                    <p class="fs-5 fw-bold">R${{ str_replace('.', ',',$resumo[0]->balanco) }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Informações adicionais -->
            <div class="list-group mb-2">
              <input
                id="intervalo"
                readonly
                class="bg-transparent border-0"
              />
              <div
                class="list-group-item d-flex justify-content-between align-items-center rounded-3 mb-2 bg-gray-light"
              >
                <span>Registros de renda</span>
                <span class="badge bg-success">{{ $qtRenda }}</span>
              </div>
              <div
                class="list-group-item d-flex justify-content-between align-items-center rounded-3 bg-gray-light"
              >
                <span>Registros de despesa</span>
                <span class="badge bg-danger">{{ $qtDespesa }}</span>
              </div>
            </div>
          </div>

          <!-- Registros Recentes -->
          <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header fw-bold bg-white border-0 rounded-4">
              <h2>Registros Recentes</h2>
              <p class="text-muted small mb-0">Últimos lançamentos</p>
            </div>

            <div class="card-body table-responsive">
              <!-- Cabeçalho -->
              <div
                class="row fw-semibold text-muted mb-2 text-center d-none d-md-flex"
              >
                <div class="col-4">Nome</div>
                <div class="col-3">Categoria</div>
                <div class="col-2">Status</div>
                <div class="col-3">Valor</div>
              </div>

              <!-- Registros -->
              <div class="registros">
                @foreach ($registrosRecentes as $registro)
                  <div
                    class="registro-item row align-items-center py-2 border-bottom text-center"
                  >
                    <div class="col-12 col-md-4 fw-semibold text-primary">
                      <a href="{{ route('registro.show',["registro" => $registro]) }}" class="text-decoration-none">
                      {{ $registro->nm_registro }}
                      </a>
                    </div>
                    <div class="col-12 col-md-3">
                      <x-helper.categoria :cdCategoria="$registro->cd_categoria"/>
                    </div>
                    <div class="col-12 col-md-2">
                      <span class="badge {{ $registro->cd_tipo_registro == 1 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'}}"
                        >{{ $registro->ic_pago == 1 ? 'PAGO' : 'NÃO PAGO' }}</span
                      >
                    </div>
                    <div class="col-12 col-md-3 {{ $registro->cd_tipo_registro == 1 ? 'text-success' : 'text-danger'}} fw-semibold">
                      R${{ str_replace('.',',',$registro->vl_valor) }}
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        <!-- Coluna Direita -->
        <div class="col-12 col-lg-5">
          <input type="number" value="{{$resumo[0]->vl_superavit}}" id="renda" hidden />
          <input type="number" value="{{$resumo[0]->vl_debito}}" id="despesa" hidden />
          <input type="number" value="{{$resumo[0]->vl_juros_superavit}}" id="jurosRenda" hidden />
          <input type="number" value="{{$resumo[0]->vl_juros_debito}}" id="jurosDespesa" hidden />
          <input type="number" value="{{Auth::user()->cd_usuario}}" id="assinatura" hidden />

          <!-- Balanço Monetário -->
          <div class="card shadow-sm border-0 p-3 rounded-5">
            <h2 class="text-start mb-4">Balanço Monetário</h2>
            <canvas
              id="myChart"
              class="w-100"
              style="max-height: 300px"
            ></canvas>
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

</x-layout>
