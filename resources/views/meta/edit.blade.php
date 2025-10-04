<x-layout>
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
</x-layout>
