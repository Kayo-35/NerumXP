<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Recursos\Registro;

class RelatorioController extends Controller
{
    public function index()
    {
        $rendaPorCategoria = Registro::relatorioTotalPorCategoria(1,'2024');
        $despesaPorCategoria = Registro::relatorioTotalPorCategoria(2,'2024');
        $rendaPorMes = Registro::relatorioTotalPorMes(1,'2024');
        $despesaPorMes = Registro::relatorioTotalPorMes(2,'2024');
        return view('relatorio.index', [
            "rendaPorCategoria" => $rendaPorCategoria,
            "despesaPorCategoria" => $despesaPorCategoria,
            "rendaPorMes" => $rendaPorMes,
            "despesaPorMes" => $despesaPorMes
        ]);
    }
}
