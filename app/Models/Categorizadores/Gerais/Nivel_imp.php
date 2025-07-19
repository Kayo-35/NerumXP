<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;

class Nivel_imp extends Model
{
    //Definições básicas
    protected $table = "nivel_imp";
    protected $primaryKey = "cd_nivel_imp";
    public $timestamps = false;

    protected $fillable = ["sg_nivel_imp"];

    //Relacionamentos
    public function metas() {
        $this->hasMany("metas","cd_nivel_imp","cd_nivel_imp");
    }
    public function registro_fixo() {
        $this->hasMany("registro_fixo","cd_nivel_imp","cd_nivel_imp");
    }
}
