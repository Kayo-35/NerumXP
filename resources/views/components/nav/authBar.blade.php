<div class="navbar-nav me-auto mb-2 mb-lg-0">
    <x-nav.nav-link
        :active="request()->is('/') ? true : false"
        :type="request()->is('/') ? 'btn' : 'a'" href="/"
    >
        Início
    </x-nav-link>
    <x-nav.nav-link
        :active="request()->is('registro*') ? true : false"
        :type="request()->is('registro*') ? 'btn' : 'a'"
        href='{{ route("registro.index") }}'
    >
        Registros
    </x-nav-link>
    <x-nav.nav-link href="#"
        :active="request()->is('metas*') ? true : false"
        :type="request()->is('metas*') ? 'btn' : 'a'"
    >
        Metas
    </x-nav-link>
    <x-nav.nav-link href="#">Relatórios</x-nav-link>
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
