<?php

namespace App\Models\Categorizadores\Pagamento;

use App\Models\Recursos\Registro;
use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    //Definições básicas
    protected $table = "metodo_pagamento";
    protected $primaryKey = "cd_metodo";
    public $timestamps = false;

    protected $fillable = ["nm_metodo"];
    //Relacionamentos
    public function registro()
    {
        return $this->belongsToMany(
            Registro::class,
            "registro_metodoPagamento",
            "cd_metodo",
            "cd_registro",
        )->withPivot("created_at", "updated_at");
    }
}
