<?php

namespace App\Models\Categorizadores\Pagamento;

use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    //Definições básicas
    protected $table = "forma_pagamento";
    protected $primaryKey = "cd_tipo_forma";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_metodo"];
}
