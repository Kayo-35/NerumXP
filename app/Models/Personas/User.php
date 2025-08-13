<?php

namespace App\Models\Personas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\Models\Conta\Assinatura;
use App\Models\Recursos\Panorama;
use App\Models\Recursos\RegistroFixo;
use App\Models\Recursos\RegistroFlutuante;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

    //Definições básicas
    protected $table = "usuario";
    protected $primaryKey = "cd_usuario";

    protected $fillable = [
        "cd_assinatura",
        "nm_usuario",
        "dt_nascimento",
    ];

    //Relacionamentos
    public function assinatura() {
        return $this->belongsTo(Assinatura::class,"cd_assinatura","cd_assinatura");
    }
    public function registro_fixo() {
        return $this->hasMany(RegistroFixo::class,"cd_usuario","cd_usuario");
    }
    public function registro_flutuante() {
        return $this->hasMany(RegistroFlutuante::class,"cd_usuario","cd_usuario");
    }
    public function resumoGeral() {
        return $this->hasMany(Panorama::class,"cd_usuario","cd_usuario");
    }
}
