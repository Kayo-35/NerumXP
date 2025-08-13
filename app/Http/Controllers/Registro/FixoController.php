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
        $registros = RegistroFixo::orderBy('nm_registroFixo')->paginate(9);
        return view("registro.fixo.index", [
            "registros" => $registros,
        ]);
    }
    public function show(RegistroFixo $registroFixo)
    {
        return view("registro.fixo.show", $registroFixo);
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
    public function edit(int $id)
    {
        return view("registro.fixo.edit",[
            "registro" => RegistroFixo::find($id),
            "tipos" => Tipo::all(),
            "formas" => FormaPagamento::all(),
            "metodos" => MetodoPagamento::all(),
            "importancias" => Nivel_imp::all(),
            "categorias" => Categoria::all(),
            "localizacaos" => Localizacao::all(),
            "realizadores" => Realizador::all(),
        ]);
    }
    public function update(Request $request, int $id)
    {
        //To-do
        return dd($request->all());
    }
    public function destroy(int $id)
    {
        //To-do
    }
}
