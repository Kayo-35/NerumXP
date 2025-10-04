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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Registro extends Model
{
    use HasFactory;
    //Definições básicas
    protected $table = "registro";
    protected $primaryKey = "cd_registro";
    public $timestamps = false; //Apenas em período de testes!!!
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
        "updated_at"
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

    //Métodos de Consulta


    static function indexQuery(array $filters): object
    {
        //Construindo a consulta
        $registros = Registro::where("cd_usuario", '=', Auth::user()->cd_usuario);
        //Renda ou Despesa
        if (isset($filters["cd_tipo_registro"])) {
            $registros->where(
                "cd_tipo_registro",
                "=",
                $filters["cd_tipo_registro"],
            );
        }
        //Pago ou não
        if (isset($filters["ic_pago"])) {
            $registros->where("ic_pago", "=", $filters["ic_pago"]);
        }

        //Modalidade, acabei esquecendo hahaha :)
        if (isset($filters["modalidades"])) {
            $registros->where(
                "cd_modalidade",
                "=",
                $filters["modalidades"],
            );
        }

        //Pago ou não
        if (isset($filters["ic_status"])) {
            $registros->where("ic_status", "=", $filters["ic_status"]);
        }

        //Valor monetário
        if (isset($filters["vl_valor_minimo"])) {
            $registros->where(
                "vl_valor",
                ">=",
                $filters["vl_valor_minimo"],
            );
        }
        //Datas
        if (isset($filters["dt_inicio"]) && isset($filters["dt_fim"])) {
            $registros->whereBetween("created_at", [
                $filters["dt_inicio"],
                $filters["dt_fim"],
            ]);
        } elseif (isset($filters["dt_inicio"])) {
            $registros->where(
                "created_at",
                ">=",
                $filters["dt_inicio"],
            );
        } elseif (isset($filters["dt_fim"])) {
            $registros->where("created_at", "<=", $filters["dt_fim"]);
        }

        if (!empty($filters["categorias"])) {
            //Arrays
            $registros->whereIn(
                "cd_categoria",
                $filters["categorias"],
            );
        }
        if (!empty($filters["nivel_imp"])) {
            $registros->whereIn("cd_nivel_imp", $filters["nivel_imp"]);
        }
        $registros->orderBy("ic_status", "desc")
            ->orderBy("cd_nivel_imp", "desc")
            ->orderBy("nm_registro", "asc");

        return $registros->get();
    }

    public static function relatorioTotalPorCategoria(int $tipoRegistro, string $ano): array
    {
        $dados = DB::table('registro AS r')
            ->join('categoria AS c', 'r.cd_categoria', '=', 'c.cd_categoria')
            ->select(
                'c.nm_categoria',
                DB::raw('SUM(r.vl_valor) AS total')
            )
            ->where('r.cd_tipo_registro', '=', $tipoRegistro)
            ->where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->whereYear('created_at', $ano)
            ->groupBy('c.nm_categoria')
            ->get();

        $resultado = $dados->mapWithKeys(fn($categoria) => [$categoria->nm_categoria => $categoria->total]);
        return $resultado->all();
    }

    public static function relatorioTotalPorMes(int $tipoRegistro, string $ano): array
    {
        $dados = DB::table('registro AS r')
            ->select(
                DB::raw('MONTH(r.created_at) as ordemMes'),
                DB::raw('MONTHNAME(r.created_at) as mes'),
                DB::raw('SUM(r.vl_valor) as totalMensal')
            )->where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->where('cd_tipo_registro', '=', $tipoRegistro)
            ->whereYear('created_at', $ano)
            ->groupBy('mes', 'ordemMes')
            ->orderBy('ordemMes', 'asc')
            ->get();

        $resultado = $dados->mapWithKeys(fn($mes) => [ucfirst($mes->mes) => (float) $mes->totalMensal])->all();

        $meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $resultado = array_map(function ($mes) use ($resultado) {
            return array_key_exists($mes, $resultado) ? [$mes => $resultado[$mes]] : [$mes => 0];
        }, $meses);

        $final = [];
        foreach($resultado as $data) {
            foreach($data as $mes => $valor) {
                $final[$mes] = $valor;
            }
        }
        return $final;
    }
}
