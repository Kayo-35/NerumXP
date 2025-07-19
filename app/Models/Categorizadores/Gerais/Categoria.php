<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //Definições básicas
    protected $table = "categoria";
    protected $primaryKey = "cd_categoria";
    public $timestamps = false;

    protected $fillable = ["nm_categoria"];
    //Relacionamentos
    public function registro_fixo() {
        $this->hasMany("registro_fixo","cd_categoria","cd_categoria");
    }
}
