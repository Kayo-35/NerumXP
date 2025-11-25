<nav
    id="siteNavbar" 
    class="navbar navbar-expand-lg border-bottom shadow-sm navbar-gradient"
>
    <div class="container">

        <a class="navbar-brand d-flex align-items-center navbar-brand-custom" href="#">
            <img
                src="{{ asset('img/logo_projeto_fundo_branco.png')}}"
                width="50"
                class="me-2"
            />
            <span class="fw-semibold text-white">NerumXP</span>
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Abrir menu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            @guest
                @include('components.nav.guestBar')
            @endguest
        </div>
    </div>
</nav>
