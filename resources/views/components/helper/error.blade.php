@props([ "campo" ])
@error($campo)
    <div class="alert alert-danger m-1 h-50 d-flex align-items-center" {{ $attributes }}>
        <i class="bi bi-exclamation-triangle">
            <span class="text-danger fs-6 m-1 fw-bold">
                {{ $message }}
            </span>
        </i>
    </div>
@enderror
