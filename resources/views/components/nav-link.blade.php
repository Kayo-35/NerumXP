@props (
[
    "type" => "a",
    "active" => false,
]
)
<a class="nav-link
    {{ $type === "btn" ? 'btn btn-success' : '' }}
    {{ $active === true ? 'active' : '' }}"
    {{$attributes}}
>
    {{ $slot }}
</a>
