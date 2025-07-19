<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //Definições básicas
    protected $table = "usuario";
    protected $primaryKey = "cd_usuario";

    protected $fillable = [
        "cd_assinatura",
        "nm_usuario",
        "dt_nascimento",

    ];

    //Relacionamentos
    public function assinatura() {
        $this->belongsTo("assinatura","cd_assinatura","cd_assinatura");
    }
    public function registro_fixo() {
        $this->hasMany("registro_fixo","cd_usuairo","cd_usuario");
    }
    public function registro_flutuante() {
        $this->hasMany("registro_flutuante","cd_usuario","cd_usuario");
    }
    public function resumoGeral() {
        $this->hasMany("resumoGeral","cd_usuario","cd_usuario");
    }
}
