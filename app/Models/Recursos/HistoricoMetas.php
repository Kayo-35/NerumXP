<?php

namespace App\Models\Recursos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Metas;

class HistoricoMetas extends Model
{
    protected $table = 'historico_metas';
    protected $primaryKey = 'cd_historico_meta';
    public $timestamps = false;

    //Relacionamentos
    public function meta()
    {
        return $this->belongsTo(
            Metas::class,
            'cd_meta',
            'cd_meta'
        );
    }
}
