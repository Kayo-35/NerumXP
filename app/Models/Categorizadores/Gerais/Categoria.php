<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Definições básicas
    protected $table = "categoria";
    protected $primarykey = "cd_categoria";
    public $timestamps = false;

    protected $fillable = ["nm_categoria"];
}
