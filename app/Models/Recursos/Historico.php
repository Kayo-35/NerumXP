<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    //Definições básicas
    protected $table = "historico";
    protected $primaryKey = "cd_historico";

    //Relacionamentos
    public function registro_fixo() {
        $this->belongsTo("registro_fixo","cd_registro_fixo","cd_registro_fixo");
    }
    public function registro_flutuante() {
        $this->belongsTo("registro_flutuante","cd_registro_flutuante","cd_registro_flutuante");
    }
    public function tipo_historico() {
        $this->belongsTo("tipo_historico","cd_tipo_historico","cd_tipo_historico");
    }
}
