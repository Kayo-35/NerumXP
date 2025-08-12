<?php

namespace App\Http\Controllers\Conta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create() {
        return view("conta.registration.create");
    }
    public function store(){
        //To-do
        return dd(request()->all());
    }
}
