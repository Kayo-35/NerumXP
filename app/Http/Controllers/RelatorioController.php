<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Recursos\Registro;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        //Validando os dados
        $validos = $request->validate([
            "dt_inicio" => 'date',
            "dt_fim" => 'date'
        ]);

        $anoPadrao = Auth::user()->dt_ano_relatorio;
        $inicioPadrao = "{$anoPadrao}-01-01";
        $fimPadrao = "{$anoPadrao}-12-31";

        $request->flash();

        $rendaPorCategoria = Registro::relatorioTotalPorCategoria(1, $validos['dt_inicio'] ?? $inicioPadrao, $validos['dt_fim'] ?? $fimPadrao);
        $despesaPorCategoria = Registro::relatorioTotalPorCategoria(2, $validos['dt_inicio'] ?? $inicioPadrao, $validos['dt_fim'] ?? $fimPadrao);
        $rendaPorMes = Registro::relatorioTotalPorMes(1, $validos['dt_inicio'] ?? $inicioPadrao, $validos['dt_fim'] ?? $fimPadrao);
        $despesaPorMes = Registro::relatorioTotalPorMes(2, '2025-01-01' ?? $inicioPadrao, '2025-12-31' ?? $fimPadrao);
        return view('relatorio.index', [
            "rendaPorCategoria" => $rendaPorCategoria,
            "despesaPorCategoria" => $despesaPorCategoria,
            "rendaPorMes" => $rendaPorMes,
            "despesaPorMes" => $despesaPorMes
        ]);
    }
}
