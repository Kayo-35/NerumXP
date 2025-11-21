<!-- Botão/Link para expandir/colapsar -->
<a class="nav-link text-white d-flex align-items-center mb-2 shadow-sm account-panel-link"
    data-bs-toggle="collapse"
    href="#accountInfoCollapse"
    role="button"
    aria-expanded="false"
    aria-controls="accountInfoCollapse">
    
    <!-- Ícone e Nome do Usuário -->
    <i class="bi bi-house-fill fs-3 me-2"></i>
    <span class="menu-text fw-bold" title="Minha Conta">Minha Conta</span>
    
    <!-- Ícone de seta para indicar colapsível -->
    <i class="bi bi-chevron-down ms-auto collapse-icon"></i>
</a>

<!-- Conteúdo colapsável -->
<div class="collapse account-panel-collapse" id="accountInfoCollapse">
    <!-- Removida a classe 'p-2' para evitar conflito com o padding definido no CSS -->
    <div class="account-info-content">
        <!-- Informações da Conta -->
        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-envelope"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Email</div>
                <p class="info-value" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Nome</div>
                <p class="info-value" title="{{ Auth::user()->nm_usuario }}">{{ Auth::user()->nm_usuario }}</p>
            </div>
        </div>

        <div class="info-item">
            <div class="info-icon">
                <i class="bi bi-award"></i>
            </div>
            <div class="info-content">
                <div class="info-label">Assinatura</div>
                <p class="info-value" title="{{ Auth::user()->assinatura->nm_assinatura }}">{{ Auth::user()->assinatura->nm_assinatura }}</p>
            </div>
        </div>

        <!-- Botão de Configurações -->
        <a href="{{ route('config.show') }}" class="btn btn-sm btn-outline-info w-100 mt-2">
            <i class="bi bi-gear me-1"></i>
            Configurações
        </a>
        
        <!-- Botão de Logout -->
        <form action="/login" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-light w-100 btn-logout" type="submit">
                <i class="bi bi-box-arrow-right me-1"></i>
                Sair da Conta
            </button>
        </form>
    </div>
</div>