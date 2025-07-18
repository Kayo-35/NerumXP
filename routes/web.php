<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conta\Assinatura;

Route::get("/", function () {
    return view("home");
});

Route::get("/testeI", function() {
    $assinaturas = Assinatura::all();
    return view("testeI",["assinaturas" => $assinaturas]);
});

Route::get("/testeII", function() {
    return view("testeII");
});
