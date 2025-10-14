<?php

namespace App\Models\Categorizadores\Metas;

use App\Models\Recursos\Metas;
use Illuminate\Database\Eloquent\Model;

class Tipo_Meta extends Model
{
    //Propriedades básicas
    protected $table = 'tipo_metas';
    protected $primaryKey = 'cd_tipo_meta';
    public $timestamps = false;

    //Relacionamentos
    public function meta()
    {
        return $this->hasMany(
            Metas::class,
            'cd_tipo_meta',
            'cd_tipo_meta'
        );
    }
}
