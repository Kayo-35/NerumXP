<x-layout>
    <x-registro.form
        :titulo="'Edição de registro'"
        :rotaProcessamento="'registro.put'"
        :modalidades=$modalidades
        :juros=$juros
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
    @push('scriptsAuth')
        <script src="{{ asset("js/registro/edit.js") }}"></script>
    @endpush
</x-layout>
