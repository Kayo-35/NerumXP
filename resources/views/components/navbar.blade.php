<nav
    class="navbar navbar-expand-lg bg-body-tertiary py-3 px-2"
>
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img
                src="{{ asset('img/logo_projeto.png')}}"
                style="width: 5rem; margin-right: 0.5rem"
            />
            NerumXP
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav me-auto mb-2 mb-lg-0">
                <x-nav-link
                    :active="request()->is('/') ? true : false"
                    :type="request()->is('/') ? 'btn' : 'a'" href="/"
                >
                    Início
                </x-nav-link>
                <x-nav-link class="nav-link" href="#">Funcionalidades</x-nav-link>
                <x-nav-link class="nav-link" href="#">Planos</x-nav-link>
                <x-nav-link class="nav-link" href="#">Dúvidas</x-nav-link>
            </div>
            <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                <button type="button" class="btn btn-outline-secondary mb-2 me-md-2 mb-md-0">
                    Registre-se
                </button>
                <button type="button" class="btn btn-outline-primary">
                    Login
                </button>
            </div>
        </div>
    </div>
</nav>
