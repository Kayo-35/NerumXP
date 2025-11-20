<?php

namespace App\Http\Controllers;

use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Metas\Tipo_Meta;
use App\Models\Categorizadores\Registros\Modalidade;
use App\Models\Categorizadores\Gerais\Nivel_imp;
use App\Models\Recursos\Metas;
use App\Models\Recursos\Objetivo;
use App\Models\Recursos\Registro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MetaController extends Controller
{
    public function index()
    {
        //Obtem todas as metas associadas ao usuário
        $metas = Metas::where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->orderBy('cd_tipo_meta', 'desc')
            ->orderBy('cd_nivel_imp', 'desc')
            ->paginate(9);

        if (!empty($metas->all())) {
            $panorama = DB::select('CALL sp_panorama_metas(:cd_usuario)', [
                "cd_usuario" => Auth::user()->cd_usuario
            ])[0];
        }

        return view("meta.index", [
            "metas" => $metas,
            "panorama" => $panorama ?? []
        ]);
    }
    public function show(Metas $meta)
    {
        $this->authorize('use', $meta);
        //Exibe uma única meta
        $registrosMeta = $meta->registro()
            ->select(
                'registro.cd_registro',
                'registro.cd_nivel_imp',
                'nm_registro',
                'vl_valor',
                'cd_modalidade',
                'registro.created_at',
                'cd_categoria',
                'ic_pago'
            )
            ->get();
        if ($meta->cd_tipo_meta < 7) {
            $historico = $meta->historico()->get();
            return view("meta.show", [
                "meta" => $meta,
                "registrosMeta" => $registrosMeta,
                "historico" => $historico ?? []
            ]);
        } else {
            return view('meta.showGenerica', [
                "meta" => $meta,
                "numObjetivosConcluidos" => $meta->objetivos()->where('ic_status', 1)->count(),
                "numObjetivos" => $meta->objetivos()->count()
            ]);
        }
    }
    public function create(Request $request)
    {
        //tipos validos
        $tiposValidos = Tipo_Meta::pluck('cd_tipo_meta')->toArray();
        $tiposValidosString = implode(',', $tiposValidos);

        //Validando se a requisição para criação contém apenas os tipos
        try {
            $request->validate([
                'tipo' => ['sometimes', 'array'],
                'tipo.*' => ["in: $tiposValidosString"],
            ]);
        } catch (ValidationException) {
            throw ValidationException::withMessages([
                "tipos" => ['Tipos Invalidos'],
            ]);
        }

        //Verifica se a requisição é para uma meta genérica, se sim encaminha para a view direto
        $tipo = $this->metaGenerica($request->query('tipo'));
        $registros = $this->getRegistroMeta($request->query('tipo'));

        $tiposMeta = Tipo_Meta::whereIn('cd_tipo_meta', $request->query('tipo'))->get();
        $modalidadeRegistrosMeta = Modalidade::all();
        return view("meta.create", [
            "categorias" => Categoria::all(),
            "registros" => $registros,
            "tiposMeta" => $tiposMeta,
            "importancias" => Nivel_imp::all(),
            "modalidades" => $modalidadeRegistrosMeta,
            "tipo" => $tipo === true ? 1 : 0 //Indica que não é uma meta genérica
        ]);
    }

    public function store(Request $request)
    {
        $registros = [];
        $generica = false;

        //Validando os dados
        if ($request['cd_tipo_meta'] != '7') {
            $registros = !empty($request->registros)
                ? Registro::whereIn('cd_registro', $request->registros)->get()
                : [];

            foreach ($registros as $registro) {
                $this->authorize('use', $registro);
            }
            $validated = $request->validate(metaRules()); //para metas não genéricas
        } else {
            $request['objetivos'] = $this->processaCheckBoxes($request);
            $validated = $request->validate(metaGenericaRules()) ; //metas genéricas
            $generica = true;
        }

        $validated['cd_usuario'] = Auth::user()->cd_usuario; //Associando o usuário a meta
        $validated['ic_status'] = true; //Por padrão ativa quando criada :)
        $validated['ic_recorrente'] = false;

        //Criando a meta
        $meta = Metas::create($validated);

        if ($generica) {
            foreach ($validated['objetivos'] as $objetivo) {
                Objetivo::create([
                    'cd_meta' => $meta->cd_meta,
                    'ds_descricao' => $objetivo[0] ?? $objetivo[1],
                    'dt_conclusao' => array_key_first($objetivo) == 1 ? null : date('Y/m/d H:m:s'),
                    'ic_status' => array_key_first($objetivo) == 1 ? true : false
                    //Caso não haja check haveria um único elemento, chave 0
                ]);
            }
        } else {
            //Associando categorias e registros a meta
            $meta->categoria()->sync($request->categorias);
            $meta->registro()->sync($request->registros);
        }

        //Incluindo feedback
        $request->session()
            ->flash('criar_meta', $meta->cd_meta);

        return redirect(route('meta.index'));
    }

    public function edit(Metas $meta)
    {
        $this->authorize('use', $meta);
        $tipoMeta = $meta->tipo()->pluck('cd_tipo_meta')->first();
        $cdTipoGenerico = Tipo_Meta::where('nm_meta', '=', 'Metas Genéricas')
            ->pluck('cd_tipo_meta')
            ->first();

        if ($tipoMeta != $cdTipoGenerico) {
            //Obtem os codigos dos tipos de meta a serem inclusos no painel para edição
            $arrayTipos = match ($tipoMeta) {
                1, 2 => [1, 2], //O usuário pode alterar o tipo geral, mas não se é de renda ou despesa
                default => [3, 4, 5, 6],
            };

            $tiposMeta = Tipo_Meta::whereIn('cd_tipo_meta', $arrayTipos)->get();
            $registros =  Registro::select(
                'registro.cd_registro',
                'registro.cd_nivel_imp',
                'nm_registro',
                'vl_valor',
                'cd_modalidade',
                'registro.created_at',
                'cd_categoria',
                'ic_pago'
            )->where('cd_usuario', '=', Auth::user()->cd_usuario)
                ->where('cd_tipo_registro', '=', in_array(1, $arrayTipos) ? 1 : 2)->get();

            $registrosDaMeta = $meta->registro()->select(
                'registro.cd_registro',
                'registro.cd_nivel_imp',
                'nm_registro',
                'vl_valor',
                'cd_modalidade',
                'registro.created_at',
                'cd_categoria',
                'ic_pago'
            )
                ->get();
            return view('meta.edit', [
                "meta" => $meta,
                "categorias" => Categoria::all(),
                "registros" => $registros,
                "registrosDaMeta" => $registrosDaMeta,
                "tiposMeta" => $tiposMeta,
                "importancias" => Nivel_imp::all(),
                "modalidades" => Modalidade::all(),
                "tipo" => 0
            ]);
        }
        $objetivos = $meta->objetivos()
            ->get();
        return view('meta.edit', [
            "meta" => $meta,
            "objetivos" => $objetivos ?? [],
            "importancias" => Nivel_imp::all(),
            "tipo" => 1
        ]);
    }

    public function update(Metas $meta, Request $request)
    {
        //Autorização
        $this->authorize('use', $meta); //Autoriza a usar a meta

        $cdTipoGenerico = Tipo_Meta::where('nm_meta', '=', 'Metas Genéricas')
            ->pluck('cd_tipo_meta')
            ->first();

        if ($meta->cd_tipo_meta != $cdTipoGenerico) {
            $registros = !empty($request->registros) ?
                Registro::whereIn('cd_registro', $request->registros)->get() : [];
            foreach ($registros as $registro) { //Autoriza a vincular os registros com a meta
                $this->authorize('use', $registro);
            }
            $validated = $request->validate(metaRules());

            //Atualizand a meta
            $meta->update($validated);
            $meta->registro()->sync($registros);
            $meta->categoria()->sync($validated['categorias']);
        } else {
            //Obtem apenas os objetivos enviados
            $objetivosNoForm = array_filter($request->all(), fn ($valor) => is_array($valor));

            //Valida os dados
            $validated = $request->validate(metaGenericaRules());

            //Verifica se os objetivos enviados são realmente pertencentes a meta, senão eu aplico 403
            $this->autorizarObjetivos(array_column($objetivosNoForm, 'cd_objetivo_meta'), $meta->cd_meta);

            //Atualiza os metadados da meta
            $meta->update($validated);

            $objetivos = [];
            //Checar se houve alterações nos objetivos associados a meta, atualizando se necessário
            foreach ($objetivosNoForm as $objetivoNoForm) {
                $descricao = $objetivoNoForm[0] != 'on' ? $objetivoNoForm[0] : $objetivoNoForm[1];
                if (isset($objetivoNoForm['cd_objetivo_meta'])) {
                    $objetivoNaBase = Objetivo::find($objetivoNoForm['cd_objetivo_meta']);
                    $status = $objetivoNoForm[0] == 'on' ? 1 : 0;
                    $objetivoNaBase->update([
                        'ds_descricao' => $descricao,
                        'ic_status' => $status,
                        'dt_conclusao' => $status === 1 ? date('Y-m-d') : null
                    ]);
                } else {
                    $objetivo = Objetivo::create([
                        'cd_meta' => $meta->cd_meta,
                        'ds_descricao' => count($objetivoNoForm) > 1 ? $objetivoNoForm[1] : $objetivoNoForm[0],
                        'dt_conclusao' => count($objetivoNoForm) < 1 ? null : date('Y/m/d H:m:s'),
                        'ic_status' => count($objetivoNoForm) > 1 ? true : false
                    ]);

                    array_push($objetivos, $objetivo->cd_objetivo_meta);
                }
            }

            //Remove os objetivos que foram removidos no form
            $codigosPresentes = array_map(
                fn ($objetivo) => (int) $objetivo,
                array_column($objetivosNoForm, 'cd_objetivo_meta')
            );

            $codigosRemover = array_diff(
                $meta->objetivos()->pluck('cd_objetivo_meta')->toArray(),
                $codigosPresentes
            );

            $codigosRemover = array_diff($codigosRemover, $objetivos);

            if (!empty($codigosRemover)) {
                foreach ($codigosRemover as $codigo) {
                    $objetivo = Objetivo::find($codigo);
                    $objetivo->delete();
                }
            }
        }

        //Incluindo feedback
        $request->session()
            ->flash('atualizar_meta', $meta->cd_meta);

        //Redirecionando
        return redirect(route('meta.index'));
    }

    public function destroy(Metas $meta, Request $request)
    {
        $this->authorize("use", $meta);
        $meta->delete();

        //Incluindo feedback
        $request->session()
            ->flash('remover_meta', $meta->cd_meta);

        return redirect(route('meta.index'));
    }

    //Métodos helper
    private function metaGenerica(array $tipo): bool
    {
        $tipoGenerico = Tipo_Meta::where('nm_meta', '=', 'Metas genéricas')
            ->value('cd_tipo_meta');

        $tipo = $tipoGenerico == $tipo[0] ? true : false;
        return $tipo;
    }

    private function getRegistroMeta(array $tipo): Collection
    {
        $tipoRegistro = $tipo == [1, 2] ? 1 : 2;

        $registros = Registro::select(
            'registro.cd_registro',
            'registro.cd_nivel_imp',
            'nm_registro',
            'vl_valor',
            'cd_modalidade',
            'registro.created_at',
            'cd_categoria',
            'ic_pago'
        )->where('cd_tipo_registro', '=', $tipoRegistro)
            ->where('cd_usuario', '=', Auth::user()->cd_usuario)
            ->get();

        return $registros;
    }

    private function processaCheckBoxes(Request $request): array
    {
        $result = array_filter($request->all(), function ($valor) {
            if (is_array($valor)) {
                return $valor;
            };
        });
        $result = array_map(function ($obj) {
            if (count($obj) === 1) {
                return [false => $obj[0]];
            }
            return [true => $obj[1]];
        }, $result);
        return $result;
    }
    public function autorizarObjetivos(array $cdObjetivos, int $codigoMeta): void
    {
        foreach ($cdObjetivos as $codigo) {
            $objetivo = Objetivo::find($codigo);

            if ($objetivo->cd_meta != $codigoMeta) {
                abort(403, 'Ação não autorizada');
            }
        }
    }
}
