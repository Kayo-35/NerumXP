<x-layout>
<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Login</h3>
                </div>
                <div class="card-body p-4">
                    <form action="/login" method="POST">
                        @csrf
                        <!-- Campo Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary fw-bold">Email</label>
                            <input type="email" class="form-control border-success" id="email" name="email" required>
                        </div>

                        <!-- Campo Senha -->
                        <div class="mb-3">
                            <label for="senha" class="form-label text-secondary fw-bold">Senha</label>
                            <input type="password" class="form-control border-success" id="senha" name="password" required>
                        </div>

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
</x-layout>
