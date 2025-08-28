<?php

namespace App\Models\Categorizadores\Registros;

use App\Models\Recursos\Registro;
use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    //Definições báscicas
    protected $table = "modalidade";
    protected $primaryKey = "cd_modalidade";
    public $timestamps = false;

    //Relacionamento
    public function registro()
    {
        return $this->hasMany(
            Registro::class,
            "cd_modalidade",
            "cd_modalidade",
        );
    }
}
