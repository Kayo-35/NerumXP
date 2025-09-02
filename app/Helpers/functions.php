<?php
use App\Models\Recursos\Registro;
use Illuminate\Support\Facades\Auth;

function registroRules(): array
{
    return [
        //Provido por elemento implicitamente
        "cd_tipo_registro" => [
            "integer",
            "required",
            "exists:tipo_registro,cd_tipo_registro",
        ],
        "cd_modalidade" => [
            "nullable",
            "integer",
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
        "metodos" => ["nullable", "array"],
        "metodos.*" => ["integer", "min:1", "max:5"],
        "vl_valor" => ["required", "numeric", "between:0,9999999.99"],
        "ic_pago" => ["boolean"],
        "ic_status" => ["boolean"],
        "nm_registro" => ["required", "min:4", "max:50"],
        "dt_pagamento" => ["nullable", "date"],
        "qt_parcelas" => ["nullable", "integer", "gt:0"],
        "qt_parcelas_pagas" => ["nullable", "integer", "gt:0"],
        "ds_descricao" => ["nullable", "max:255"],
        "pc_taxa_juros" => ["nullable", "numeric", "between:0,999.999"],
        "qt_meses_incidencia" => ["nullable", "integer", "min:0", "max:99"],
    ];
}

function indexFiltersRules(): array
{
    return [
        "cd_tipo_registro" => [
            "nullable",
            "exists:tipo_registro,cd_tipo_registro",
        ],
        "modalidades" => ["nullable", "exists:modalidade,cd_modalidade"],
        "categorias" => ["nullable", "exists:categoria,cd_categoria"],
        "ic_pago" => ["nullable", "boolean"],
        "vl_valor_minimo" => ["nullable", "numeric", "between:0,9999999.99"],
        "dt_inicio" => ["nullable", "date"],
        "dt_fim" => ["nullable", "date"],
        "nivel_imp" => ["nullable", "array"],
        "modalidade" => ["nullable", "integer"],
    ];
}

function indexQuery(array $filters): object
{
    //Construindo a consulta
    $registros = Registro::where("cd_usuario", Auth::user()->cd_usuario);
    //Renda ou Despesa
    if (isset($filters["cd_tipo_registro"])) {
        $registros = Registro::where(
            "cd_tipo_registro",
            "=",
            $filters["cd_tipo_registro"],
        );
    }
    //Pago ou não
    if (isset($filters["ic_pago"])) {
        $registros = $registros->where("ic_pago", "=", $filters["ic_pago"]);
    }

    //Modalidade, acabei esquecendo hahaha :)
    if (isset($filters["modalidades"])) {
        $registros = $registros->where(
            "cd_modalidade",
            "=",
            $filters["modalidades"],
        );
    }

    //Pago ou não
    if (isset($filters["ic_status"])) {
        $registros = $registros->where("ic_status", "=", $filters["ic_status"]);
    }
    //Valor monetário
    if (isset($filters["vl_valor_minimo"])) {
        $registros = $registros->where(
            "vl_valor",
            ">=",
            $filters["vl_valor_minimo"],
        );
    }
    //Datas
    if (isset($filters["dt_inicio"]) && isset($filters["dt_fim"])) {
        $registros = $registros->whereBetween("created_at", [
            $filters["dt_inicio"],
            $filters["dt_fim"],
        ]);
    } elseif (isset($filters["dt_inicio"])) {
        $registros = $registros->where(
            "created_at",
            ">=",
            $filters["dt_inicio"],
        );
    } elseif (isset($filters["dt_fim"])) {
        $registros = $registros->where("created_at", "<=", $filters["dt_fim"]);
    }

    if (!empty($filters["categorias"])) {
        //Arrays
        $registros = $registros->whereIn(
            "cd_categoria",
            $filters["categorias"],
        );
    }
    if (!empty($filters["nivel_imp"])) {
        $registros = $registros->whereIn("cd_nivel_imp", $filters["nivel_imp"]);
    }
    $registros = $registros
        ->orderBy("cd_nivel_imp", "desc")
        ->orderBy("nm_registro", "asc")
        ->get();

    return $registros;
}
