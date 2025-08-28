<?php
namespace App\Models\Categorizadores\Gerais;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Metas;
use App\Models\Recursos\Registro;

class Nivel_imp extends Model
{
    //Definições básicas
    protected $table = "nivel_imp";
    protected $primaryKey = "cd_nivel_imp";
    public $timestamps = false;

    protected $fillable = ["sg_nivel_imp"];

    //Relacionamentos
    public function metas()
    {
        return $this->hasMany(Metas::class, "cd_nivel_imp", "cd_nivel_imp");
    }
    public function registro()
    {
        return $this->hasMany(Registro::class, "cd_nivel_imp", "cd_nivel_imp");
    }
}
