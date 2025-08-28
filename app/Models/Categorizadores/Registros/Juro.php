<?php

namespace App\Models\Categorizadores\Registros;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;

class Juro extends Model
{
    //Definições básicas
    protected $table = "registro_tipo_juros";
    protected $primarykey = "cd_tipo_juro";
    public $timestamps = false;

    protected $fillable = ["nm_tipo_juro"];

    public function registro()
    {
        return $this->hasMany(Registro::class, "cd_tipo_juro", "cd_tipo_juro");
    }
}
