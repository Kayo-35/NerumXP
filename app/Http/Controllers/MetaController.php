<?php

namespace App\Http\Controllers;

use App\Models\Categorizadores\Metas\Tipo_Meta;
use Illuminate\Http\Request;
use App\Models\Recursos\Metas;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\This;

class MetaController extends Controller
{
    public function index()
    {
        //Obtem todas as metas associadas ao usuário
        $metas = Metas::where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->orderBy('cd_nivel_imp', 'desc')
            ->paginate(9);
        $panorama = DB::select('CALL sp_panorama_metas(:cd_usuario)', [
            "cd_usuario" => Auth::user()->cd_usuario
        ])[0];
        return view("meta.index", [
            "metas" => $metas,
            "panorama" => $panorama
        ]);
    }
    public function show(Metas $meta)
    {
        //Exibe uma única meta
        $registrosMeta = $meta->registro()
            ->select(
                'registro.cd_registro',
                'registro.cd_nivel_imp',
                'nm_registro',
                'vl_valor',
                'cd_modalidade',
                'registro.created_at',
                'cd_categoria',
                'ic_pago'
            )
            ->get();
        return view("meta.show", [
            "meta" => $meta,
            "registrosMeta" => $registrosMeta
        ]);
    }
    public function create(Request $request)
    {

        //tipos validos
        $tiposValidos = Tipo_Meta::pluck('cd_tipo_meta')->toArray();
        $tiposValidosString = implode(',',$tiposValidos);

        //Validando se a requisição para criação contém apenas os tipos
        try {
            $validated = $request->validate([
                'tipo' => ['sometimes', 'array'],

                'tipo.*' => ['in:' . $tiposValidosString],
            ]);
        } catch (ValidationException)  {
            throw ValidationException::withMessages([
                "tipos" => ['Tipos Invalidos'],
            ]);
        }
        return view("meta.create");
    }
    public function edit(Metas $meta) {}
    public function store(Request $request) {}
    public function update(Metas $meta, Request $request) {}
    public function destroy(Metas $meta) {}
}
