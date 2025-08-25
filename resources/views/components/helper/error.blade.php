@props([ "campo", "nome" ])
@error($campo)
    <div class="alert alert-danger m-1 h-50" {{ $attributes }}>
        <i class="bi bi-exclamation-triangle">
            <span class="text-danger fs-6 m-1 fw-bold">
                {{ $message }}
            </span>
        </i>
    </div>
@enderror
