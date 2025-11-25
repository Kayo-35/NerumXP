<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Metas;

class Objetivo extends Model
{
    protected $table = "objetivos_metas";
    protected $primaryKey = "cd_objetivo_meta";
    public $timestamps = true;

    protected $fillable = [
        'cd_meta',
        'ic_status',
        'ds_descricao',
        'dt_conclusao'
    ];
    //Relacionamentos
    public function metas()
    {
        return $this->belongsTo(Metas::class, 'cd_meta', 'cd_meta');
    }
}
