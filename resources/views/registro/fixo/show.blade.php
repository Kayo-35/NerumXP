<x-layout>
    <div class="d-flex justify-content-center align-items-center flex-grow-5">
        <x-registro.card class="w-25"
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
    </div>
</x-layout>
