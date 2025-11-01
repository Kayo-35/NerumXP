document.addEventListener('DOMContentLoaded', () => {
    let checkBoxes = document.querySelectorAll('input[type="checkbox"]')
    checkBoxes.forEach((checkBox) => {
        checkBox.addEventListener('input', () => {
            atribuiCheck(checkBox);
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
    checkBoxes.forEach((checkBox) => {
        atribuiCheck(checkBox);
    });
}
