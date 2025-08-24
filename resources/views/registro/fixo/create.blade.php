<x-layout>
    <x-registro.form
        :titulo="'Criar Registro Fixo'"
        :rotaProcessamento=`registroFixo.store`
        :tipos=$tipos
        :metodos=$metodos
        :formas=$formas
        :importancias=$importancias
        :categorias=$categorias
        :localizacaos=$localizacaos
        :realizadores=$realizadores
    />
</x-layout>
