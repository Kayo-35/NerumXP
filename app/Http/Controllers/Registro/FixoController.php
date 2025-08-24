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
        $registrosFixo = RegistroFixo::where("cd_usuario", Auth::user()->cd_usuario)
            ->orderBy("cd_nivel_imp", "desc")
            ->orderBy("nm_registro", "asc")
            ->paginate(9);
        return view("registro.fixo.index", [
            "registros" => $registrosFixo,
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
        //Validar os dados submetidos
        $dados = $request->validate([
            //Provido por elemento implicitamente
            "cd_tipo_registro" => ["integer", "required"],
            "cd_tipo_forma" => [
                "nullable",
                "integer",
                "exists:forma_pagamento,cd_tipo_forma",
            ],
            "cd_nivel_imp" => [
                "nullable",
                "integer",
                "exists:nivel_imp,cd_nivel_imp",
            ],
            "cd_categoria" => [
                "nullable",
                "integer",
                "exists:categoria,cd_categoria",
            ],
            "cd_localizacao" => [
                "nullable",
                "integer",
                "exists:localizacao,cd_localizacao",
            ],
            "cd_realizador" => [
                "nullable",
                "integer",
                "exists:realizador_transacao,cd_realizador",
            ],
            //Providos manualmente pelos usuários
            "vl_valor" => ["required","numeric","between:0,9999999.99"],
            "ic_pago" => ["required"],
            "ic_status" => ["required"],
            "nm_registro" => ["required", "min:4", "max:50"],
            "dt_pagamento" => ["nullable", "date"],
            "qt_parcelas" => ["nullable", "integer", "gt:0"],
            "qt_parcelas_pagas" => ["nullable", "integer", "gt:0"],
            "ds_descricao" => ["nullable", "max:255"],
        ]);

        //Adicionado o código do usuário ao array
        $dados["cd_usuario"] = Auth::user()->cd_usuario;

        //Criar o registro
        $registro = RegistroFixo::create($dados);

        //Redirecionar
        return redirect(route("registroFixo.show", ["registroFixo" => $registro]));
    }
    public function edit(RegistroFixo $registroFixo)
    {
        Gate::authorize("access-registroFixo", $registroFixo);
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
        Gate::authorize("access-registroFixo", $registroFixo);
        return dd($request->all());
    }
    public function destroy(RegistroFixo $registroFixo)
    {
        Gate::authorize("access-registroFixo", $registroFixo);
        $registroFixo->delete();
        return redirect(route("registroFixo.index"));
    }
}
