<?php

namespace App\Models\Conta;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    //Definições básicas
    protected $table = "assinatura";
    protected $primarykey = "cd_assinatura";
    public $timestamps = false;

    protected $fillable = ["nm_assinatura"];
}
