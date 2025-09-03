<?php

use App\Http\Controllers\Conta\LoginController;
use App\Http\Controllers\Conta\RegisterController;
use App\Http\Controllers\Registro\RegistroController;
use App\Models\Recursos\Registro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Testes
use Illuminate\Support\Facades\Auth;

Route::get("/", function () {
    if (Auth::check()) {
        $dtInicio = '2024-09-03';
        $resumo = DB::select(
            "CALL spAtualizaResumo(:user,:dtInicio,:dtTermino)",
            [
                "user" => Auth::user()->cd_usuario,
                'dtInicio' => $dtInicio,
                "dtTermino" => date('Y-m-d'),
            ],
        );
        $qtRenda = Registro::where("cd_tipo_registro", "=", 1)
            ->where("cd_usuario", "=", Auth::user()->cd_usuario)
            ->get()
            ->count();
        $qtDespesa = Registro::where("cd_tipo_registro", "=", 2)
            ->where("cd_usuario", "=", Auth::user()->cd_usuario)
            ->get()
            ->count();
        $registrosRecentes = Registro::select('cd_registro', 'nm_registro', 'vl_valor', 'ic_pago', 'cd_categoria', 'cd_tipo_registro')
            ->where('cd_usuario', Auth::user()->cd_usuario)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        return view("home", [
            "resumo" => $resumo,
            "qtRenda" => $qtRenda,
            "qtDespesa" => $qtDespesa,
            "registrosRecentes" => $registrosRecentes
        ]);
    }
    return view("home");
})->name("home");

Route::get("/about", function () {
    return view('about');
});

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
