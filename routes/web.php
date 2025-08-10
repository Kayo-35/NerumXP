<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conta\Assinatura;

Route::get("/", function () {
    return view("home");
});
