<?php
namespace App\Models\Recursos;
use App\Models\Recursos\Projetos;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;

class Metas extends Model
{
    protected $table = "metas";
    protected $primaryKey = "cd_metas";

    protected $fillable = [
        "cd_nivel_imp",
        "nm_meta",
        "cd_registro",
        "dt_meta_criacao",
        "dt_termino",
        "ic_status",
        "ds_descricao",
    ];

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
            "cd_metas",
            "cd_registro",
        )->withPivot("created_at", "updated_at");
    }
    public function projeto()
    {
        return $this->belongsToMany(
            Projetos::class,
            "metas_projeto",
            "cd_projeto",
            "cd_metas",
        );
    }
}
