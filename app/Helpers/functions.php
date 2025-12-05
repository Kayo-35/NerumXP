<?php

use App\Models\Recursos\Registro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Categorizadores\Gerais\Categoria;

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
        "cd_forma_pagamento" => [
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
        "dt_vencimento" => [
            "nullable",
            "date",
        ],

        //Providos manualmente pelos usuários
        "metodos" => ["nullable", "array"],
        "metodos.*" => ["integer", "min:1", "max:7"],
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
function metaRules(): array
{
    return [
        "nm_meta" => [
            "required",
            "min:4",
            "max:50"
        ],
        "registros" => [
            "nullable",
            "array",
        ],
        "cd_tipo_meta" => [
            "required",
            "integer",
            "exists:tipo_metas,cd_tipo_meta"
        ],
        "cd_nivel_imp" => [
            "required",
            "integer",
            "exists:nivel_imp,cd_nivel_imp"
        ],
        "cd_modalidade" => [
            "required",
            "integer",
            "exists:modalidade,cd_modalidade"
        ],
        "categorias" => [
            "required",
            "array"
        ],
        "categorias.*" => [
            Rule::in(Categoria::pluck('cd_categoria')->toArray())
        ],
        "vl_valor_meta" => [
            "nullable",
            "numeric",
            "between:0,9999999.99"
        ],
        "pc_meta" => [
            "nullable",
            "numeric",
            "between:0,99.999"
        ],
        "dt_termino" => [
            "required",
            "date",
        ],
        "ds_descricao" => [
            "nullable",
            "max:65535"
        ]
    ];
}

function metaGenericaRules(): array
{
    return [
        "nm_meta" => [
            "required",
            "min:4",
            "max:50"
        ],
        "cd_nivel_imp" => [
            "required",
            "integer",
            "exists:nivel_imp,cd_nivel_imp"
        ],
        "cd_tipo_meta" => [
            "required",
            "integer",
            "exists:tipo_metas,cd_tipo_meta"
        ],
        "dt_termino" => [
            "required",
            "date",
            Rule::date()->after(today()),
        ],
        "ds_descricao" => [
            "nullable",
            "string",
            "max:65535"
        ],
        "objetivos" => [
            "nullable",
            "array"
        ],
        "objetivos.*" => [
            "array",
        ],
        "objetivos.*.*" => [
            "string",
            "max: 255"
        ]
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
        "ic_status" => ["nullable", "boolean"],
        "vl_valor_minimo" => ["nullable", "numeric", "between:0,9999999.99"],
        "dt_inicio" => ["nullable", "date"],
        "dt_fim" => ["nullable", "date"],
        "nivel_imp" => ["nullable", "array"],
        "modalidade" => ["nullable", "integer"],
    ];
}

function saudacao(): string
{
    $horario = date('H:i:s');

    if ($horario >= '05:00:00' && $horario < '12:00:00') {
        return 'Bom dia, ';
    } elseif ($horario >= '12:00:00' && $horario < '18:00:00') {
        return 'Boa tarde, ';
    } else {
        return 'Boa noite, ';
    }
}

function emojiSaudacao(): string
{
    $horario = date('H:i:s');

    if ($horario >= '05:00:00' && $horario < '12:00:00') {
        return ' ☀️';
    } elseif ($horario >= '12:00:00' && $horario < '18:00:00') {
        return ' 🌅';
    } else {
        return ' 🌙';
    }
}
