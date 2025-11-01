<div class="navbar-nav me-auto">
    <x-nav.nav-link
        :active="request()->is('/') ? true : false"
        :type="request()->is('/') ? 'btn' : 'a'"
        href="{{ route('home') }}"
    >
        Início
    </x-nav.nav-link>
    <x-nav.nav-link href="#funcionalidades">Funcionalidades</x-nav.nav-link>
    <x-nav.nav-link href="#planos">Planos</x-nav.nav-link>
    <x-nav.nav-link href="#duvidas">Dúvidas</x-nav.nav-link>
</div>

    <a class="nav-link me-2 nav-custom" href="/login/create">
        <strong>Login</strong>
    </a>
    <a class="btn btn-md btn-success shadow-sm btn-cta" href="/register/create">
        <b>Comece já</b>
    </a>
