<?php

namespace App\Models\Conta;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personas\User;

class Assinatura extends Model
{
    //Definições básicas
    protected $table = "assinatura";
    protected $primaryKey = "cd_assinatura";
    public $timestamps = false;

    protected $fillable = ["nm_assinatura"];
    //Relacionamentos
    public function usuario() {
        return $this->hasMany(User::class,"cd_assinatura","cd_assinatura");
    }
}
