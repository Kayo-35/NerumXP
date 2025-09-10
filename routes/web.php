<?php

use App\Http\Controllers\Conta\LoginController;
use App\Http\Controllers\Conta\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Registro\RegistroController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'guest']);
Route::get('/home',[HomeController::class,'user'])->middleware('auth')->name('home');


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
