<x-layout>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Registro de Conta</h3>
                </div>
                <div class="card-body p-4">
                    <form>
                        <!-- Campo Nome -->
                        <div class="mb-3">
                            <label for="nome" class="form-label text-secondary fw-bold">Nome Completo</label>
                            <input type="text" class="form-control border-success" id="nome" name="nome" required>
                            <div class="form-text text-muted">Digite seu nome completo</div>
                        </div>

                        <!-- Campo Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary fw-bold">Email</label>
                            <input type="email" class="form-control border-success" id="email" name="email" required>
                        </div>

                        <!-- Campo Senha -->
                        <div class="mb-3">
                            <label for="senha" class="form-label text-secondary fw-bold">Senha</label>
                            <input type="password" class="form-control border-success" id="senha" name="senha" required>
                        </div>

                        <!-- Campo Data de Nascimento -->
                        <div class="mb-4">
                            <label for="dataNascimento" class="form-label text-secondary fw-bold">Data de Nascimento</label>
                            <input type="date" class="form-control border-success" id="dataNascimento" name="dataNascimento" required>
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
