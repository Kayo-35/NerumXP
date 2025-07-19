<?php

namespace App\Models\Personas;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;

class Realizador extends Model
{
    //Definições básicas
    protected $table = "realizador_transacao";
    protected $primaryKey = "cd_realizador";
    public $timestamps = false;

    protected $fillable = ["nm_realizador", "ds_realizador"];
    //Relacionamentos
    public function registro_fixo() {
        return $this->hasMany(RegistroFixo::class,"cd_realizador","cd_realizador");
    }
    public function registro_flutuante() {
        return $this->hasMany(RegistroFlutuante::class,"cd_realizador","cd_realizador");
    }
}
