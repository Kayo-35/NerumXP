<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;

class Realizador extends Model
{
    //Definições básicas
    protected $table = "realizador_transacao";
    protected $primaryKey = "cd_realizador";
    public $timestamps = false;

    protected $fillable = ["nm_realizador", "ds_realizador"];
    //Relacionamentos
    public function registro_fixo() {
        $this->hasMany("registro_fixo","cd_realizador","cd_realizador");
    }
}
