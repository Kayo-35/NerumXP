<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;

class RegistroFixo extends Model
{
    //Definições básicas
    protected $table = "registro_fixo";
    protected $primaryKey = "cd_registro_fixo";

    protected $fillable = [
        "cd_usuario",
        "cd_tipo_registro",
        "cd_nivel_imp",
        "cd_categoria",
        "cd_localizacao",
        "cd_realizador",

        "nm_registro_fixo",
        "vl_valor",
        "ic_pago",
        "ic_status",
        "dt_pagamento",
        "ds_descricao",
        "qt_parcelas",
        "qt_parcelas_pagas",
    ];
    //Relacionamentos
    public function usuario() {
        $this->belongsTo("usuario","cd_usuario","cd_usuario");
    }
    public function tipo() {
        $this->belongsTo("tipo_registro","cd_tipo_registro","cd_tipo_registro");
    }
    public function nivel_imp() {
        $this->belongsTo("nivel_imp","cd_nivel_imp","cd_nivel_imp");
    }
    public function categoria() {
        $this->belongsTo("categoria","cd_categoria","cd_categoria");
    }
    public function localizacao(){
        $this->belongsTo("localizacao","cd_localizacao","cd_localizacao");
    }
    public function realizador() {
        $this->belongsTo("realizador","cd_realizador","cd_realizador");
    }
}
