//Obtem o acionador para registro flutuante
let acionador = document.getElementById("acionador");
let legenda = document.getElementById("legenda");
//Obtem o elemento que contém todas as seções de dados para um registro flutuante
let flutuanteSection = document.getElementById("flutuante");
let modalidade = document.getElementById("modalidade");
//Obtem o conjunto de campos de entrada de dados para flutuante
let campos = document.querySelectorAll(".Flutuante");

visibility();

//Mediante click exibir ou não a seção
acionador.addEventListener("change", function () {
    //Verifica o estado atual da seção e o inverte
    if (this.checked) {
        flutuanteSection.style.display = "block";
        legenda.innerHTML = "Flutuante";
        modalidade.value = 2;
    } else {
        //Reseta o valor de todos os campos caso o usuário desista
        campos.forEach(function (campo) {
            campo.value = "";
        });
        modalidade.value = 1;
        flutuanteSection.style.display = "none";
    }
});

function visibility() {
    if (acionador.checked) {
        flutuanteSection.style.display = "block";
    } else {
        flutuanteSection.style.display = "hidden";
    }

    const select = document.getElementById("tipoRegistro");
    const header = document.getElementById("cardHeader");

    select.addEventListener("change", function () {
        // Remove qualquer gradiente anterior
        header.classList.remove("gradient-renda", "gradient-despesa");

        if (this.value === "1") {
            // Renda → azul-esverdeado
            header.classList.add("gradient-renda");
        } else if (this.value === "2") {
            // Despesa → laranja-vermelho
            header.classList.add("gradient-despesa");
        }
        // Se nenhuma opção, volta ao branco
    });
}
