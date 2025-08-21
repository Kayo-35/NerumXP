<x-layout>
    <section id="painelCards" class="mx-5 mt-5">
        <div class="row">
            @empty($registros)
                <div class="container">
                    <h1>Nada a ser exibido...</h1>
                </div>
            @else
                @foreach($registros as $registro)
                <a href="{{ route('registroFixo.show',["registroFixo" => $registro->cd_registro_fixo]) }}"
                    class="col-md-4"
                    style="text-decoration: none">
                    <x-registro.card
                        :id="$registro->cd_registro_fixo"
                        :title="$registro->nm_registroFixo"
                        :type="$registro->cd_tipo_registro"
                        :pago="$registro->ic_pago"
                        :icon="$registro->cd_categoria"
                        :stars="$registro->cd_nivel_imp"
                        :valor="$registro->vl_valor"
                        :dtCriado="$registro->created_at->format('d/m/Y H:i:s')"
                        :dtAtualizado="$registro->updated_at->format('d/m/Y H:i:s')"
                    >
                    </x-registro.card>
                </a>
                @endforeach
            @endempty
            <!-- Paginação com bootstrap-->
            <div>
                {{ $registros->links() }}
            </div>
        </div>
    </section>
</x-layout>
