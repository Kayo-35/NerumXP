<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Conta\LoginController;
use App\Http\Controllers\Conta\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\Registro\RegistroController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'guest'])->name('guest.home');
Route::get('/home', [HomeController::class, 'user'])->middleware('auth')->name('home');

Route::get("/about", function () {
    return view('about');
});

//Registros
Route::prefix('registro')
    ->middleware("auth")
    ->controller(RegistroController::class)
    ->group(function () {
        Route::get("/", "index")->name("registro.index");

        Route::get("/create", "create")->name("registro.create");

        Route::get("/{registro}", "show")
            ->whereNumber("registro")
            ->name("registro.show");

        Route::post("/", "store")->name("registro.store");

        Route::get("/{registro}/edit", "edit")
            ->whereNumber("registro")
            ->name("registro.edit");

        Route::put("/{registro}", "update")
            ->whereNumber("registro")
            ->name("registro.put");

        Route::delete("/{registro}", "destroy")
            ->whereNumber("registro")
            ->name("registro.destroy");
    });

//Metas
Route::prefix('meta')
    ->middleware("auth")
    ->controller(MetaController::class)
    ->group(function () {
        Route::get('/', "index")
            ->name("meta.index");

        Route::get("/create", "create")
            ->name("meta.create");

        Route::get("/{meta}", "show")
            ->whereNumber("meta")
            ->name("meta.show");

        Route::get("/{meta}/edit", 'edit')
            ->whereNumber('meta')
            ->name("meta.edit");

        Route::post("/", "store")
            ->name("meta.store");

        Route::put("/{meta}", "update")
            ->whereNumber("meta")
            ->name("meta.put");

        Route::delete("/{meta}", "destroy")
            ->whereNumber("meta")
            ->name("meta.destroy");
    });


//Relatorios
Route::middleware("auth")
    ->controller(RelatorioController::class)
    ->group(function () {
        Route::get("relatorio/", 'index')->name("relatorio.index");
    });

//Registration
Route::controller(RegisterController::class)->group(function () {
    Route::get("register/create", "create")->name("register.create");
    Route::post("register", "store")->name("register.store");
});

//Login
Route::controller(LoginController::class)->group(function () {
    Route::get("login/create", "create")->name("login.create");
    Route::post("login", "store");
    Route::delete("login", "destroy");
});

//Termos de uso
Route::get('/termos-de-uso', function () {
    return view('components.conta.termos');
})->name('termos.show');

// Configurações do usuário
Route::prefix('/config')
    ->middleware(['auth'])
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index')
            ->name('index.config');

        Route::patch('/atualizar_dados', 'patchDados')
            ->name('patch_dados.config');

        Route::patch('/alterar_senha', 'patchSenha')
            ->name('patch_senha.config');

        Route::put('/preferencias', 'updatePreferencias')
            ->name('update_preferencias.config');
    });
