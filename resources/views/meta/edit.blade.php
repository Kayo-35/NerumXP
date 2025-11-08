<x-layout>
    @if($tipo === 0)
        <x-meta.form
            titulo="Editar Meta Existente"
            route=meta.put
            :meta=$meta
            :registrosDaMeta=$registrosDaMeta
            :importancias=$importancias
            :tiposMeta=$tiposMeta
            :registros=$registros
            :categorias=$categorias
            :modalidades=$modalidades
        />
    @else
        <x-meta.formGenerica
            titulo="Editar Meta"
            route="meta.put"
            :importancias=$importancias
            :objetivos=$objetivos
            :meta=$meta
        />
    @endif
</x-layout>
