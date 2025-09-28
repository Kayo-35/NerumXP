<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;
use App\Models\Categorizadores\Gerais\Tipo_historico;

class Historico extends Model
{
    //Definições básicas
    protected $table = "historico";
    protected $primaryKey = "cd_historico";

    //Relacionamentos
    public function registro()
    {
        return $this->belongsTo(
            Registro::class,
            "cd_registro",
            "cd_registro",
        );
    }
}
