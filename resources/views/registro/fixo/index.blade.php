<x-layout>
    <section id="painelCards" class="mx-5 mt-2">
        <div class="row">
            @foreach($registros as $registro)
                <div class="col-md-4 col-sm-12 mt-4 mb-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5>{{ $registro['nm_registroFixo'] }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $registro['ds_descricao'] }}
                            </p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            Extras...
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layout>
