<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
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

class FixoController extends Controller
{
    //Métodos de recurso
    public function index()
    {
        $registros = RegistroFixo::where("cd_usuario", 2)
            ->orderBy("nm_registroFixo")
            ->paginate(9);
        return view("registro.fixo.index", [
            "registros" => $registros,
        ]);
    }
    public function show(RegistroFixo $registroFixo)
    {
        return view("registro.fixo.show", [
            "registro" => $registroFixo,
        ]);
    }
    public function create()
    {
        return view("registro.fixo.create", [
            "tipos" => Tipo::all(),
            "formas" => FormaPagamento::all(),
            "metodos" => MetodoPagamento::all(),
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
        $metodosProprios = $registroFixo->metodo_pagamento()->pluck('metodo_pagamento.cd_tipo_metodo')->toArray();
        $listaMetodos = array_column(
            MetodoPagamento::select("cd_tipo_metodo")->get()->toArray(),
            "cd_tipo_metodo",
        );

        return view("registro.fixo.edit", [
            "registro" => $registroFixo,
            "tipos" => Tipo::all(),
            "formas" => FormaPagamento::all(),
            "metodos" => MetodoPagamento::all(),
            "importancias" => Nivel_imp::all(),
            "categorias" => Categoria::all(),
            "localizacaos" => Localizacao::all(),
            "realizadores" => Realizador::all(),
            "metodosProprios" => $metodosProprios,
        ]);
    }
    public function update(Request $request, int $id)
    {
        //To-do
        return dd($request->all());
    }
    public function destroy(RegistroFixo $registroFixo)
    {
        $registroFixo->delete();
        return redirect(route("registroFixo.index"));
    }
}
