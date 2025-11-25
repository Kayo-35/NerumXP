<x-layout>
    @if($tipo === 0)
        <x-meta.form
            titulo="Criar Nova Meta"
            :route=`meta.store`
            :importancias=$importancias
            :tiposMeta=$tiposMeta
            :registros=$registros
            :categorias=$categorias
            :modalidades=$modalidades
        />
    @else
        <x-meta.formGenerica
            titulo="Criar Nova Meta"
            :route=`meta.store`
            :importancias=$importancias
        />
    @endif
    @push('scriptsAuth')
        @if(request()->query->all()['tipo'][0] != 7)
            <script src="{{ asset("js/metas/create.js") }}"></script>
        @else
            <script src="{{ asset("js/metas/createGenerica.js") }}"></script>
        @endif
    @endpush
</x-layout>
