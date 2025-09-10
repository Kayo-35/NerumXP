<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recursos\Registro;
use Illuminate\Support\Facades\Auth;
use DateTime;

class HomeController extends Controller
{
    public function user(Request $request)
    {
        $dtHoje = new DateTime(date('Y-m-d H:m:s'));
        $dtInicio = $dtHoje->modify('- 1 year')->format('Y-m-d H:m:s');
        $dtHoje = date('Y-m-d H:m:s');

        $resumo = DB::select(
            "CALL spAtualizaResumo(:user,:dtInicio,:dtTermino,:dtAlvo)",
            [
                "user" => Auth::user()->cd_usuario,
                'dtInicio' => $dtInicio,
                "dtTermino" => $dtHoje,
                "dtAlvo" => $dtHoje
            ],
        );
        $qtRenda = Registro::where("cd_tipo_registro", "=", 1)
            ->where("cd_usuario", "=", Auth::user()->cd_usuario)
            ->get()
            ->count();
        $qtDespesa = Registro::where("cd_tipo_registro", "=", 2)
            ->where("cd_usuario", "=", Auth::user()->cd_usuario)
            ->get()
            ->count();
        $registrosRecentes = Registro::select('cd_registro', 'nm_registro', 'vl_valor', 'ic_pago', 'cd_categoria', 'cd_tipo_registro')
            ->where('cd_usuario', Auth::user()->cd_usuario)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view("authHome", [
            "resumo" => $resumo,
            "qtRenda" => $qtRenda,
            "qtDespesa" => $qtDespesa,
            "registrosRecentes" => $registrosRecentes
        ]);
    }
    public function guest() {
        return view("guestHome");
    }
}
