<x-base>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    @endpush

    <header class="header">
        <div class="container">
            <div class="header-content">
                <img src="{{ asset('img/logo_projeto_fundo_branco.png') }}" class="header-logo" />
                <div>
                    <h1 class="header-title">Configurações</h1>
                    <p class="header-subtitle">Gerencie suas preferências e informações da conta</p>
                </div>
            </div>
        </div>
    </header>

    <main class="container mb-5">
        <!-- Alertas de Sucesso -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- nav tabs -->
        <div class="nav nav-tabs" role="tablist">
            <div class="nav-item" role="presentation">
                <button class="nav-link active" id="preferences-tab" data-bs-toggle="tab" data-bs-target="#preferences"
                    type="button" role="tab" aria-controls="preferences" aria-selected="true">
                    <i class="fas fa-globe"></i><span class="d-none d-sm-inline">Preferências</span>
                </button>
            </div>
            <div class="nav-item" role="presentation">
                <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button"
                    role="tab" aria-controls="account" aria-selected="false">
                    <i class="fas fa-user"></i><span class="d-none d-sm-inline">Conta</span>
                </button>
            </div>
            <div class="nav-item" role="presentation">
                <button class="nav-link" id="subscription-tab" data-bs-toggle="tab" data-bs-target="#subscription"
                    type="button" role="tab" aria-controls="subscription" aria-selected="false">
                    <i class="fas fa-credit-card"></i><span class="d-none d-sm-inline">Assinatura</span>
                </button>
            </div>
        </div>

        <div class="tab-content">
            <!-- ABA: PREFERÊNCIAS -->
            <div class="tab-pane fade show active" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-globe"></i>
                            Idioma e Localização
                        </h5>
                        <p class="card-text">
                            Escolha seu idioma preferido e localização
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="language" class="form-label">Idioma</label>
                            <select class="form-select" id="language">
                                <option selected>Português (Brasil)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Moeda</label>
                            <select class="form-select" id="currency">
                                <option selected>Real Brasileiro (R$)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-info">
                            <i class="fas fa-bell"></i>
                            Notificações
                        </h5>
                        <p class="card-text">Controle como você recebe notificações</p>
                    </div>
                    <div class="card-body">
                        <div class="settings-row">
                            <div class="settings-label">
                                <h6>Alertas de Edição de Registro</h6>
                                <p>Receba notificações sobre seu registro atualizado</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="alerts" checked />
                            </div>
                        </div>
                        <div class="settings-row">
                            <div class="settings-label">
                                <h6>Alertas de Exclusão de Registro</h6>
                                <p>Receba notificações quando seu registro for excluído</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-purple">
                            <i class="fas fa-shield-alt"></i>
                            Preferências e Privacidade
                        </h5>
                        <p class="card-text">
                            Gerencie suas preferências e configurações de privacidade
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="settings-row">
                            <div class="settings-label">
                                <h6>Registros arquivados</h6>
                                <p>
                                    Gostaria que registros arquivados sejam exibidos na listagem
                                    geral?
                                </p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="public-profile" checked />
                            </div>
                        </div>
                        <div class="settings-row">
                            <div class="settings-label">
                                <h6>Metas arquivadas</h6>
                                <p>
                                    Gostaria que metas arquivadas sejam exibidas na listagem
                                    geral?
                                </p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="data-analysis" checked />
                            </div>
                        </div>
                        <div class="settings-row">
                            <div class="settings-label">
                                <h6>Ano padrão</h6>
                                <p>Qual ano padrão dos relatórios?</p>
                            </div>
                            <div class="settings-control">
                                <input type="number" class="form-control text-end" id="default-year" min="1900"
                                    max="2099" value="{{ $currentYear }}" aria-label="Ano Padrão" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ABA: CONTA -->
            <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                <!-- Dados Pessoais -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-success">
                            <i class="fas fa-user"></i>
                            Dados Pessoais
                        </h5>
                        <p class="card-text">Suas informações de identificação</p>
                    </div>
                    <form method="POST" action="{{ route('config.updatePersonalData') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nm_usuario" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control @error('nm_usuario') is-invalid @enderror"
                                        id="nm_usuario" name="nm_usuario" placeholder="João Silva"
                                        value="{{ old('nm_usuario', $user->nm_usuario) }}" required />
                                    <x-helper.error campo="nm_usuario" />
                                </div>
                                <div class="col-md-6">
                                    <label for="dt_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control @error('dt_nascimento') is-invalid @enderror"
                                        id="dt_nascimento" name="dt_nascimento"
                                        value="{{ old('dt_nascimento', $user->dt_nascimento?->format('Y-m-d')) }}" />
                                    <x-helper.error campo="dt_nascimento" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="joao@example.com"
                                    value="{{ old('email', $user->email) }}" required />
                                <x-helper.error campo="email" />
                            </div>
                            <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
                        </div>
                    </form>
                </div>

                <!-- Segurança / Alterar Senha -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-danger">
                            <i class="fas fa-lock"></i>
                            Segurança
                        </h5>
                        <p class="card-text">Gerencie a segurança da sua conta</p>
                    </div>
                    <form method="POST" action="{{ route('config.updatePassword') }}">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Senha Atual</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required />
                                <x-helper.error campo="current_password" />
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nova Senha</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" required />
                                <x-helper.error campo="new_password" />
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmar Nova Senha</label>
                                <input type="password"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" name="new_password_confirmation" required />
                                <x-helper.error campo="new_password_confirmation" />
                            </div>
                            <button type="submit" class="btn btn-info w-100">Alterar Senha</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ABA: ASSINATURA -->
            <div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="subscription-tab">
                <div class="subscription-highlight">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="subscription-stat">
                                <p>Plano</p>
                                <h4 style="color: var(--primary-color)">{{ $user->assinatura->nm_assinatura ?? 'Gratuito' }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="subscription-stat">
                                <p>Valor Mensal</p>
                                <h4 style="color: var(--primary-color)">R$ 0,00</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="subscription-stat">
                                <p>Status</p>
                                <h4 style="color: var(--primary-color)">Ativo</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Gerenciar Assinatura</h5>
                        <p class="card-text">
                            Altere seu plano ou cancele sua assinatura
                        </p>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-outline-secondary w-100 mb-2" type="button">
                            Mudar Plano
                        </button>
                        <button class="btn btn-outline-danger w-100" type="button">
                            Cancelar Assinatura
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-base>