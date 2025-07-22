<?php

namespace App\Models\Recursos;
use App\Models\Recursos\Metas;
use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{
    //Definições básicas
    protected $table = "projeto";
    protected $primaryKey = "cd_projeto";
    public $timestamps = false;

    protected $fillable = ["ds_tema_projeto"];
    //Relacionamentos
    public function metas() {
        return $this->belongsToMany(Metas::class,"metas_projeto","cd_projeto","cd_metas");
    }
}
