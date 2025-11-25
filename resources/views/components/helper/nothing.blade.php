@props([
    'title','text','route','label','icon','labelIcon',
    'marginTop' => 'mt-5'
])
<div class="container-fluid d-flex align-items-center justify-content-center {{ $marginTop }}">
    <div class="text-center">
        <div class="mb-4">
            <i class="bi {{ $icon }} text-muted" style="font-size: 4rem;"></i>
        </div>
        <h3 class="text-muted mb-3">{{ $title }}</h3>
        <p class="text-muted mb-4 lead">
            {{ $text }}
        </p>
        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
            <a class="btn btn-outline-primary" href="{{ $route }}">
                <i class="bi {{ $labelIcon }} me-2"></i>
                {{ $label }}
            </a>
        </div>
    </div>
</div>
