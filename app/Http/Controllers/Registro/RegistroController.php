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
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    //Métodos de recurso
    public function index(Request $request)
    {
        //Avaliando se existe requisição para filtragem
        if (
            !empty($request->all()) &&
            !array_key_exists("page", $request->query())
        ) {
            //Validation
            $request->boolean("ic_pago");
            $request->boolean("ic_status");
            $request['vl_valor_minimo'] = str_replace(',', '.', $request['vl_valor_minimo']);

            $filters = $request->validate(indexFiltersRules());
            $registros = Registro::indexQuery($filters);

            $registros = empty($registros) ? [] : $registros;
            $request->flash();
        } else {
            $registros = Registro::where("cd_usuario", Auth::user()->cd_usuario);

            //Caso o usuário não deseja exibir
            if (!Auth::user()->ic_mostrar_registro_arquivado) {
                $registros = $registros->where('ic_status', true)
                    ->orderBy('ic_status', 'asc');
            }

            $registros = $registros->orderBy("updated_at", 'desc')
                ->orderBy("cd_nivel_imp", "desc")
                ->orderBy("nm_registro", "asc")
                ->paginate(9);
        }

        return view("registro.index", [
            "registros" => $registros,
            "qtRegistros" => Registro::count(),
            "tipos" => Tipo::all(),
            "categorias" => Categoria::orderBy("nm_categoria", "asc")->get(),
            "importancias" => Nivel_imp::orderBy("cd_nivel_imp", "asc")->get(),
            "modalidades" => Modalidade::all(),
        ]);
    }
    public function show(Registro $registro)
    {
        //Autorizando accesso ao recurso ou não
        $this->authorize("use", $registro);
        $metodos = $registro->metodo_pagamento()->get();
        $historico = $registro->historico()->select('vl_valor', 'updated_at')->orderBy('updated_at', 'desc')->get();
        return view("registro.show", [
            "registro" => $registro,
            "metodos" => $metodos ?? new Collection(),
            "historicos" => $historico->all() ?? []
        ]);
    }
    public function create(?Request $request)
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
        //Tratar elementos checkbox
        $request["ic_pago"] = $request->boolean("ic_pago");
        $request["ic_status"] = $request->boolean("ic_status");

        //Validar os dados submetidos
        $dados = $request->validate(registroRules());

        //Adicionado o código do usuário ao array
        $dados["cd_usuario"] = Auth::user()->cd_usuario;

        //Criar o registro
        $registro = Registro::create($dados);

        //Associar metodos na tabela associativa
        $registro->metodo_pagamento()->sync($request->metodos);

        //Incluindo feedback
        $request->session()
            ->flash('criar_registro', $registro->cd_registro);

        //Redirecionar
        return redirect(route("registro.index"));
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
        $data = $request->validate(registroRules());
        $registro->update($data);
        $registro->metodo_pagamento()->sync($request->metodos);

        $request->session()
            ->flash('atualizar_registro', $registro->cd_registro);

        return redirect(route("registro.index"));
    }
    public function destroy(Registro $registro, Request $request)
    {
        $this->authorize("use", $registro);
        $registro->delete();

        $request->session()
            ->flash('remover_registro', $registro->cd_registro);

        return redirect(route("registro.index"));
    }
}
