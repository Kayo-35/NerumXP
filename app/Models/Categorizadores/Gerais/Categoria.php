<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;
use App\Models\Recursos\Metas;

class Categoria extends Model
{
    //Definições básicas
    protected $table = "categoria";
    protected $primaryKey = "cd_categoria";
    public $timestamps = false;

    protected $fillable = ["nm_categoria"];
    //Relacionamentos
    public function registro()
    {
        return $this->hasMany(Registro::class, "cd_categoria", "cd_categoria");
    }
    public function metas()
    {
        return $this->belongsToMany(
            Metas::class,
            "metas_categoria",
            "cd_categoria",
            "cd_meta",
        )->withPivot("created_at", "updated_at");
    }
}
