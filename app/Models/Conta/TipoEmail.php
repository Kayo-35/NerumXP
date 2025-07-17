<?php

namespace App\Models\Conta;

use Illuminate\Database\Eloquent\Model;

class TipoEmail extends Model
{
    //Definições básicas
    protected $table = "tipo_email";
    protected $primarykey = "cd_tipo_email";
    public $timestamps = false;

    protected $fillable = ["sg_tipo_email"];
}
