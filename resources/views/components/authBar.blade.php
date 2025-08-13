<div class="navbar-nav me-auto mb-2 mb-lg-0">
    <x-nav-link
        :active="request()->is('/') ? true : false"
        :type="request()->is('/') ? 'btn' : 'a'" href="/"
    >
        Início
    </x-nav-link>
    <x-nav-link
        :active="request()->is('registro/fixo') ? true : false"
        :type="request()->is('registro/fixo') ? 'btn' : 'a'"
        href='{{ route("registroFixo.index") }}'
    >
        Registros Fixos
    </x-nav-link>
    <x-nav-link href="#">Registros Flutuantes</x-nav-link>
    <x-nav-link href="#">Relatórios</x-nav-link>
    <x-nav-link href="#">Simulações</x-nav-link>
</div>
<div class="navbar-nav ms-auto mb-2 mb-lg-0">
    <form action="/login" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" type="submit">
            Logout
        </button>
    </form>
</div>
