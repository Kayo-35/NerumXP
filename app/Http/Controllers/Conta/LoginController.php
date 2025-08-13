<?php

namespace App\Http\Controllers\Conta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(){
        return view("conta.login.create");
    }
    public function store(Request $request){
        //To-do
        $validated = $request->validate([
            "email" => 'email|required',
            "password" => 'min:8|required',
        ]);
        if(!Auth::attempt($validated)) {
            throw ValidationException::withMessages([
                "password" => "Credenciais Inválidas"
            ]);
        }
        request()->session()->regenerate();
        return redirect("/");
    }
    public function destroy(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
