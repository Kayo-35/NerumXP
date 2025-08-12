<?php

namespace App\Http\Controllers\registro;

use App\Http\Controllers\Controller;
use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Gerais\Localizacao;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Categorizadores\Pagamento\FormaPagamento;
use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use App\Models\Categorizadores\Registros\Tipo;
use App\Models\Personas\Realizador;
use App\Models\Recursos\RegistroFixo;
use Illuminate\Http\Request;

class fixo extends Controller
{
    //Métodos de recurso
    public function index() {
        $registros = RegistroFixo::all();
        return view("registro.fixo.index",[
            "registros" => $registros
        ]);
    }
    public function show(RegistroFixo $registroFixo) {
        return view("registro.fixo.show");
    }
    public function create() {
        return view("registro.fixo.create",[
            "tipos" => Tipo::all(),
            "formas" => FormaPagamento::all(),
            "metodos" => MetodoPagamento::all(),
            "importancias" => Nivel_imp::all(),
            "categorias" => Categoria::all(),
            "localizacaos" => Localizacao::all(),
            "realizadores" => Realizador::all(),
        ]);
    }
    public function store() {
        //To-do
        return dd(request()->all());
    }
    public function edit() {
        //To-do
    }
    public function update() {
        //To-do
    }
    public function destroy() {
        //To-do
    }
}
