<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    //Definições básicas
    protected $table = "localizacao";
    protected $primarykey = "cd_localizacao";
    public $timestamps = false;

    protected $fillable = ["nm_localizacao"];
}
