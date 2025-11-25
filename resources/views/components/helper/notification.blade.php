@props([
    'titulo',
    'descricao',
    'cor',
    'rota' => null
])
<div class="position-fixed top-0 end-0 m-4 mb-5" style="z-index: 1050; min-width: 320px;">
    <div class="border-start border-{{ $cor }} border-5 py-3 px-3 rounded-end shadow-lg">
        <h5>Central do usuário</h5>
        <div class="d-flex align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-circle bg-{{ $cor }} text-white">✓</div>
                <div class="notification-content">
                    <div class="notification-title text-{{ $cor }}">
                        {{ $titulo }}
                    </div>
                    <div class="notification-message">
                        {{ $descricao }}
                    </div>
                </div>
            </div>
            @isset($rota)
                <a href="{{ $rota }}" class="btn btn-sm btn-outline-{{ $cor }}">
                    Ver
                </a>
            @endisset
        </div>
    </div>
</div>

