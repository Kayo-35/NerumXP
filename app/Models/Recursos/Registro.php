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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorizadores\Registros\Juro;
use App\Models\Categorizadores\Registros\Modalidade;

class Registro extends Model
{
    use HasFactory;
    //Definições básicas
    protected $table = "registro";
    protected $primaryKey = "cd_registro";
    public $timestamps = true; //Apenas em período de testes!!!
    protected $fillable = [
        "cd_usuario",
        "cd_tipo_registro",
        "cd_modalidade",
        "cd_forma_pagamento",
        "cd_nivel_imp",
        "cd_categoria",
        "cd_localizacao",
        "cd_realizador",
        "cd_tipo_juro",

        "nm_registro",
        "qt_meses_incidencia",
        "pc_taxa_juros",
        "vl_valor",
        "ic_pago",
        "ic_status",
        "dt_pagamento",
        "ds_descricao",
        "qt_parcelas",
        "qt_parcelas_pagas",
    ];
    //Relacionamentos
    public function usuario()
    {
        return $this->belongsTo(User::class, "cd_usuario", "cd_usuario");
    }
    public function tipo()
    {
        return $this->belongsTo(
            Tipo::class,
            "cd_tipo_registro",
            "cd_tipo_registro",
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
    public function categoria()
    {
        return $this->belongsTo(
            Categoria::class,
            "cd_categoria",
            "cd_categoria",
        );
    }
    public function localizacao()
    {
        return $this->belongsTo(
            Localizacao::class,
            "cd_localizacao",
            "cd_localizacao",
        );
    }
    public function realizador()
    {
        return $this->belongsTo(
            Realizador::class,
            "cd_realizador",
            "cd_realizador",
        );
    }
    public function forma_pagamento()
    {
        return $this->belongsTo(
            FormaPagamento::class,
            "cd_forma_pagamento",
            "cd_forma",
        );
    }
    public function historico()
    {
        return $this->hasMany(Historico::class, "cd_registro", "cd_registro");
    }
    //M:M
    public function metas()
    {
        return $this->belongsToMany(
            Metas::class,
            "metas_registro",
            "cd_registro",
            "cd_metas",
        )->withPivot("created_at", "updated_at");
    }
    public function metodo_pagamento()
    {
        return $this->belongsToMany(
            MetodoPagamento::class,
            "registro_metodoPagamento",
            "cd_registro",
            "cd_metodo",
        )->withPivot("created_at", "updated_at");
    }
    public function modalidade()
    {
        return $this->belongsTo(
            Modalidade::class,
            "cd_modalidade",
            "cd_modalidade",
        );
    }
    public function juro()
    {
        return $this->belongsTo(Juro::class, "cd_tipo_juro", "cd_tipo_juro");
    }
}
