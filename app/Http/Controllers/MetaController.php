<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recursos\Metas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MetaController extends Controller
{
    public function index()
    {
        $this->authorize("access");
        //Obtem todas as metas associadas ao usuário
        $metas = Metas::where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->orderBy('cd_nivel_imp','desc')
            ->paginate(9);
        $panorama = DB::select('CALL sp_panorama_metas(:cd_usuario)',[
            "cd_usuario" => Auth::user()->cd_usuario
        ])[0];
        return view("meta.index", [
            "metas" => $metas,
            "panorama" => $panorama
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
