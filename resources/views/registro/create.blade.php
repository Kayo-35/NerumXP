<x-layout>
    <x-registro.form
        :titulo="'Criar Registro'"
        :rotaProcessamento=`registro.store`
        :tipos=$tipos
        :modalidades=$modalidades
        :juros=$juros
        :metodos=$metodos
        :formas=$formas
        :importancias=$importancias
        :categorias=$categorias
        :localizacaos=$localizacaos
        :realizadores=$realizadores
    />
    @push('scriptsAuth')
        <script src="{{ asset("js/registro/create.js") }}"></script>
    @endpush
</x-layout>
