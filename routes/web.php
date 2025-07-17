<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conta\Assinatura;

Route::get("/", function () {
    $assinaturas = Assinatura::all();
    return view("home",["assinaturas" => $assinaturas]);
});
