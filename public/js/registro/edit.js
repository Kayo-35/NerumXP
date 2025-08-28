//Obtem o acionador para registro flutuante
let acionador = document.getElementById("acionador");

//Obtem o elemento que contém todas as seções de dados para um registro flutuante
let flutuanteSection = document.getElementById("flutuante");

//Obtem o conjunto de campos de entrada de dados para flutuante
let campos = document.querySelectorAll(".Flutuante");

visibility();

//Mediante click exibir ou não a seção
acionador.addEventListener("change", function () {
    //Verifica o estado atual da seção e o inverte
    if (this.checked) {
        flutuanteSection.style.display = "block";
    } else {
        //Reseta o valor de todos os campos caso o usuário desista
        campos.forEach(function (campo) {
            campo.value = "";
        });
        flutuanteSection.style.display = "none";
    }
});

function visibility() {
    if (acionador.checked) {
        flutuanteSection.style.display = "block";
    } else {
        flutuanteSection.style.display = "hidden";
    }
}
