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
    <x-nav.nav-link href="#">Relatórios</x-nav-link>
</div>
<div class="dropdown-center">
    <button class="btn btn-outline-success rounded rounded-2 dropdown-toggle h-75" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside">
        <i class="bi bi-person-fill fs-3"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end bg-light" style="min-width: 400px;">
        <form class="px-4 py-3" action="/login" method="POST">
            @csrf
            @method('DELETE')
            <div class="row g-2 mb-3">
                <div class="col-12 col-md-2">
                    <label class="form-label fw-bold mb-1">Nome: </label>
                </div>
                <div class="col-12 col-md-9">
                    <p class="mb-0 text-break">{{ Auth::user()->nm_usuario }}</p>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label fw-bold mb-1">Assinatura: </label>
                </div>
                <div class="col-12 col-md-9 fw-bold"
                    style="color:
                        @switch(Auth::user()->cd_assinatura)
                            @case(1)
                                #8B4513
                            @break
                            @case(2)
                                #A9A9A9
                            @break
                            @case(3)
                                #B8860B
                            @break
                        @endswitch
                    ">
                    <p class="ms-2 mb-0 text-break">
                        {{ "\t".Auth::user()->assinatura()->first()->nm_assinatura }}
                        <i class="bi bi-award fw-bold"></i>
                    </p>
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label fw-bold mb-1">Email:</label>
                </div>
                <div class="col-12 col-md-9">
                    <p class="mb-0 text-break">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <hr>
            <div class="d-grid">
                <button class="btn btn-outline-danger" type="submit">
                    Logout
                </button>
            </div>
        </form>
    </ul>
</div>
