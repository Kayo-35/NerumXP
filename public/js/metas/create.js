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
                step="0.01" min="0" max="100" placeholder="0,00">
                <span class="input-group-text">%</span>
        </div>
    `
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
                step="0.01" min="0" placeholder="0,00">
        </div>
    `;
}

function resumoRegistro() {
    return `
    <div class="list-group-item border-0 px-0">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input registro-checkbox" type="checkbox"
                            value=" " id=" ">
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
                                Titulo
                            </h6>
                            <small id="categoria" class="text-secondary">
                                Categoria
                            </small>
                        </div>
                        <div class="text-end">
                            <h6 id="valor" class="text-success mb-0">
                                Valor
                            </h6>
                            <small id="dtCriado" class="text-secondary">
                                Created at
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

const tiposFixos = ['3', '4'];
const tiposPercentual = ['5', '6'];
let painel;

seletorTipoValorMeta.addEventListener('change', () => {
    if (tiposFixos.includes(seletorTipoValorMeta.value)) {
        painel = painelValorFixo();
    } else if (tiposPercentual.includes(seletorTipoValorMeta.value)) {
        painel = painelPercentual();
    }
    painelInsereValor.innerHTML = painel;
});


//Exibição dos registros
const seletorModalidade = document.getElementById('cd_modalidade');
const painelRegistros = document.querySelector("#painelRegistros");
let resumoRegistroElemento;

let registrosFiltrados = [];
seletorModalidade.addEventListener('change', () => {
    registrosFiltrados = registros.filter((registro) => registro.cd_modalidade.toString() == seletorModalidade.value);

    resumoRegistroElemento = resumoRegistro();
    if (registrosFiltrados.length != 0) {
        console.table(registrosFiltrados);
    }
});
