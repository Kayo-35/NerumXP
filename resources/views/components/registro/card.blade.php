<div
    {{ $attributes->merge(
        ['class' => 'container mt-4 mb-4'])
    }}
>
    <div class="d-flex g-4 align-items-stretch">
        <div class="col h-100">
            <div class="card bg-gradient h-100 position-relative overflow-hidden rounded-4 shadow-lg text-white mx-auto
                {{ $registro->cd_tipo_registro == 1 ? 'bg-success' : 'bg-danger' }}"
            >
                <div class="d-flex justify-content-between card-header bg-dark">
                    <div class="d-flex justify-content-start">
                        <div>
                            <form action="{{route("registro.destroy",[$registro])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm me-2">
                                    <i class="bi bi-trash fw-bold">
                                        <span class="mx-1">Excluir</span>
                                    </i>
                                </button>
                            </form>
                        </div>

                        <div>
                            <form action="{{route("registro.edit",[
                                    $registro
                                ])}}">
                                @csrf
                                <button class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-pencil">
                                        <span class="mx-1">Editar</span>
                                    </i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if($registro->cd_modalidade == 2)
                        <div>
                            <span class="badge bg-primary me-2">
                                <i class="bi bi-graph-up"> Flutuante</i>
                            </span>
                        </div>
                    @endif
                </div>
                <div class="pe-2 pt-2">
                    <div class="d-flex align-items-center justify-content-end">
                        @if($registro->ic_pago == 1)
                            <span class="badge bg-dark me-2">PAGO</span>
                        @endif

                        <x-helper.categoria :cdCategoria="$registro->cd_categoria"/>
                    </div>
                </div>
                <div class="card-body pb-2 d-flex flex-column justify-content-center text-center pt-0">
                    <div class="fw-bold fs-4 mb-1">{{ $registro->nm_registro }}</div>
                    <div class="fs-4 fw-bold my-2">R$ {{ str_replace('.',',',$registro->vl_valor) }}</div>
                    <div class="small text-white">
                        <div>
                            Criado em: {{ date('d-m-Y',strtotime($registro->created_at)) }} as
                            {{ date('H:m', strtotime($registro->created_at))}}
                        </div>
                    </div>
                </div>
                <div class="p-2 d-flex align-items-center text-warning">
                    @for($i = 0;$i < $registro->cd_nivel_imp;$i++)
                        <i class="bi bi-star-fill fs-6 me-1"></i>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
