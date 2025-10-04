<div class="navbar-nav me-auto mb-2 mb-lg-0">
    <x-nav.nav-link
        :active="request()->is('home') ? true : false"
        :type="request()->is('home') ? 'btn' : 'a'" href="/home"
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
    @if(Auth::user()->cd_assinatura > 1)
		<x-nav.nav-link href="#"
			:active="request()->is('meta*') ? true : false"
			:type="request()->is('meta*') ? 'btn' : 'a'"
			href='{{ route("meta.index") }}'
		>
			Metas
		</x-nav-link>
    @endif
    <x-nav.nav-link href="{{ route('relatorio.index') }}">Relatórios</x-nav-link>
</div>
<x-nav.accountPanel></x-nav.accountPanel>
