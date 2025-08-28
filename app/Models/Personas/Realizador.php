<?php

namespace App\Models\Personas;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;

class Realizador extends Model
{
    //Definições básicas
    protected $table = "realizador_transacao";
    protected $primaryKey = "cd_realizador";
    public $timestamps = false;

    protected $fillable = ["nm_realizador", "ds_realizador"];
    //Relacionamentos
    public function registro()
    {
        return $this->hasMany(
            Registro::class,
            "cd_realizador",
            "cd_realizador",
        );
    }
}
