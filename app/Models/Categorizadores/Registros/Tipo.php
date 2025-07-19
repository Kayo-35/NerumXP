<?php

namespace App\Models\Categorizadores\Registros;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    //Definições básicas
    protected $table = "tipo_registro";
    protected $primarykey = "cd_tipo_registro";
    public $timestamps = false;

    protected $fillable = ["nm_tipo"];

    //Relacionamentos
    public function registro_fixo() {
        $this->hasMany("registro_fixo","cd_tipo_registro","cd_tipo_registro");
    }
}
