<?php

use App\Http\Controllers\registro\fixo;
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
