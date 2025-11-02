document.addEventListener('DOMContentLoaded', () => {
    let adicionaObjetivo = document.querySelector('#adicionaObjetivo');

    //Atribui valor falso ao estado de checkboxes não submetidas a cada alteração de estado
    function atribuiEstadoCheck() {
        let checkBoxes = document.querySelectorAll('input[type="checkbox"]')
        checkBoxes.forEach((checkBox) => {
            checkBox.addEventListener('input', () => {
                atribuiCheck(checkBox);
            });
        });
    }

    //Responsável por renumerar as seções quando elementos forem removidos

    //Responsável por criar novas seções para objetivos
    adicionaObjetivo.addEventListener('click', () => {
        let secaoObjetivo = document.querySelector('#secaoObj');
        numeroDeObjetivos = document.querySelectorAll('input[type="checkbox"]').length;
        novoObj = objetivoTemplate(numeroDeObjetivos + 1);
        secaoObjetivo.appendChild(novoObj);
        init();
    });

    //Atribuir eventos para os botões de remoção
    adicionaObjetivo.addEventListener('click', () => {
        let removeBotoes = document.querySelectorAll('[id^="remove"]');
        removeBotoes.forEach((removeObj) => {
            removeObj.addEventListener('click', () => {
                numObj = removeObj.id.match(/\d+/)[0];
                let objetivoRemover = document.querySelector(`[id^='${numObj}']`);
                if (objetivoRemover != undefined) objetivoRemover.remove();
            });
        });
        init();
    });

    function atribuiCheck(checkBox) {
        if (!checkBox.checked) {
            checkBox.value = 'off';
        } else {
            checkBox.value = 'on';
        }
    }

    function init() {
        let checkBoxes = document.querySelectorAll('input[type="checkbox"]')
        console.log(checkBoxes);
        checkBoxes.forEach((checkBox) => {
            atribuiCheck(checkBox);
        });
    }

    function objetivoTemplate(numeroObjetivo) {
        let novoObj = document.createElement('div');
        novoObj.classList.add('row', 'd-flex', 'align-items-center');

        novoObj.innerHTML = `
            <div class="col-11">
                <div class="d-flex align-items-start mb-2">
                    <div class="form-check me-3 mt-1">
                        <input class="form-check-input" type="checkbox" name="objetivo${numeroObjetivo}[]">
                        <label class="form-check-label"></label>
                    </div>

                    <div class="flex-grow-1">
                        <label class="form-label fw-semibold text-dark mb-1">
                            Objetivo ${numeroObjetivo}
                        </label>
                        <input type="text" class="form-control d-inline w-100" name="objetivo${numeroObjetivo}[]">
                    </div>
                </div>
            </div>
            <div class="col-1 d-flex align-items-center">
                <button type="button" id="remove${numeroObjetivo} "class="btn btn-lg btn-outline-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;

        novoObj.id = `${numeroObjetivo}obj`;
        return novoObj;
    }
});
