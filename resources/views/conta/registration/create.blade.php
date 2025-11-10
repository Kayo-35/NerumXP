<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Card de Cadastro -->
                <div class="card shadow rounded-5">

                    <!-- Cabeçalho -->
                    <br>
                    <a href="{{ route('guest.home') }}"><img src="{{ asset('img/logo_projeto_fundo_branco.png') }}" width="50" class="d-block mx-auto"></a>
                    <div class="text-center">
                        <h3 class="mb-2">Registro de Conta</h3>
                    </div>

                    <!-- Corpo do Formulário -->
                    <div class="card-body p-4">
                        <form action="{{ route("register.store") }}" method="POST">
                            @csrf
                            <!-- Campo Nome -->
                            <div class="mb-4">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nm_usuario" placeholder="Digite seu nome completo" required>
                                <x-helper.error campo="nm_usuario" class="mt-2"></x-helper.error>
                            </div>

                            <!-- Campo Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <x-helper.error campo="email" class="mt-2"></x-helper.error>
                            </div>

                            <!-- Campo Senha -->
                            <div class="mb-4">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="password" required>
                                <x-helper.error campo="password" class="mt-2"></x-helper.error>
                            </div>

                            <!-- Campo Data de Nascimento -->
                            <div class="mb-4">
                                <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dataNascimento" name="dt_nascimento" value="{{ $dtNascimento ?? ''}}" required>
                                <x-helper.error campo="dt_nascimento" class="mt-2"></x-helper.error>
                            </div>

                            <!--Checkbox Termos e Condições-->
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="" id="checkDefault" required>
                                <label class="form-check-label" for="checkDefault">
                                    Li e estou de acordo com o <a href="{{ route('termos.show') }}" class="text-decoration-none" target="_blank">Termo
                                    de Uso e Política de Privacidade</a>
                                </label>
                            </div>

                            <!-- Botões -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    Criar Conta
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    Limpar Formulário
                                </button>
                            </div>

                            <!-- Link adicional -->
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    Já possui uma conta?
                                    <a href="{{ route("login.create") }} " class="text-success text-decoration-none">Faça login</a>
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
