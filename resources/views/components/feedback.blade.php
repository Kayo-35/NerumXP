@if(session('criar_registro') !== null)
    <x-helper.notification
        titulo="Registro Criado"
        descricao="Acesse seu registro pelo botão ao lado!"
        rota="{{ route('registro.show', ['registro' => session('criar_registro')]) }}"
        cor="success"
    ></x-helper.notification>
@endif

@if(session('atualizar_registro') !== null)
    <x-helper.notification
        titulo="Registro Atualizado"
        descricao="Acesse sua nova versão pelo botão ao lado!"
        rota="{{ route('registro.show', ['registro' => session('atualizar_registro')]) }}"
        cor="warning"
    ></x-helper.notification>
@endif

@if(session('remover_registro') !== null)
    <x-helper.notification
        titulo="Registro Removido"
        descricao="Registro removido com sucesso!"
        cor="danger"
    ></x-helper.notification>
@endif

@if(session('criar_meta') !== null)
    <x-helper.notification
        titulo="Meta Criada"
        descricao="Acesssa a mesma pelo botão ao lado!"
        rota="{{ route('meta.show',['meta' => session('criar_meta')]) }}"
        cor="success"
    ></x-helper.notification>
@endif

@if(session('atualizar_meta') !== null)
    <x-helper.notification
        titulo="Meta Atualizada"
        descricao="Acesssa sua nova versão pelo botão ao lado!"
        rota="{{ route('meta.show',['meta' => session('atualizar_meta') ]) }}"
        cor="warning"
    ></x-helper.notification>
@endif

@if(session('remover_meta') !== null)
    <x-helper.notification
        titulo="Meta Removida"
        descricao="Meta removida com sucesso!"
        cor="danger"
    ></x-helper.notification>
@endif
