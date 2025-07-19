<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;

class Panorama extends Model
{
    //Definições básicas
    protected $table = "resumoGeral";
    protected $primayKey = "cd_resumo";

    //Relacionamentos
    public function usuario() {
        $this->belongsTo("usuario","cd_usuario","cd_usuario");
    }
}
