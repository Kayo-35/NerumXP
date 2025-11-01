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
</x-layout>
