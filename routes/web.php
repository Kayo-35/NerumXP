<?php
use App\Http\Controllers\Conta\LoginController;
use App\Http\Controllers\Conta\RegisterController;
use App\Http\Controllers\Registro\RegistroController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Testes
use Illuminate\Support\Facades\Auth;

Route::get("/", function () {
    if (Auth::check()) {
        $resumo = DB::select("CALL spAtualizaResumo(?,?,?)", [
            Auth::user()->cd_usuario,
            "2024-08-29",
            "2025-08-29",
        ]);
        return view("home", [
            "resumo" => $resumo,
        ]);
    }
    return view("home");
})->name("home");

Route::view("/about",'about')->name('about');

//Registros Fixos
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
