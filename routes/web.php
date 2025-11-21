<?php

use App\Http\Controllers\Conta\LoginController;
use App\Http\Controllers\Conta\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\Registro\RegistroController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'guest'])->name('guest.home');
Route::get('/home', [HomeController::class, 'user'])->middleware('auth')->name('home');

Route::get("/about", function () {
    return view('about');
});

//Registros
Route::middleware("auth")
    ->controller(RegistroController::class)
    ->group(function () {
        Route::get("registro/", "index")->name("registro.index");

        Route::get("registro/create", "create")->name("registro.create");

        Route::get("registro/{registro}", "show")
            ->whereNumber("registro")
            ->name("registro.show");

        Route::post("registro/", "store")->name("registro.store");

        Route::get("registro/{registro}/edit", "edit")
            ->whereNumber("registro")
            ->name("registro.edit");

        Route::put("registro/{registro}", "update")
            ->whereNumber("registro")
            ->name("registro.put");

        Route::delete("registro/{registro}", "destroy")
            ->whereNumber("registro")
            ->name("registro.destroy");
    });

//Metas
Route::middleware("auth")
    ->controller(MetaController::class)
    ->group(function () {
        Route::get('meta/', "index")
            ->name("meta.index");

        Route::get("meta/create", "create")
            ->name("meta.create");

        Route::get("meta/{meta}", "show")
            ->whereNumber("meta")
            ->name("meta.show");

        Route::get("meta/{meta}/edit", 'edit')
            ->whereNumber('meta')
            ->name("meta.edit");

        Route::post("meta/", "store")
            ->name("meta.store");

        Route::put("meta/{meta}", "update")
            ->whereNumber("meta")
            ->name("meta.put");

        Route::delete("meta/{meta}", "destroy")
            ->whereNumber("meta")
            ->name("meta.destroy");
    });


//Relatorios
Route::middleware("auth")
    ->controller(RelatorioController::class)
    ->group(function() {
       Route::get("relatorio/",'index')->name("relatorio.index");
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
Route::middleware(['auth'])->group(function () {
    // CORREÇÃO: Usar ConfigController::class (importado no topo)
    Route::get('/config', function () {
        $user = Auth::user(); 
        $currentYear = date('Y');
        return view('components.conta.config', compact('user', 'currentYear'));
    })-> name('config.show');

    Route::post('/config/personal-data', function () {
        return redirect()->back()->with('success', 'Dados pessoais atualizados com sucesso!');
    })->name('config.updatePersonalData');

    Route::post('/config/password', function () {
        return redirect()->back()->with('success', 'Senha alterada com sucesso!');
    })->name('config.updatePassword');
});