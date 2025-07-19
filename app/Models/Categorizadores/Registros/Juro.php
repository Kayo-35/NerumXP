<?php

namespace App\Models\Categorizadores\Registros;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\RegistroFlutuante;

class Juro extends Model
{
    //Definições básicas
    protected $table = "registro_tipo_juros";
    protected $primarykey = "cd_tipo_juro";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_juro"];

    public function registro_flutuante() {
        return $this->hasMany(RegistroFlutuante::class,"cd_tipo_juro","cd_tipo_juro");
    }
}
