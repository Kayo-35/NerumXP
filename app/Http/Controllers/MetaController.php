<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recursos\Metas;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    public function index()
    {
        //Obtem todas as metas associadas ao usuário
        $metas = Metas::where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->orderBy('cd_nivel_imp','desc')
            ->get();
        return view("meta.index", [
            "metas" => $metas,
        ]);
    }
    public function show(Metas $meta) {
        //Exibe uma única meta
    }
    public function create() {}
    public function edit(Metas $meta) {}
    public function store(Request $request) {}
    public function update(Metas $meta, Request $request) {}
    public function destroy(Metas $meta) {}
}
