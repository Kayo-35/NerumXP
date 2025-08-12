<div class="navbar-nav me-auto mb-2 mb-lg-0">
    <x-nav-link
        :active="request()->is('/') ? true : false"
        :type="request()->is('/') ? 'btn' : 'a'" href="/"
    >
        Início
    </x-nav-link>
    <x-nav-link class="nav-link" href="{{ route("registroFixo.index")}}">Registros Fixos</x-nav-link>
    <x-nav-link class="nav-link" href="#">Registros Flutuantes</x-nav-link>
    <x-nav-link class="nav-link" href="#">Relatórios</x-nav-link>
    <x-nav-link class="nav-link" href="#">Simulações</x-nav-link>
</div>
