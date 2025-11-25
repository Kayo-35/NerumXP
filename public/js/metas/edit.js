//Acionador para inclusão dos campos de valor
const seletorTipoValorMeta = document.querySelector("#cd_tipo_meta");
//Estrutura html
//Elemento parente
const painelInsereValor = document.querySelector("#seletorValor");

//Elementos a serem adicionados condicionalmente
function painelPercentual() {
    return `
        <label for="pc_meta" class="form-label fw-semibold">
            <i class="bi bi-percent text-secondary me-1"></i>
            Percentual da Meta (%)
        </label>
        <div class="input-group">
            <input type="number" class="form-control" id="pc_meta" name="pc_meta"
                step="0.001" min="0" max="100" placeholder="0,000" value="${valorMeta}">
                <span class="input-group-text">%</span>
        </div>
    `;
}

function painelValorFixo() {
    return `
        <label for="vl_valor_meta" class="form-label fw-semibold">
            <i class="bi bi-currency-dollar text-secondary me-1"></i>
            Valor da Meta (R$)
        </label>
        <div class="input-group">
            <span class="input-group-text">R$</span>
            <input type="number" class="form-control" id="vl_valor_meta" name="vl_valor_meta"
                step="0.001" min="0" placeholder="0,000" value="${valorMeta}">
        </div>
    `;
}

function painelDefault() {
    return `
        <label for="pc_meta" class="form-label text-danger fw-semibold">
            <i class="bi bi-question me-1"></i>
            Selecione o tipo da meta!
        </label>
        <div class="input-group text-center">
            <p class="form-control fs-6 fst-italic">
                Permite definir se associada a uma valor fixo ou percentual
            </p>
        </div>
    `;
}

function resumoRegistro(
    id,
    titulo,
    categoria,
    valor,
    createdAt,
    checked = null,
) {
    return `
    <div class="list-group-item border-0 px-0">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input registro-checkbox" type="checkbox"
                            value="${id}" id="${id}" name="registros[]" ${checked}>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                        <i class="bi bi-arrow-up-circle text-success"></i>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 id="titulo" class="mb-1">
                                ${titulo}
                            </h6>
                            <small id="categoria" class="text-secondary">
                                <i class="bi ${categoria} fs-4"></i>
                            </small>
                        </div>
                        <div class="text-end">
                            <h6 id="valor" class="text-success mb-0">
                                R$ ${valor}
                            </h6>
                            <small id="dtCriado" class="text-secondary">
                                ${createdAt}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function getCategoriaIcon(codigo) {
    switch (codigo) {
        case 1:
            return "bi-basket-fill";
        case 2:
            return "bi-car-front-fill";
        case 3:
            return "bi-house-fill";
        case 4:
            return "bi-heart-fill";
        case 5:
            return "bi-mortarboard-fill";
        case 6:
            return "bi-sunglasses";
        case 7:
            return "bi-cash-stack";
        case 8:
            return "bi-graph-up-arrow";
        case 9:
        default:
            return "bi-three-dots";
    }
}

let painel;
const tiposFixos = ["1", "2", "3", "4"];
const tiposPercentual = ["5", "6"];

seletorTipoValorMeta.addEventListener("change", () => {
    check();
});

function check() {
    if (tiposFixos.includes(seletorTipoValorMeta.value)) {
        painel = painelValorFixo();
    } else if (tiposPercentual.includes(seletorTipoValorMeta.value)) {
        painel = painelPercentual();
    } else {
        painel = painelDefault();
    }
    painelInsereValor.innerHTML = painel;
    painelValor(tipoMeta);
}

window.onload = check;

function painelValor(codigo) {
    if (tiposFixos.includes(codigo.toString())) {
        painel = painelValorFixo();
    } else if (tiposPercentual.includes(codigo.toString())) {
        painel = painelPercentual();
    } else {
        painel = painelDefault();
    }
    painelInsereValor.innerHTML = painel;
}

document.addEventListener("DOMContentLoaded", () => {
    //Exibição dos registros
    const seletorModalidade = document.getElementById("cd_modalidade");
    const painelRegistros = document.querySelector("#painelRegistros");

    //Exibição da quantidade de registros selecionadas
    const mostradorQuantidadeGeral = document.querySelector("#contadorGeral");
    const mostradorQuantidadeSelecionada = document.querySelector(
        "#contadorSelecionados",
    );

    //Botão para seleção total
    const seletorCheckTodos = document.querySelector("#btnSelecionarTodos");
    const removerCheckTodos = document.querySelector("#btnDesmarcarTodos");
    let registrosNoPainel = document.querySelectorAll(".registro-checkbox");

    function displayQuantidadeChecked() {
        if (registrosNoPainel !== undefined) {
            qtRegistrosSelecionados = Array.from(registrosNoPainel).filter(
                (registro) => registro.checked === true,
            ).length;
            mostradorQuantidadeSelecionada.innerHTML = qtRegistrosSelecionados;
        }
        registrosNoPainel = document.querySelectorAll(".registro-checkbox");
    }

    seletorCheckTodos.addEventListener("click", (registrosNoPainel) => {
        registrosNoPainel = document.querySelectorAll(".registro-checkbox");
        registrosNoPainel = Array.from(registrosNoPainel);
        if (painelRegistros.childElementCount > 0) {
            registrosNoPainel.forEach((registro) => {
                registro.checked = true;
            });
        }
        displayQuantidadeChecked();
    });

    registrosNoPainel.forEach((registro) => {
        registro.addEventListener("change", (reg) => {
            displayQuantidadeChecked();
        });
    });

    removerCheckTodos.addEventListener("click", () => {
        registrosNoPainel = document.querySelectorAll(".registro-checkbox");
        registrosNoPainel = Array.from(registrosNoPainel);
        if (painelRegistros.childElementCount > 0) {
            registrosNoPainel.forEach((registro) => {
                registro.checked = false;
            });
        }
        displayQuantidadeChecked();
    });

    let categoriasSelecionadas = [];

    //painel de categorias
    const painelCategoria = document.querySelectorAll(
        ".accordion-body div input",
    );

    /*
        Esse painel representa o seletor de categorias de registros, contendo multiplas chechboxes, se
        nenhuma for selecionada por padrão a lista de registros é filtrada apenas pela modalidade. Caso
        contrário também pela categoria
    */
    painelCategoria.forEach((categoria) => {
        //Adicionei o evento a todas as categorias
        categoria.addEventListener("input", () => {
            //Change verifica a cada vez que o valor da mesma se altera
            if (categoria.checked) {
                categoriasSelecionadas.push(categoria.value); //Inclui a categoria no array
            } else {
                //Retira a categoria que não estiver mais selecionada
                categoriasSelecionadas = categoriasSelecionadas.filter(
                    (categoriaPresente) =>
                        categoriaPresente !== categoria.value,
                );
            }
            updateRegistroArray(seletorModalidade.value); //Atualizo o array que armazena os objetos(registros) a serem exibidos
            addRegistros(); //Essa função é para adicionar os registros no painel
        });
    });

    seletorModalidade.addEventListener("change", () => {
        let registrosNoPainel = document.querySelectorAll(".registro-checkbox");
        if (seletorModalidade.value.length == 0) {
            init(true);
        } else {
            init(false);
        }
        updateRegistroArray(seletorModalidade.value);
        addRegistros();
        displayQuantidadeChecked(registrosNoPainel);
    });

    let registrosFiltrados = [];

    function init(mode) {
        painelInsereValor.innerHTML = painel;
        painelCategoria.forEach((categoria) => {
            categoria.disabled = mode;
        });
        displayQuantidadeChecked();
    }

    function updateRegistroArray(modalidade) {
        //Registros vem da template blade, minha IDE por exemplo, acha que é um valor indefinido por isso
        registrosFiltrados = registros.filter((registro) => {
            if (categoriasSelecionadas.length > 0 && registro.cd_categoria != null) {
                return registro.cd_modalidade == modalidade &&
                    categoriasSelecionadas.includes(
                        registro.cd_categoria != null ? registro.cd_categoria.toString() : 'teste',
                    )
            }
            //Caso contrário apenas filtre por modalidade
            return registro.cd_modalidade.toString() == modalidade;
        });
    }

    function addRegistros() {
        painelRegistros.innerHTML = "";
        console.log(registrosFiltrados);
        registrosFiltrados.forEach((registro) => {
            let checkRegistro = document.createElement("div");
            checkRegistro.innerHTML = resumoRegistro(
                registro.cd_registro,
                registro.nm_registro,
                getCategoriaIcon(registro.cd_categoria),
                registro.vl_valor,
                registro.created_at.split("T")[0],
            );
            painelRegistros.appendChild(checkRegistro);
        });
        mostradorQuantidadeGeral.innerHTML = painelRegistros.childElementCount;

        registrosNoPainel = document.querySelectorAll(".registro-checkbox");

        //Marca todos aqueles que estão selecionados e define que a função contador seja sempre acionada mediante clique
        registrosNoPainel.forEach((registro) => {
            if (registrosDaMeta.some((regMeta) => registro.value == regMeta))
                registro.checked = true;

            registro.addEventListener("input", () => {
                displayQuantidadeChecked();
            });
        });

        /*Reeordena os registros
            Essa era a minha abordagem, eu removia todos os elementos selecionados, depois os recriava para então os inserir no topo, bem complexo
            e consumia muitos recursos. Então aprendir que insertBefore permite manipular elementos já existentes no DOM
            selecionados.forEach(selecionado => selecionado.parentNode.parentNode.parentNode.parentNode.parentNode.remove());
                selecionados.forEach(selecionado => {
                    let registroSelecionado = registros.filter(registro => registro.cd_registro == selecionado.id);
                    let icon = getCategoriaIcon(registroSelecionado.cd_categoria);
                    let registroAInserir = resumoRegistro(registroSelecionado[0].cd_registro, registroSelecionado[0].nm_registro,icon, registroSelecionado[0].vl_valor, registroSelecionado[0].created_at.slice(0,registroSelecionado[0].created_at.indexOf('T')),'checked');
                    let div = document.createElement('div');
                    div.innerHTML = registroAInserir;
                    painelRegistros.insertBefore(div, painelRegistros.firstChild);
                });
        */
        let selecionados = Array.from(registrosNoPainel).filter(
            (registro) => registro.checked === true,
        );
        selecionados.forEach((selecionado) =>
            selecionado.parentNode.parentNode.parentNode.parentNode.parentNode.remove(),
        );
        selecionados.forEach((selecionado) => {
            painelRegistros.insertBefore(
                selecionado.parentNode.parentNode.parentNode.parentNode
                    .parentNode,
                painelRegistros.firstChild,
            );
        });
    }

    function checkCategoriasSelecionadas(painelCategoria) {
        painelCategoria.forEach((categoria) => {
            if (categoria.checked) {
                categoriasSelecionadas.push(categoria.value);
            } else {
                categoriasSelecionadas = categoriasSelecionadas.filter(
                    (categoriaPresente) =>
                        categoriaPresente !== categoria.value,
                );
            }
        });
    }
    /*
         Essas linhas executam as função de filtragem quando há recararregamento de página,
         já que o eventos meio que não são acionados sem "mundaças" de estado.
     */
    //Esse condicional serve para contabilizar categorias já inseridas quando há recarregamento
    if (categoriasSelecionadas.length == 0) {
        checkCategoriasSelecionadas(painelCategoria);
    }

    updateRegistroArray(seletorModalidade.value);
    addRegistros();
    if (seletorModalidade.value == "") init(true);
    else init(false); //Passei quase uma hora para verificar que bastando trocar a ordem os valores que eu precisava surgiriam
});
