@props([ "campo" ])
@error($campo)
    <div class="mb-1" {{ $attributes }}>
        <p class="text-danger fs-6 m-0 fst-italic">
            {{ $message }}
        </p>
    </div>
@enderror
