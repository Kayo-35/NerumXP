<?php

use App\Http\Controllers\registro\fixo;
use App\Http\Controllers\registro\flutuante;
use App\Models\Recursos\RegistroFlutuante;
use Illuminate\Support\Facades\Route;

Route::view("/","home")->name("home");

//Registros Fixos
Route::controller(fixo::class)->group(function() {
    Route::get("registro/fixo","index")
        ->name("registroFixo.index");

    Route::get("registro/fixo/{id}","show")
        ->whereNumber("id")
        ->name("registroFixo.show");

    Route::get("registro/fixo/create","create")
        ->name("registroFixo.create");

    Route::post("registro/fixo","store")
        ->name("registroFixo.store");

    Route::get("registro/fixo/{id}/edit","edit")
        ->whereNumber("id")
        ->name("registroFixo.edit");

    Route::put("registro/fixo/{id}","update")
        ->whereNumber("id")
        ->name("registroFixo.put");

    Route::delete("registro/fixo/{id}","destroy")
        ->whereNumber("id")
        ->name("registroFixo.destroy");
});

//Laravel automatiza a criação de rotas CRUD para recursos!
// A estrutura abaixo replica exatamente a mesma acima, com a exceção da nomenclatura das rotas
Route::resource('registro/flutuante',flutuante::class);
