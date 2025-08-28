//Obtem o acionador para registro flutuante
let acionador = document.getElementById('acionador');

//Obtem o elemento que contém todas as seções de dados para um registro flutuante
let flutuanteSection = document.getElementById('flutuante');

//Obtem o conjunto de campos de entrada de dados para flutuante
let campos = document.querySelectorAll('.Flutuante');

//Mediante click exibir ou não a seção
acionador.addEventListener('click', function() {
    //Verifica o estado atual da seção e o inverte
    if(flutuanteSection.style.display == 'none') {
        flutuanteSection.style.display = 'block';
    } else {
        //Reseta o valor de todos os campos caso o usuário desista
        campos.forEach(function(campo) {
            campo.value = '';
        });
        flutuanteSection.style.display = 'none';
    }
});

//Se a página for recarregada resetar o estado do botão
document.addEventListener('DOMContentLoaded', function () {
    //Tive de pesquisar por IA como previnir tal comportamento, para previnir o mesmo na primeira
    // requisição
    const navigationEntry = performance.getEntriesByType('navigation')[0];
    if(navigationEntry && (navigationEntry.type === 'reload' || navigationEntry.type === 'back_foward')) {
        acionador.checked = false;
    }
});
