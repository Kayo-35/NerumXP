<?php

namespace App\Http\Controllers\Conta;

use App\Models\Personas\User;
use Illuminate\Validation\Rules\Password; //Helper para validar senhas
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view("conta.registration.create");
    }
    public function store(Request $request)
    {
        //Validar os dados enviados pelo usuário
        $validated = $request->validate([
            "nm_usuario" => "required|min:4|max:50",
            "email" => "required|email|unique:usuario,email",
            "password" => [
                "required",
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
            "dt_nascimento" =>
                "required|date|after:1900-01-01|before:2012-01-01",
        ]);

        //Hashing password
        $validated["password"] = Hash::make($validated["password"]);

        //Cadastra o usuário
        User::create([
            "cd_assinatura" => 1,
            "password" => $validated["password"],
            "email" => $validated["email"],
            "email_verified_at" => date("Y-m-d"),
            "remember_token" => null,
            "nm_usuario" => $validated["nm_usuario"],
            "dt_nascimento" => $validated["dt_nascimento"],
        ]);

        //Loga o usuário
        Auth::login(User::find(User::max("cd_usuario")));
        request()->session()->regenerate();

        // Redirecionar para a página inicial
        return redirect("/");
    }
}
