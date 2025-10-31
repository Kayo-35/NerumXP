<li class="nav-item account-panel-item">
    <!-- Botão/Link para expandir/colapsar -->
    <a class="nav-link text-white d-flex align-items-center mb-2 shadow-sm"
        data-bs-toggle="collapse"
        href="#accountInfoCollapse"
        role="button"
        aria-expanded="false"
        aria-controls="accountInfoCollapse">
        
        <!-- Ícone e Nome do Usuário -->
        <i class="bi bi-person-circle fs-3 me-2"></i>
        <span class="menu-text fw-bold">{{ Auth::user()->nm_usuario }}</span>
        
        <!-- Ícone de seta para indicar colapsível -->
        <i class="bi bi-chevron-down ms-auto collapse-icon"></i>
    </a>

    <!-- Conteúdo colapsável -->
    <div class="collapse" id="accountInfoCollapse">
        <div class="account-info-content p-2">
            <!-- Informações da Conta -->
            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Email</div>
                    <p class="info-value">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-star"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Plano</div>
                    <p class="info-value">Assinatura {{ Auth::user()->assinatura->nm_assinatura }}</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <i class="bi bi-award"></i>
                </div>
                <div class="info-content">
                    <div class="info-label">Assinatura</div>
                    <p class="info-value">{{ Auth::user()->assinatura->nm_assinatura }}</p>
                </div>
            </div>
            
            <!-- Botão de Logout -->
            <form action="/login" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-light w-100" type="submit">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Sair da Conta
                </button>
            </form>
        </div>
    </div>
</li>