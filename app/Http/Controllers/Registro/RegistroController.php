<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Gerais\Localizacao;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Categorizadores\Pagamento\FormaPagamento;
use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use App\Models\Categorizadores\Registros\Juro;
use App\Models\Categorizadores\Registros\Modalidade;
use App\Models\Categorizadores\Registros\Tipo;
use App\Models\Personas\Realizador;
use App\Models\Recursos\Registro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    //Métodos de recurso
    public function index()
    {
        $registros = Registro::where("cd_usuario", Auth::user()->cd_usuario)
            ->orderBy("cd_nivel_imp", "desc")
            ->orderBy("nm_registro", "asc")
            ->paginate(9);
        return view("registro.index", [
            "registros" => $registros,
        ]);
    }
    public function show(Registro $registro)
    {
        //Autorizando accesso ao recurso ou não
        $this->authorize("use", $registro);
        $metodos = $registro->metodo_pagamento()->get();

        return view("registro.show", [
            "registro" => $registro,
            "metodos" => $metodos ?? new Collection(),
        ]);
    }
    public function create()
    {
        return view("registro.create", [
            "registro" => [],
            "modalidades" => Modalidade::all(),
            "juros" => Juro::all(),
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
        //Validar os dados submetidos
        $dados = $request->validate(registroRules());
        dd($dados);

        //Adicionado o código do usuário ao array
        $dados["cd_usuario"] = Auth::user()->cd_usuario;

        //Criar o registro
        $registro = Registro::create($dados);
        //Redirecionar
        return redirect(route("registro.show", ["registro" => $registro]));
    }
    public function edit(Registro $registro)
    {
        $this->authorize("use", $registro);
        $metodosProprios = $registro
            ->metodo_pagamento()
            ->pluck("metodo_pagamento.cd_metodo")
            ->toArray();

        return view("registro.edit", [
            "registro" => $registro,
            "metodosProprios" => $metodosProprios,
            "modalidades" => Modalidade::all(),
            "juros" => Juro::all(),
            "tipos" => Tipo::all(),
            "metodos" => MetodoPagamento::all(),
            "formas" => FormaPagamento::all(),
            "importancias" => Nivel_imp::all(),
            "categorias" => Categoria::all(),
            "localizacaos" => Localizacao::all(),
            "realizadores" => Realizador::all(),
        ]);
    }
    public function update(Request $request, Registro $registro)
    {
        $this->authorize("use", $registro);
        return dd($request->all());
    }
    public function destroy(Registro $registro)
    {
        $this->authorize("use", $registro);
        $registro->delete();
        return redirect(route("registro.index"));
    }
}
