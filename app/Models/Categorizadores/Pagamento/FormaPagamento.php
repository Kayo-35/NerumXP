<?php

namespace App\Models\Categorizadores\Pagamento;

use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    //Definições básicas
    protected $table = "forma_pagamento";
    protected $primaryKey = "cd_tipo_forma";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_metodo"];
    //Relacionamentos
    public function registro_flutuante()
    {
        return $this->belongsToMany(
            RegistroFlutuante::class,
            "registro_flut_tipoP",
            "cd_tipo_forma",
            "cd_registro_flutuante",
        )->withPivot("created_at", "updated_at");
    }
    public function registro_fixo()
    {
        return $this->belongsToMany(
            RegistroFixo::class,
            "registro_fix_tipoP",
            "cd_tipo_forma",
            "cd_registro_fixo",
        )->withPivot("created_at", "updated_at");
    }
}
