document.addEventListener('DOMContentLoaded', () => {
    let adicionaObjetivo = document.querySelector('#adicionaObjetivo');

    //Util para requisições de atualização
    let secaoObjetivos = document.querySelector('#secaoObj');
    let objetivos = secaoObjetivos.querySelectorAll('input[type="checkbox"]');
    if (objetivos.length > 0) {
        removeObjetivos();
    }

    //Responsável por criar novas seções para objetivos
    adicionaObjetivo.addEventListener('click', () => {
        let secaoObjetivo = document.querySelector('#secaoObj');
        numeroDeObjetivos = secaoObjetivo.querySelectorAll('input[type="checkbox"]').length;
        novoObj = objetivoTemplate(numeroDeObjetivos + 1);
        secaoObjetivo.appendChild(novoObj);

        contabilizaObjetivos();

        let checkBox = novoObj.querySelector('input[type="checkbox"');
        checkBox.addEventListener('input', () => {
            atribuiCheck(checkBox)
        });
        init();
    });

    //Atribuir eventos para os botões de remoção
    adicionaObjetivo.addEventListener('click', () => {
        removeObjetivos();
        init();
    });

    function atribuiCheck(checkBox) {
        if (checkBox.checked) {
            checkBox.value = 'on';
        } else {
            checkBox.value = 'off';
        }
    }

    function contabilizaObjetivos() {
        let secaoObjetivo = document.querySelector('#secaoObj');
        let numObj = secaoObjetivo.querySelectorAll('input[type="checkbox"]').length;
        let objetivos = secaoObjetivo.querySelectorAll('label');
        let buttons = secaoObjetivo.querySelectorAll('button');
        let setObj = secaoObjetivo.querySelectorAll(':scope > div');

        //Renumerando as legendas e ids
        for (let i = 0; i < numObj; i++) {
            setObj[i].id = `${i + 1}obj`;
            buttons[i].id = `remove${i + 1}`;
            objetivos[i].innerHTML = `Objetivo ${i + 1}`;
        }
    }

    function removeObjetivos() {
        let removeBotoes = document.querySelectorAll('[id^="remove"]');
        removeBotoes.forEach((removeObj, key) => {
            removeObj.addEventListener('click', () => {
                let objetivoRemover = removeObj.closest('[id$="obj"]');
                console.log(objetivoRemover);
                if (objetivoRemover != undefined) objetivoRemover.remove();
                contabilizaObjetivos();
            });
            return;
        });
    }

    function init() {
        let checkBoxes = document.querySelectorAll('input[type="checkbox"]')
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
                <button type="button" id="remove${numeroObjetivo}" class="btn btn-lg btn-outline-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;

        novoObj.id = `${numeroObjetivo}obj`;
        return novoObj;
    }
});
