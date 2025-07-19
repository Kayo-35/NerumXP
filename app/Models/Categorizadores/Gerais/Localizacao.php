<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    //Definições básicas
    protected $table = "localizacao";
    protected $primaryKey = "cd_localizacao";
    public $timestamps = false;

    protected $fillable = ["nm_localizacao"];
    //Relacionamentos
    public function registro_fixo() {
        $this->hasMany("registro_fixo","cd_localizacao","cd_localizacao");
    }
}
