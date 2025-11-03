<!-- ===== Navbar no mobile (visível apenas em telas pequenas) ===== -->
<nav class="navbar navbar-expand-lg d-lg-none navbar-dark shadow-sm gradient-bg">
    <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home')}}">
        <img
        src="img/logo_projeto_fundo_branco.png"
        alt="Logo NerumXP"
        width="30"
        />
        <span class="brand-text">NerumXP</span>
    </a>

    <!-- Botão hamburguer -->
    <button
        class="navbar-toggler border-0"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mobileMenu"
        aria-controls="mobileMenu"
        aria-expanded="false"
        aria-label="Abrir menu"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu colapsado no mobile -->
    <div class="collapse navbar-collapse mt-2" id="mobileMenu">
        <div class="navbar-nav ms-auto">
        @include('components.nav.accountPanel')
        <a href="{{ route('home')}}" class="nav-link d-flex text-white align-items-center">
            <i class="bi bi-cup-hot-fill me-2 icon-menu"></i> Resumo
        </a>
        <a href="{{ route('registro.index')}}" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-receipt me-2 icon-menu"></i> Registros
        </a>
        <a href="#" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-clipboard-data-fill me-2 icon-menu"></i> Relatórios
        </a>
        <a href="{{ route('meta.index')}}" class="nav-link text-white d-flex align-items-center">
            <i class="bi bi-award-fill me-2 icon-menu"></i> Metas
        </a>
        </div>
    </div>
    </div>
</nav>

<!-- ===== Sidebar (visível apenas em telas grandes) ===== -->
<div
    class="offcanvas-lg offcanvas-start text-white sidebar vh-100 shadow-lg d-none d-lg-block gradient-bg"
>
    <div class="offcanvas-body d-flex flex-column p-3">
    <!-- Logo + título no desktop -->
    <div class="d-flex align-items-center mb-4 logo-desktop">
        <img
        src="img/logo_projeto_fundo_branco.png"
        alt="Logo NerumXP"
        width="30"
        class="me-2"
        />
        <span class="fs-4 fw-bold brand-text">NerumXP</span>
    </div>

    <!-- Menu de navegação -->
    <div class="nav nav-pills flex-column mb-auto">
        @include('components.nav.accountPanel')
        <a href="{{ route('home')}}" class="nav-link text-white d-flex align-items-center mb-2 shadow-sm">
            <i class="bi bi-cup-hot-fill fs-3 me-2"></i>
            <span class="menu-text">Resumo</span>
        </a>
        <a href="{{ route('registro.index')}}" class="nav-link text-white d-flex align-items-center mb-2 shadow-sm">
            <i class="bi bi-receipt fs-3 me-2"></i>
            <span class="menu-text">Registros</span>
        </a>
        <a href="#" class="nav-link text-white d-flex align-items-center mb-2 shadow-sm">
            <i class="bi bi-clipboard-data-fill fs-3 me-2"></i>
            <span class="menu-text">Relatórios</span>
        </a>
        <a href="{{ route('meta.index')}}" class="nav-link text-white d-flex align-items-center mb-2 shadow-sm">
            <i class="bi bi-award-fill fs-3 me-2"></i>
            <span class="menu-text">Metas</span>
        </a>
    </div>
    </div>
</div>