<?php

namespace App\Models\Personas;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Conta\Assinatura;
use App\Models\Recursos\Metas;
use App\Models\Recursos\Panorama;
use App\Models\Recursos\PanoramaMetas;
use App\Models\Recursos\Registro;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;
    //Definições básicas
    protected $table = "usuario";
    protected $primaryKey = "cd_usuario";

    protected $fillable = [
        "cd_assinatura",
        "nm_usuario",
        "email",
        "password",
        "dt_nascimento",
        "ic_mostrar_meta_arquivada",
        "ic_mostrar_registro_arquivado",
        "ic_alerta_meta",
        "ic_alerta_registro",
        "dt_ano_relatorio"
    ];

    protected $casts = [
        'dt_nascimento' => 'date',
    ];

    //Relacionamentos
    public function assinatura()
    {
        return $this->belongsTo(Assinatura::class, "cd_assinatura", "cd_assinatura");
    }
    public function registro()
    {
        return $this->hasMany(Registro::class, "cd_usuario", "cd_usuario");
    }
    public function meta()
    {
        return $this->hasMany(Metas::class, "cd_usuario", "cd_usuario");
    }
    public function resumoGeral()
    {
        return $this->hasMany(Panorama::class, "cd_usuario", "cd_usuario");
    }
    public function resumoMetas()
    {
        return $this->hasMany(PanoramaMetas::class, "cd_usuario", "cd_usuario");
    }

    //Casting: Valores booleanos
    protected $cast = [
        'ic_alerta_registro' => 'boolean',
        'ic_alerta_meta' => 'boolean',
        'ic_mostrar_registro_arquivado' => 'boolean',
        'ic_mostrar_meta_arquivada' => 'boolean',
    ];
}
