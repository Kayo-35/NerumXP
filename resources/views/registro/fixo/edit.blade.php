<x-layout>
    <x-registro.form
        :titulo="'Edição de registro fixo'"
        :rotaProcessamento=`registroFixo.update`
        :registro=$registro
        :tipos=$tipos
        :metodos=$metodos
        :metodosProprios=$metodosProprios
        :formas=$formas
        :importancias=$importancias
        :categorias=$categorias
        :localizacaos=$localizacaos
        :realizadores=$realizadores
    />
</x-layout>
