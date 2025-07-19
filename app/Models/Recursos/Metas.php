<?php

namespace App\Models\Recursos;
use App\Models\Categorizadores\Gerais;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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
        $this->belongsTo("nivel_imp","cd_nivel_imp","cd_nivel_imp");
    }
}
