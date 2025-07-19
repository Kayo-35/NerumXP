<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;
use App\Models\Categorizadores\Gerais\Tipo_historico;
class Historico extends Model
{
    //Definições básicas
    protected $table = "historico";
    protected $primaryKey = "cd_historico";

    //Relacionamentos
    public function registro_fixo() {
        return $this->belongsTo(RegistroFixo::class,"cd_registro_fixo","cd_registro_fixo");
    }
    public function registro_flutuante() {
        return $this->belongsTo(RegistroFlutuante::class,"cd_registro_flutuante","cd_registro_flutuante");
    }
    public function tipo_historico() {
        return $this->belongsTo(Tipo_historico::class,"cd_tipo_historico","cd_tipo_historico");
    }
}
