<div
    {{
        $attributes->merge([
            "class" => "container mt-4 mb-4",
        ])
    }}
>
  <div class="d-flex g-4 align-items-stretch">
    <div class="col h-100 d-flex justify-content-center">
      <div class="dimensions card h-100 background shadow-sm p-4 position-relative overflow-hidden rounded-5 text-white {{ $registro->ic_status == 0 ? 'opacity-75' : ''}}" style="background: url('{{ $registro->cd_tipo_registro === 1 ? asset('img/registros/bgCartaoVerde.png') : asset('img/registros/bgCartaoVermelho.png') }}')">
        <!-- ===== Overlay com botões ===== -->
        <div class="card-overlay">
          <!-- Botão excluir -->
          <form action="{{ route("registro.destroy", [$registro]) }}" method="POST">
            @csrf
            @method("DELETE")
            <button class="btn btn-danger btn-sm">
              <i class="bi bi-trash"></i>
            </button>
          </form>
          <!-- Botão editar -->
          <form action="{{ route("registro.edit", [$registro]) }}">
            @csrf
            <button class="btn btn-success btn-sm">
              <i class="bi bi-pencil"></i>
            </button>
          </form>

          <!-- Botão visualizar -->
          <form action="{{ route("registro.show", [$registro]) }}">
            @csrf
            <button class="btn btn-primary btn-sm">
              <i class="bi bi-eye"></i>
            </button>
          </form>
        </div>
        <!-- ===== Corpo do card ===== -->
        <div class="card-body pb-3 d-flex flex-column pt-0">

          <!-- Título do card + ícone -->
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0" id="nm_registro">
              {{ $registro->nm_registro }}
            </h5>
            <x-helper.categoria :cdCategoria="$registro->cd_categoria"/>
          </div>

          <!-- Valor do item -->
          <p class="fs-2 fw-bold mb-0">
            R$ {{ str_replace(".", ",", $registro->vl_valor) }}
          </p>

          <!-- Badges empilhadas à direita -->
          <div class="d-flex flex-column align-items-end gap-1 mt-0">
            @if ($registro->ic_pago == 1)
              <span class="badge text-bg-dark">Pago</span>
            @endif
            @if ($registro->cd_modalidade == 2)
              <span class="badge text-bg-primary bi bi-bar-chart-line-fill">Flutuante</span>
            @endif
          </div>
        </div> <!-- Fim card-body -->

        <!-- ===== Avaliação com estrelas + data ===== -->
        <div class="d-flex align-items-center justify-content-between px-3 pb-0 pt-1" id="nivel_imp_created_at">
          <!-- Estrelas -->
          <div>
            @for ($i = 0;$i < $registro->cd_nivel_imp;$i++)
              <i class="bi bi-star-fill fs-6 me-1" style="margin-bottom:0;"></i>
            @endfor
          </div>

          <!-- Data -->
          <small class="text-end mb-0">{{ date("d/m", strtotime($registro->created_at)) }}</small>
        </div>

      </div> <!-- Fim card -->
    </div> <!-- Fim coluna card -->
  </div> <!-- Fim row -->
</div>