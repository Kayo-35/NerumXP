<?php

namespace App\Models\Recursos;

use App\Models\Categorizadores\Gerais\Nivel_imp;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recursos\Registro;
use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Metas\Tipo_Meta;
use App\Models\Personas\User;
use App\Models\Recursos\HistoricoMetas;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metas extends Model
{
    use HasFactory;

    protected $table = "metas";
    protected $primaryKey = "cd_meta";

    protected $fillable = [
        "cd_nivel_imp",
        "cd_usuario",
        "cd_modalidade",
        "cd_tipo_meta",

        "ic_recorrente",
        "ic_finalizada",
        "ic_status",

        "vl_valor_meta",
        "vl_valor_progresso",
        "pc_meta",
        "pc_progresso",
        "nm_meta",
        "dt_termino",
        "ds_descricao",
    ];

    public function usuario()
    {
        return $this->belongsTo(
            User::class,
            "cd_usuario",
            "cd_usuario"
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
    public function registro()
    {
        return $this->belongsToMany(
            Registro::class,
            "metas_registro",
            "cd_meta",
            "cd_registro",
        )->withPivot("created_at", "updated_at");
    }
    public function categoria()
    {
        return $this->belongsToMany(
            Categoria::class,
            "metas_categoria",
            "cd_meta",
            "cd_categoria",
        )->withPivot("created_at", "updated_at");
    }
    public function tipo()
    {
        return $this->belongsTo(
            Tipo_Meta::class,
            'cd_tipo_meta',
            'cd_tipo_meta'
        );
    }
    public function historico()
    {
        return $this->hasMany(
            HistoricoMetas::class,
            'cd_meta',
            'cd_meta'
        );
    }
    public function objetivos()
    {
        return $this->hasMany(
            Objetivo::class,
            'cd_meta',
            'cd_meta'
        );
    }

    //Métodos helper
    // O primeiro método é destinado a facilitar a construção de relatórios
    // do historico de metas, capturando apenas a entrada mais recente,
    // devido a natureza de como os gatilhos da base trabalham ele é
    // necessário.
    public function relatorioHistorico(Metas $meta): array
    {
        $historico = $meta
                ->historico()
                ->select('cd_historico_meta', 'updated_at')
                ->groupBy('cd_historico_meta', 'updated_at')
                ->orderBy('cd_historico_meta', 'desc')
                ->get()
                ->toArray();

        /*
        * array_column: retorna um array de todos os momentos das entradas;
        * array_map: converte todas as timestamps para datas básicas.
        * array_unique: remove duplicatas de dias
        */
        $momentos = array_unique(array_map(function ($entrada) {
            return date('d/m/Y', strtotime($entrada));
        }, array_column($historico, 'updated_at')));

        //Array para armazenar todas as entradas mais recentes de cada dia
        $entradas_final = [];

        /*
        * Percorre cada momento, obtem todas as entradas do dia e retorna a mais recente
        * com max(da qual avalia valores numéricos pertencentes)
        */
        foreach ($momentos as $momento) {
            $entradas_do_dia = array_filter($historico, function ($registro) use ($momento) {
                if (date('d/m/Y', strtotime($registro['updated_at'])) === $momento) {
                    return $registro;
                }
            });
            $entradas_final[$momento] = max($entradas_do_dia);
        }

        //Obtem os dados das entradas de historico
        $resultado_final = [];
        foreach ($entradas_final as $resultado) {
            //Indica quals dados serão necessários para o relatório(varia conforme tipo)
            $dadosNecessarios = $meta->cd_tipo_meta < 5
                ? ["'vl_alvo'", "'vl_progresso'"]
                : ["'pc_alvo'", "'pc_progresso'"];

            if ($meta->cd_tipo_meta < 5) {
                $entrada = HistoricoMetas::select("vl_alvo", "vl_progresso", "updated_at");
            } else {
                $entrada = HistoricoMetas::select("pc_alvo", "pc_progresso", "updated_at");
            }

            $entrada = $entrada->where('cd_historico_meta', '=', $resultado['cd_historico_meta'])
                ->firstOrFail();

            $entrada->updated_at = date('d/m/Y', strtotime($entrada->updated_at));
            array_push($resultado_final, $entrada);
        }
        //Reverte de ordem decrescente para crscente, o natural para progressão.
        return array_reverse($resultado_final);
    }
}
