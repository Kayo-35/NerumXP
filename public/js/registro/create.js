//Obtem o acionador para registro flutuante
let acionador = document.getElementById("acionador");

//Obtem o item da legenda de modalidade
let legenda = document.getElementById("legenda");

let modalidade = document.getElementById("modalidade");
//Obtem o elemento que contém todas as seções de dados para um registro flutuante
let flutuanteSection = document.getElementById("flutuante");

//Obtem o conjunto de campos de entrada de dados para flutuante
let campos = document.querySelectorAll(".Flutuante");

//Mediante click exibir ou não a seção
acionador.addEventListener("click", function () {
    //Verifica o estado atual da seção e o inverte
    if (flutuanteSection.style.display == "none") {
        modalidade.value = 2; //define modalidade Flutuante
        legenda.innerHTML = "Flutuante";
        flutuanteSection.style.display = "block";
        campos.forEach(function (campo) {
            campo.disabled = false;
        });
    } else {
        //Reseta o valor de todos os campos caso o usuário desista
        modalidade.value = 1; //define modalidade Flutuante
        campos.forEach(function (campo) {
            campo.value = "";
            campo.disabled = true;
        });
        flutuanteSection.style.display = "none";
    }
});

//Se a página for recarregada resetar o estado do botão
document.addEventListener("DOMContentLoaded", function () {
    //Tive de pesquisar por IA como previnir tal comportamento, para previnir o mesmo na primeira
    // requisição

    let modalidade = document.getElementById("modalidade");
    console.log(modalidade);
    const navigationEntry = performance.getEntriesByType("navigation")[0];
    if (
        navigationEntry &&
        (navigationEntry.type === "reload" ||
            navigationEntry.type === "back_foward")
    ) {
        modalidade.value = 1;
        acionador.checked = false;
        campos.forEach(function (campo) {
            campo.disabled = true;
        });
    }
});

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
