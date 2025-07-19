<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\RegistroFixo;

class Categoria extends Model
{
    //Definições básicas
    protected $table = "categoria";
    protected $primaryKey = "cd_categoria";
    public $timestamps = false;

    protected $fillable = ["nm_categoria"];
    //Relacionamentos
    public function registro_fixo() {
        return $this->hasMany(RegistroFixo::class,"cd_categoria","cd_categoria");
    }
}
