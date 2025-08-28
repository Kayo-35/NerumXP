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
use BcMath\Number;
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
    public function show(Registro $Registro)
    {
        //Autorizando accesso ao recurso ou não
        $this->authorize("use", $Registro);

        return view("registro.show", [
            "registro" => $Registro,
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
        $dados = $request->validate([
            //Provido por elemento implicitamente
            "cd_tipo_registro" => [
                "integer",
                "required",
                "exists:tipo_registro,cd_tipo_registro",
            ],
            "cd_modalidade" => [
                "integer",
                "required",
                "exists:modalidade,cd_modalidade",
            ],
            "cd_forma" => [
                "nullable",
                "integer",
                "exists:forma_pagamento,cd_forma",
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
            "cd_tipo_juro" => [
                "nullable",
                "numeric",
                "exists:registro_tipo_juros,cd_tipo_juro",
            ],

            //Providos manualmente pelos usuários
            "vl_valor" => ["required", "numeric", "between:0,9999999.99"],
            "ic_pago" => ["required"],
            "ic_status" => ["required"],
            "nm_registro" => ["required", "min:4", "max:50"],
            "dt_pagamento" => ["nullable", "date"],
            "qt_parcelas" => ["nullable", "integer", "gt:0"],
            "qt_parcelas_pagas" => ["nullable", "integer", "gt:0"],
            "ds_descricao" => ["nullable", "max:255"],
            "pc_taxa_juros" => ["nullable", "numeric", "between:0,999.999"],
            "qt_meses_incidencia" => ["nullable", "integer", "min:0", "max:99"],
        ]);

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
