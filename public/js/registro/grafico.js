/*
    Dados obtidos da página inicial do usuário, por enquanto estou utilizando campos ocultos input,
    mas a alternativa ideal seria a construção de um API para transmissão de dados com Laravel.
*/
const renda = parseFloat(document.getElementById('renda').value);
const despesa = parseFloat(document.getElementById('despesa').value);
const jurosRenda = parseFloat(document.getElementById('jurosRenda').value);
const jurosDespesa = parseFloat(document.getElementById('jurosDespesa').value);
const intervalo = document.getElementById('intervalo').value;
const assinatura = parseInt(document.getElementById('assinatura').value);
let dadosPizza;
/*
    Dados são pareados de acordo com sua ordenação, primeira legenda a primeiro valor, sucessivamente,
    o mesmo é valido para propriedades como cores, etc;
*/
if (assinatura > 1) {
    dadosPizza = {
        // `labels` são os nomes das categorias (fatias).
        labels: ['Renda', 'Juros', 'Despesa', 'Juros'],
        datasets: [{
            data: [renda, jurosRenda, despesa, jurosDespesa], // Os valores para cada fatia.
            backgroundColor: [
                "#198754", //Renda
                "#81C784", //Juros Renda
                "#dc3545", // Despesa
                "#E57373", //Juros Despesa
            ],
            hoverOffset: 4 // Quantidade de pixels que a fatia se desloca ao passar o mouse.
        }]
    };
} else {
    dadosPizza = {
        // `labels` são os nomes das categorias (fatias).
        labels: ['Renda', 'Despesa'],
        datasets: [{
            data: [renda, despesa], // Os valores para cada fatia.
            backgroundColor: [
                "#198754", //Renda
                "#dc3545", // Despesa
            ],
            hoverOffset: 4 // Quantidade de pixels que a fatia se desloca ao passar o mouse.
        }]
    };
}
const configPizza = {
    type: "doughnut",
    data: dadosPizza,
    options: {
        responsive: true,
        devicePixelRatio: 2,
        plugins: {
            title: {
                display: false,
                text: "",
                font: {
                    size: 18
                }
            },
            legend: {
                display: true, // É crucial exibir a legenda para gráficos de pizza.
                position: "top", // Posição da legenda: "top", "bottom", "left", "right".
                labels: {
                    font: {
                        size: 14
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        // Formata o texto da ajuda de contexto para incluir rótulo e porcentagem.
                        let label = context.label || "";
                        if (label) {
                            label += ": ";
                        }
                        if (context.parsed !== null) {
                            // Calcula a porcentagem da fatia em relação ao total.
                            const total = context.dataset.data.reduce((sum, val) => sum +
                                val, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(2);
                            label += `${percentage}%`;
                        }
                        return label;
                    }
                }
            }
        }
        // Importante: Gráficos de pizza NÃO usam a propriedade `scales`.
    }
};
const ctxPizza =
    document.getElementById("myChart").getContext("2d");
new Chart(ctxPizza, configPizza);
