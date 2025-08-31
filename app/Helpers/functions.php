<?php

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
        "metodos" => ['nullable','array'],
        "metodos.*" => ['integer','min:1','max:5'],
        "vl_valor" => ["required", "numeric", "between:0,9999999.99"],
        "ic_pago" => ["integer",'between:0,1'],
        "ic_status" => ["integer","between:0,1"],
        "nm_registro" => ["required", "min:4", "max:50"],
        "dt_pagamento" => ["nullable", "date"],
        "qt_parcelas" => ["nullable", "integer", "gt:0"],
        "qt_parcelas_pagas" => ["nullable", "integer", "gt:0"],
        "ds_descricao" => ["nullable", "max:255"],
        "pc_taxa_juros" => ["nullable", "numeric", "between:0,999.999"],
        "qt_meses_incidencia" => ["nullable", "integer", "min:0", "max:99"],
    ];
}
