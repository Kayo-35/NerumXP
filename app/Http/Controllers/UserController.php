<?php

namespace App\Http\Controllers;

use App\Models\Personas\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('components.conta.config', compact('user'));
    }
    public function patchDados(Request $request)
    {
        $user = Auth::user();
        //Um email de usuário tem de ser único, mas se o usuário não atualizar o email
        //no formulário a atualização não seria capaz de identificar tal fato.
        $validados = $this->validarDados($user->email, $request);

        //Atualizando
        $user->update($validados);

        //Feedback/Redirecionar
        $request->session()
            ->flash('success', $user);
        return redirect(route('index.config'));
    }
    public function patchSenha(Request $request)
    {
        $user = Auth::user();
        //Verificando se a nova senha esta nos conformes
        $validos = $request->validate([
            "password" => [
                "required",
                "confirmed",
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ]);

        //Verificando se a senha previa foi submetida como devido
        if (!(Hash::check($request['current_password'], $user->password))) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Senha atual inválida!'])
                ->withInput();
        }

        //Criando o novo hash para a senha
        $validos['password'] = bcrypt($validos['password']);

        //Atualizando
        $user->update($validos);

        //Feedback
        $request->session()
            ->flash('success', $user);

        return view('components.conta.config', compact('user'));
    }

    public function updatePreferencias(Request $request)
    {
        $user = Auth::user();

        //Casting das checkboxes
        $request->merge([
            "ic_alerta_registro" => $request->boolean('ic_alerta_registro'),
            "ic_alerta_meta" => $request->boolean('ic_alerta_meta'),
            "ic_mostrar_registro_arquivado" => $request->boolean('ic_mostrar_registro_arquivado'),
            "ic_mostrar_meta_arquivada" => $request->boolean('ic_mostrar_meta_arquivada')
        ]);

        //Validando os dados
        $validados = $request->validate([
            "ic_alerta_registro" => ['required','boolean'],
            "ic_alerta_meta" => ['required', 'boolean'],
            "ic_mostrar_registro_arquivado" => ['required', 'boolean'],
            "ic_mostrar_meta_arquivada" => ['required','boolean'],
            "dt_ano_relatorio" => ['required', 'numeric', 'digits:4', 'min: 1900', 'max:' . date('Y')]
        ]);

        //Atualizando
        $user->update($validados);

        //Feedback/Redirecionar
        $request->session()
            ->flash('success', $user);
        return redirect(route('index.config'));
    }

    //Helper
    private function validarDados(string $email, Request $request): mixed
    {
        $validados = [];
        if ($email != $request['email']) {
            $validados = $request->validate([
                "nm_usuario" => "required|min:4|max:50",
                "email" => "required|email|unique:usuario,email",
                "dt_nascimento" =>
                    "required|date|after:1900-01-01|before:2012-01-01",
            ]);
        } else {
            $validados = $request->validate([
                "nm_usuario" => "required|min:4|max:50",
                "dt_nascimento" =>
                    "required|date|after:1900-01-01|before:2012-01-01",
            ]);
        }
        return $validados;
    }
}
