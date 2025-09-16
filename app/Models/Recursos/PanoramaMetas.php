<?php

namespace App\Models\Recursos;

use App\Models\Personas\User;
use Illuminate\Database\Eloquent\Model;

class PanoramaMetas extends Model
{
    protected $table = 'panorama_metas';
    protected $primaryKey = 'cd_panorama_metas';
    public $timestamps = true;

    //Relacionamentos
    public function usuario() {
        return $this->belongsTo(User::class,'cd_usuario','cd_usuario');
    }
}
