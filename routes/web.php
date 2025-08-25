<?php
use App\Http\Controllers\Conta\LoginController;
use App\Http\Controllers\Conta\RegisterController;
use App\Http\Controllers\Registro\FixoController;
use App\Http\Controllers\Registro\FlutuanteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Query\Builder;
//Testes
use App\Models\Personas\User;

Route::view("/", "home")->name("home");

Route::view("/about",'about');

//Registros Fixos
Route::middleware('auth')->controller(FixoController::class)->group(function () {
    Route::get("registro/fixo", "index")->name("registroFixo.index");

    Route::get("registro/fixo/create", "create")->name("registroFixo.create");

    Route::get("registro/fixo/{registroFixo}", "show")
        ->whereNumber("registroFixo")
        ->name("registroFixo.show");

    Route::post("registro/fixo", "store")->name("registroFixo.store");

    Route::get("registro/fixo/{registroFixo}/edit", "edit")
        ->whereNumber("registroFixo")
        ->name("registroFixo.edit");

    Route::put("registro/fixo/{registroFixo}", "update")
        ->whereNumber("registroFixo")
        ->name("registroFixo.put");

    Route::delete("registro/fixo/{registroFixo}", "destroy")
        ->whereNumber("registroFixo")
        ->name("registroFixo.destroy");
});

//Laravel automatiza a criação de rotas CRUD para recursos
// A estrutura abaixo replica exatamente a mesma acima, com a exceção da nomenclatura das rotas
Route::resource("registro/flutuante", FlutuanteController::class);

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
