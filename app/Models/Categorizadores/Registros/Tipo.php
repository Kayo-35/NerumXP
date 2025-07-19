<?php

namespace App\Models\Categorizadores\Registros;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;

class Tipo extends Model
{
    //Definições básicas
    protected $table = "tipo_registro";
    protected $primarykey = "cd_tipo_registro";
    public $timestamps = false;

    protected $fillable = ["nm_tipo"];

    //Relacionamentos
    public function registro_fixo() {
        return $this->hasMany(RegistroFixo::class,"cd_tipo_registro","cd_tipo_registro");
    }
    public function registro_flutuante(){
        return $this->hasMany(RegistroFlutuante::class,"cd_tipo_registro","cd_tipo_registro");
    }
}
