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
            @guest
                @include('components.nav.guestBar')
            @endguest
            @auth
                @include('components.nav.authBar')
            @endauth
        </div>
    </div>
</nav>
