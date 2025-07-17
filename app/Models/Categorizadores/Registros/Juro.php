<?php

namespace App\Models\Categorizadores\Registros;

use Illuminate\Database\Eloquent\Model;

class Juro extends Model
{
    //Definições básicas
    protected $table = "registro_tipo_juros";
    protected $primarykey = "cd_tipo_juro";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_juro"];
}
