<?php

namespace App\Models\Recursos;
use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Gerais\Localizacao;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Categorizadores\Pagamento\FormaPagamento;
use App\Models\Categorizadores\Pagamento\MetodoPagamento;
use App\Models\Categorizadores\Registros\Tipo;
use App\Models\Personas\Realizador;
use App\Models\Personas\User;
use App\Models\Recursos\Historico;
use App\Models\Recursos\Metas;
use Illuminate\Database\Eloquent\Model;

class RegistroFixo extends Model
{
    //Definições básicas
    protected $table = "registro_fixo";
    protected $primaryKey = "cd_registro_fixo";

    protected $fillable = [
        "cd_usuario",
        "cd_tipo_registro",
        "cd_nivel_imp",
        "cd_categoria",
        "cd_localizacao",
        "cd_realizador",

        "nm_registro_fixo",
        "vl_valor",
        "ic_pago",
        "ic_status",
        "dt_pagamento",
        "ds_descricao",
        "qt_parcelas",
        "qt_parcelas_pagas",
    ];
    //Relacionamentos
    public function usuario() {
        return $this->belongsTo(User::class,"cd_usuario","cd_usuario");
    }
    public function tipo() {
        return $this->belongsTo(Tipo::class,"cd_tipo_registro","cd_tipo_registro");
    }
    public function nivel_imp() {
        return $this->belongsTo(Nivel_imp::class,"cd_nivel_imp","cd_nivel_imp");
    }
    public function categoria() {
        return $this->belongsTo(Categoria::class,"cd_categoria","cd_categoria");
    }
    public function localizacao(){
        return $this->belongsTo(Localizacao::class,"cd_localizacao","cd_localizacao");
    }
    public function realizador() {
        return $this->belongsTo(Realizador::class,"cd_realizador","cd_realizador");
    }
    public function historico() {
        return $this->hasMany(Historico::class,"cd_registro_fixo","cd_registro_fixo");
    }
    //M:M
    public function metas() {
        return $this->belongsToMany(Metas::class,"metas_reg_fixo","cd_registro_fixo","cd_metas")
            ->withPivot("created_at","updated_at");
    }
    public function metodo_pagamento() {
        return $this->belongsToMany(MetodoPagamento::class,"registro_fix_metodoP","cd_registro_fixo","cd_tipo_metodo")
            ->withPivot("created_at","updated_at");
    }
    public function forma_pagamento() {
        return $this->belongsToMany(FormaPagamento::class,"registro_fix_tipoP","cd_registro_fixo","cd_tipo_forma")
            ->withPivot("created_at","updated_at");
    }
}
