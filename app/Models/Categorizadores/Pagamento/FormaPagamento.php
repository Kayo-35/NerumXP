<?php

namespace App\Models\Categorizadores\Pagamento;

use App\Models\Recursos\Registro;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    //Definições básicas
    protected $table = "forma_pagamento";
    protected $primaryKey = "cd_forma";
    public $timestamps = false;

    protected $fillable = ["nm_tipo"];
    //Relacionamentos
    public function registro()
    {
        return $this->hasMany(
            Registro::class,
            "cd_forma_pagamento",
            "cd_tipo_forma",
        );
    }
}
