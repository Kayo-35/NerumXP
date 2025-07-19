<?php

namespace App\Models\Categorizadores\Pagamento;

use App\Models\Recursos\RegistroFlutuante;
use App\Models\Recursos\RegistroFixo;
use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    //Definições básicas
    protected $table = "metodo_pagamento";
    protected $primaryKey = "cd_tipo_metodo";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_metodo"];
    //Relacionamentos
    public function registro_flutuante() {
        return $this->belongsToMany(RegistroFlutuante::class,"registro_flut_metodoP","cd_tipo_metodo","cd_registro_flutuante")
            ->withPivot("created_at","updated_at");
    }
    public function registro_fixo() {
        return $this->belongsToMany(RegistroFixo::class,"registro_fix_metodoP","cd_tipo_metodo","cd_registro_fixo")
            ->withPivot("created_at","updated_at");
    }

}
