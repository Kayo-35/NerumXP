<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Gerais\Localizacao;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Categorizadores\Pagamento\FormaPagamento;
use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use App\Models\Categorizadores\Registros\Tipo;
use App\Models\Personas\Realizador;
use App\Models\Recursos\RegistroFixo;
use BcMath\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FixoController extends Controller
{
    //Métodos de recurso
    public function index()
    {
        $registros = RegistroFixo::where("cd_usuario", Auth::user()->cd_usuario)
            ->orderBy("cd_nivel_imp", "desc")
            ->orderBy("nm_registroFixo", "asc")
            ->paginate(9);
        return view("registro.fixo.index", [
            "registros" => $registros,
        ]);
    }
    public function show(RegistroFixo $registroFixo)
    {
        //Autorizando accesso ao recurso ou não
        Gate::authorize("access-registroFixo", $registroFixo);

        return view("registro.fixo.show", [
            "registro" => $registroFixo,
        ]);
    }
    public function create()
    {
        return view("registro.fixo.create", [
            "registro" => [],
            "tipos" => Tipo::all(),
            "metodos" => MetodoPagamento::all(),
            "formas" => FormaPagamento::all(),
            "importancias" => Nivel_imp::all(),
            "categorias" => Categoria::all(),
            "localizacaos" => Localizacao::all(),
            "realizadores" => Realizador::all(),
        ]);
    }
    public function store(Request $request)
    {
        //To-do
        return dd($request->all());
    }
    public function edit(RegistroFixo $registroFixo)
    {
        Gate::authorize('access-registroFixo',$registroFixo);
        $metodosProprios = $registroFixo
            ->metodo_pagamento()
            ->pluck("metodo_pagamento.cd_tipo_metodo")
            ->toArray();

        return view("registro.fixo.edit", [
            "registro" => $registroFixo,
            "metodosProprios" => $metodosProprios,
            "tipos" => Tipo::all(),
            "metodos" => MetodoPagamento::all(),
            "formas" => FormaPagamento::all(),
            "importancias" => Nivel_imp::all(),
            "categorias" => Categoria::all(),
            "localizacaos" => Localizacao::all(),
            "realizadores" => Realizador::all(),
        ]);
    }
    public function update(Request $request, RegistroFixo $registroFixo)
    {
        Gate::authorize('access-registroFixo',$registroFixo);
        return dd($request->all());
    }
    public function destroy(RegistroFixo $registroFixo)
    {
        Gate::authorize('access-registroFixo',$registroFixo);
        $registroFixo->delete();
        return redirect(route("registroFixo.index"));
    }
}
