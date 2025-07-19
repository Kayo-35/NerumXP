<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;

class Localizacao extends Model
{
    //Definições básicas
    protected $table = "localizacao";
    protected $primaryKey = "cd_localizacao";
    public $timestamps = false;

    protected $fillable = ["nm_localizacao"];
    //Relacionamentos
    public function registro_fixo() {
        return $this->hasMany(RegistroFixo::class,"cd_localizacao","cd_localizacao");
    }
    public function registro_flutuante() {
        return $this->hasMany(RegistroFlutuante::class,"cd_localizacao","cd_localizacao");
    }
}
