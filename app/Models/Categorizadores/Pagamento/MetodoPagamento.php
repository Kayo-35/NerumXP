<?php

namespace App\Models\Categorizadores\Pagamento;

use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    //Definições básicas
    protected $table = "metodo_pagamento";
    protected $primaryKey = "nm_tipo_metodo";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_metodo"];
}
