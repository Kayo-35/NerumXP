<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{
    //Definições básicas
    protected $table = "projeto";
    protected $primaryKey = "cd_projeto";
    public $timestamps = false;

    protected $fillable = ["ds_tema_projeto"];
}
