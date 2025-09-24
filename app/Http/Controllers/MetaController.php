<?php

namespace App\Http\Controllers;

use App\Models\Categorizadores\Gerais\Categoria;
use App\Models\Categorizadores\Metas\Tipo_Meta;
use App\Models\Categorizadores\Registros\Modalidade;
use App\Models\Recursos\Metas;
use App\Models\Recursos\Registro;
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
            ->orderBy('cd_nivel_imp', 'desc')
            ->paginate(9);
        $panorama = DB::select('CALL sp_panorama_metas(:cd_usuario)', [
            "cd_usuario" => Auth::user()->cd_usuario
        ])[0];
        return view("meta.index", [
            "metas" => $metas,
            "panorama" => $panorama
        ]);
    }
    public function show(Metas $meta)
    {
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
        return view("meta.show", [
            "meta" => $meta,
            "registrosMeta" => $registrosMeta
        ]);
    }
    public function create(Request $request)
    {
        //tipos validos
        $tiposValidos = Tipo_Meta::pluck('cd_tipo_meta')->toArray();
        $tiposValidosString = implode(',', $tiposValidos);

        //Validando se a requisição para criação contém apenas os tipos
        try {
            $validated = $request->validate([
                'tipo' => ['sometimes', 'array'],
                'tipo.*' => ["in: $tiposValidosString"],
            ]);
        } catch (ValidationException) {
            throw ValidationException::withMessages([
                "tipos" => ['Tipos Invalidos'],
            ]);
        }

        $tipoRegistro = $request->query('tipo') == [1,2] ? 1 : 2;

        $registros = Registro::select(
            'registro.cd_registro',
            'registro.cd_nivel_imp',
            'nm_registro',
            'vl_valor',
            'cd_modalidade',
            'registro.created_at',
            'cd_categoria',
            'ic_pago'
        )->where('cd_tipo_registro','=',$tipoRegistro)
        ->where('cd_usuario','=',Auth::user()->cd_usuario)
        ->get();

        $tiposMeta = Tipo_Meta::whereIn('cd_tipo_meta',$request->query('tipo'))->get();
        $modalidadeRegistrosMeta = Modalidade::all();
        return view("meta.create",[
            "categorias" => Categoria::all(),
            "registros" => $registros,
            "tiposMeta" => $tiposMeta,
            "modalidades" => $modalidadeRegistrosMeta
        ]);
    }

    public function store(Request $request) {
        $registros = !empty($request->registros) ? Registro::whereIn('cd_registro',$request->registros)->get() : [];
        foreach($registros as $registro) {
            $this->authorize('use',$registro);
            //$this representa a instância do controller, como um helper
        }
        //Validando os dados
        $validated = $request->validate(metaRules());
        $validated['cd_usuario'] = Auth::user()->cd_usuario; //Associando o usuário a meta
        $validated['ic_status'] = true; //Por padrão ativa quando criada :)
        $validated['ic_recorrente'] = false;

        //Criando a meta
        $meta = Metas::create($validated);

        //Associando categorias e registros a meta
        $meta->categoria()->sync($request->categorias);
        $meta->registro()->sync($request->registros);

        return redirect(route('meta.show',["meta" => $meta]));
    }

    public function edit(Metas $meta) {}

    public function update(Metas $meta, Request $request) {}

    public function destroy(Metas $meta) {
        $this->authorize("use",$meta);
        $meta->delete();
        return redirect(route('meta.index'));
    }
}
