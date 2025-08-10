@props (
[
    "type" => "a",
    "active" => false,
]
)
<a class="nav-link
    {{ $type === "btn" ? 'btn btn-outline-success text-light' : '' }}
    {{ $active === true ? 'active' : '' }}"
    {{$attributes}}
>
    {{ $slot }}
</a>
