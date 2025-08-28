<?php

namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;

class Localizacao extends Model
{
    //Definições básicas
    protected $table = "localizacao";
    protected $primaryKey = "cd_localizacao";
    public $timestamps = false;

    protected $fillable = ["nm_localizacao"];
    //Relacionamentos
    public function registro() {
        return $this->hasMany(Registro::class,"cd_localizacao","cd_localizacao");
    }
}
