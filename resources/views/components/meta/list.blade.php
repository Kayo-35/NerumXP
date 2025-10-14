@props([
"meta",
"id",
])
<div class="accordion-item">
    <h2 class="accordion-header">
        <button
            class="accordion-button"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="{{ "#$id" }}">
            <div class="d-flex align-items-center w-100">
                @if ($meta->cd_tipo_meta == 1 || $meta->cd_tipo_meta == 2)
                    <div class="category-icon revenue-bg text-white me-3">
                        <i class="bi bi-arrow-up-circle"></i>
                    </div>
                @else
                    <div class="category-icon expense-bg text-white me-3">
                        <i class="bi bi-arrow-down-circle"></i>
                    </div>
                @endif
                <div class="flex-grow-1">
                    <div class="fw-bold">
                        {{ $meta->nm_meta }}
                    </div>
                    <div class="urgency-stars">
                        @for ($i = 0; $i < $meta->cd_nivel_imp; $i++)
                            <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                </div>
                <div class="text-end m-2">
                    @foreach ($meta->categoria()->get() as $categoria)
                        <x-helper.categoria
                            class="text-primary-emphasis"
                            cdCategoria="{{ $categoria->cd_categoria }}"></x-helper.categoria>
                    @endforeach
                </div>
            </div>
        </button>
    </h2>
    <div
        id="{{ $id }}"
        class="accordion-collapse collapse {{ $id == "goal0" ? "show" : "" }}"
        data-bs-parent="#goalsAccordion">
        <div class="accordion-body">
            <div class="row g-3">
                <div class="col-12">
                    @isset($meta->vl_valor_meta)
                        <h6 class="text-secondary">
                            Meta: R$
                            {{ str_replace(".", ",", $meta->vl_valor_meta) }}
                        </h6>
                        <h6 class="text-secondary">
                            Atual: R$
                            {{ str_replace(".", ",", $meta->vl_valor_progresso) }}
                        </h6>
                        <div class="progress mb-3">
                            <div
                                class="progress-bar bg-primary"
                                style="
                                    width: {{ number_format(($meta->vl_valor_progresso / $meta->vl_valor_meta) * 100) . "%" }};
                                    "></div>
                        </div>
                    @else
                        <h6 class="text-secondary">
                            Meta: {{ number_format($meta->pc_meta, 2) }}% do
                            total
                        </h6>
                        <h6 class="text-secondary">
                            Atual: {{ number_format($meta->pc_progresso, 2) }}%
                            alcançados
                        </h6>
                        <div class="progress mb-3">
                            <div
                                class="progress-bar bg-primary"
                                style="
                                        width: {{ number_format($meta->pc_progresso) }}%;
                                    "></div>
                        </div>
                    @endisset
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2 shadow-sm" href="{{ route('meta.show',["meta" => $meta->cd_meta]) }}">
                          <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10" style="width:2.2rem; height:2.2rem;">
                            <i class="bi bi-eye text-primary fs-5"></i>
                          </span>
                          <span>Ver detalhes</span>
                        </a>
                        <a class="btn btn-outline-warning btn-sm d-flex align-items-center gap-2 shadow-sm" href="{{ route('meta.edit', ["meta" => $meta->cd_meta]) }}">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10" style="width:2.2rem; height:2.2rem;">
                                <i class="bi bi-pencil text-warning fs-5"></i>
                            </span>
                            <span>Editar</span>
                        </a>
                        <form method="POST" action="{{ route('meta.destroy',["meta" => $meta] )}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-2 shadow-sm">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10" style="width:2.2rem; height:2.2rem;">
                                <i class="bi bi-trash text-danger fs-5"></i>
                            </span>
                            <span>Excluir</span>
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-light">
                            <h6 class="mb-0">Registros Associados:</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($meta->registro()->get() as $registro)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center">
                                <a
                                    class="link-secondary"
                                    href="{{ route("registro.show", $registro) }}">
                                    <div>
                                        @if ($registro->cd_tipo_registro == 2)
                                        <i
                                            class="bi bi-x-circle text-danger me-2"></i>
                                        @else
                                        <i
                                            class="bi bi-check-circle text-success me-2"></i>
                                        @endif
                                        {{ $registro->nm_registro }}
                                    </div>
                                </a>
                                <span class="badge bg-primary rounded-pill">
                                    R$
                                    {{ str_replace(".", ",", $registro->vl_valor) }}
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
