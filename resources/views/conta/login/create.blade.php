<x-base>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow rounded-5">
                <br>
                <a href="{{ route('guest.home') }}"><img src="{{ asset('img/logo_projeto_fundo_branco.png') }}" width="50" class="d-block mx-auto"></a>
                <div class="text-center">
                    <h3 class="mb-0">Login</h3>
                </div>
                <div class="card-body p-4">
                    <form action="/login" method="POST">
                        @csrf
                        <!-- Campo Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <x-helper.error campo="email"></x-helper.error>
                        </div>

                        <!-- Campo Senha -->
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="password" required>
                            <x-helper.error campo="password"></x-helper.error>
                        </div>

                        <br>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                Logar
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                Limpar
                            </button>
                        </div>

                        <!-- Link adicional -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Não tem uma conta?
                                <a href="{{ route("register.create") }}" class="text-success text-decoration-none">Registre-se</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-base>
