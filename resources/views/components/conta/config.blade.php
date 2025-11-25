<x-base>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    @endpush

    <header class="header">
        <div class="header-content d-flex justify-content-around">
            <div>
                <img src="{{ asset('img/logo_projeto_fundo_branco.png') }}" class="header-logo" />
                <div>
                    <h1 class="header-title">Configurações</h1>
                    <p class="header-subtitle">Gerencie suas preferências e informações da conta</p>
                </div>
            </div>
            <div class="py-4">
                <a href="{{ route('home') }}" class="btn btn-outline-success btn-lg">
                    <i class="bi bi-house-door-fill me-2"></i>
                    Página Inicial
                </a>
            </div>
        </div>
    </header>

    <main class="container mb-5">
        <!-- Alertas de Sucesso -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ ucfirst($user->nm_usuario) }} seus dados foram atualizados com sucesso! <i class="bi bi-emoji-laughing"></i>
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
                <form method="POST" action="{{ route('update_preferencias.config') }}">
                    @method('PUT')
                    @csrf
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
                                    <h6>Alertas de Manipulação de Registros</h6>
                                    <p>Receba notificações sobre seus registros forem manipulados</p>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="ic_alerta_registro" type="checkbox" id="alerts"
                                    {{ $user->ic_alerta_registro ? 'checked' : '' }}/>
                                </div>
                            </div>
                            <div class="settings-row">
                                <div class="settings-label">
                                    <h6>Alertas de Manipulação de Metas</h6>
                                    <p>Receba notificações quando suas metas forem manipuladas</p>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="ic_alerta_meta" type="checkbox"
                                    {{ $user->ic_alerta_meta ? 'checked' : '' }}/>
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
                                Gerencie suas preferências gerais
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
                                    <input class="form-check-input" name="ic_mostrar_registro_arquivado" type="checkbox" id="public-profile"
                                    {{ $user->ic_mostrar_registro_arquivado ? 'checked' : '' }}
                                    />
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
                                    <input class="form-check-input" name="ic_mostrar_meta_arquivada" type="checkbox" id="data-analysis"
                                    {{ $user->ic_mostrar_meta_arquivada ? 'checked' : '' }}/>
                                </div>
                            </div>
                            <div class="settings-row">
                                <div class="settings-label">
                                    <h6>Ano padrão</h6>
                                    <p>Qual ano padrão dos relatórios?</p>
                                </div>
                                <div class="settings-control">
                                    <input type="number" class="form-control text-end" id="default-year" name="dt_ano_relatorio" min="1900"
                                        max="2099" value="{{ old('dt_ano_relatorio', $user->dt_ano_relatorio) }}" />
                                    <x-helper.error campo="dt_ano_relatorio"></x-helper.error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container py-1">
                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <div class="d-grid gap-1">
                                    <button type="submit" class="btn btn-outline-success btn-lg">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        Atualizar Preferências
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                    <form method="POST" action="{{ route('patch_dados.config') }}">
                        @method('PATCH')
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
                    <form method="POST" action="{{ route('patch_senha.config') }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Senha Atual</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required />
                                <x-helper.error campo="current_password" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Nova Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required />
                                <x-helper.error campo="password" />
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmar Nova Senha</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" required />
                                <x-helper.error campo="password_confirmation" />
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
</x-base>
