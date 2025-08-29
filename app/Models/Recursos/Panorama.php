<?php

namespace App\Models\Recursos;

use App\Models\Personas\User;
use Illuminate\Database\Eloquent\Model;

class Panorama extends Model
{
    //Definições básicas
    protected $table = "panorama";
    protected $primayKey = "cd_resumo";

    //Relacionamentos
    public function usuario() {
        return $this->belongsTo(User::class,"cd_usuario","cd_usuario");
    }
}
