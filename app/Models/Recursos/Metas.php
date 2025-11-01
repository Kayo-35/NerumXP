<?php

namespace App\Models\Recursos;

use App\Models\Categorizadores\Gerais\Nivel_imp;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;
use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Metas\Tipo_Meta;
use App\Models\Personas\User;
use App\Models\Recursos\HistoricoMetas;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metas extends Model
{
    use HasFactory;

    protected $table = "metas";
    protected $primaryKey = "cd_meta";

    protected $fillable = [
        "cd_nivel_imp",
        "cd_usuario",
        "cd_modalidade",
        "cd_tipo_meta",

        "ic_recorrente",
        "ic_finalizada",
        "ic_status",

        "vl_valor_meta",
        "vl_valor_progresso",
        "pc_meta",
        "pc_progresso",
        "nm_meta",
        "dt_termino",
        "ds_descricao",
    ];

    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            "cd_usuario",
            "cd_usuario"
        );
    }
    public function nivel_imp()
    {
        return $this->belongsTo(
            Nivel_imp::class,
            "cd_nivel_imp",
            "cd_nivel_imp",
        );
    }
    public function registro()
    {
        return $this->belongsToMany(
            Registro::class,
            "metas_registro",
            "cd_meta",
            "cd_registro",
        )->withPivot("created_at", "updated_at");
    }
    public function categoria()
    {
        return $this->belongsToMany(
            Categoria::class,
            "metas_categoria",
            "cd_meta",
            "cd_categoria",
        )->withPivot("created_at", "updated_at");
    }
    public function tipo()
    {
        return $this->belongsTo(
            Tipo_Meta::class,
            'cd_tipo_meta',
            'cd_tipo_meta'
        );
    }
    public function historico()
    {
        return $this->hasMany(
            HistoricoMetas::class,
            'cd_meta',
            'cd_meta'
        );
    }
    public function objetivos()
    {
        return $this->hasMany(
            Objetivo::class,
            'cd_meta',
            'cd_meta'
        );
    }
}
