<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;

class Tipo_historico extends Model
{
    //Definições básicas
    protected $table = "tipo_historico";
    protected $primarykey = "cd_tipo_historico";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_historico"];
}
