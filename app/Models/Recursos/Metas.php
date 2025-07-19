<?php

namespace App\Models\Recursos;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{
    protected $table = "metas";
    protected $primaryKey = "cd_metas";

    protected $fillable = (
    [
        "cd_nivel_imp",
        "nm_meta",
        "dt_meta_criacao",
        "dt_termino",
        "ic_status",
        "ds_descricao",
    ]
    );

    public function nivel_imp() {
        return $this->belongsTo(Nivel_imp::class,"cd_nivel_imp","cd_nivel_imp");
    }
}
