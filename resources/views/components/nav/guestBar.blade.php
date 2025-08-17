<div class="navbar-nav me-auto mb-2 mb-lg-0">
    <x-nav.nav-link
        :active="request()->is('/') ? true : false"
        :type="request()->is('/') ? 'btn' : 'a'"
        href="{{ route('home') }}"
    >
        Início
    </x-nav.nav-link>
    <x-nav.nav-link href="#">Funcionalidades</x-nav.nav-link>
    <x-nav.nav-link href="#">Planos</x-nav.nav-link>
    <x-nav.nav-link href="#">Dúvidas</x-nav.nav-link>
</div>
<div class="navbar-nav ms-auto mb-2 mb-lg-0">
    <a class="btn btn-outline-secondary mb-2 me-md-2 mb-md-0" href="/register/create">
        Registre-se
    </a>
    <a class="btn btn-outline-success" href="/login/create">
        Login
    </a>
</div>
