<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class Realizador extends Model
{
    //Definições básicas
    protected $table = "realizador_transacao";
    protected $primarykey = "cd_realizador";
    public $timestamps = false;

    protected $fillable = ["nm_realizador", "ds_realizador"];
}
