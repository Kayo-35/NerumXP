<div class="dropdown">
    <button class="dropdown-toggle-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
        data-bs-auto-close="outside">
        <i class="bi bi-person-circle fs-4"></i>
    </button>

    <div class="dropdown-menu dropdown-menu-end user-dropdown">
        <form action="/login" method="POST">
            @csrf
            @method('DELETE')
            <!-- Header com avatar e informações principais -->
            <div class="user-profile-header">
                <div class="subscription-badge">
                    <i class="bi bi-award"></i>
                    {{ Auth::user()->assinatura->nm_assinatura }}
                </div>
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="user-name">{{ Auth::user()->nm_usuario }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>

            <!-- Seção de informações detalhadas -->
            <div class="user-info-section">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Nome Completo</div>
                        <p class="info-value">
                            {{ Auth::user()->nm_usuario }}
                        </p>
                    </div>
                </div>

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
            </div>

            <!-- Seção de logout -->
            <div class="logout-section">
                <button class="logout-btn" type="submit">
                    <i class="bi bi-box-arrow-right"></i>
                    Sair da Conta
                </button>
            </div>
        </form>
    </div>
</div>
