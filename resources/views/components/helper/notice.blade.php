@props([
    'titulo','desc'
])
<div class="mt-1 p-3 bg-secondary bg-opacity-10 rounded fs-6 w-100">
    <div class="d-flex align-items-center">
        <i class="bi bi-info-circle text-dark me-2"></i>
        <small class="text-dark fw-bold">{{ $titulo }}</small>
    </div>
    <small class="text-secondary d-block mt-1">
        {{ $desc }}
    </small>
</div>
