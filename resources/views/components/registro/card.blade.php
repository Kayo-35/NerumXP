<div
    {{ $attributes->merge(
        ['class' => 'container mt-4 mb-4'])
    }}
>
    <div class="d-flex g-4 align-items-stretch">
        <div class="col h-100">
            <div class="card h-100 position-relative overflow-hidden rounded-4 shadow text-white mx-auto
                {{ $type == 1 ? 'bg-success' : 'bg-danger' }}"
            >
                <div class="position-absolute top-0 end-0 p-2">
                    <div class="d-flex align-items-center">
                        @if($pago == 1)
                            <span class="badge bg-dark me-2">PAGO</span>
                        @endif

                        <i class="bi {{ $iconClass }} fs-4"></i>
                    </div>
                </div>
                <div class="card-body pb-5 d-flex flex-column justify-content-center text-center">
                    <div class="fw-bold fs-4 mb-1">{{ $title }}</div>
                    <div class="fs-4 fw-bold my-2">R$ {{ str_replace('.',',',$valor) }}</div>
                    <div class="small text-white">
                        <div>Criado em: {{ $dtCriado }}</div>
                        <div>Atualizado em: {{ $dtAtualizado }}</div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 p-2 d-flex align-items-center text-warning">
                    @for($i = 0;$i <= $stars;$i++)
                        <i class="bi bi-star-fill fs-6 me-1"></i>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
