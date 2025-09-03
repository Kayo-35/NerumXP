<i class="bi {{ $iconClass }} fs-4">
    @if(Str::is('registro/*',request()->path()))
        {{ $titulo }}
    @endif
</i>
