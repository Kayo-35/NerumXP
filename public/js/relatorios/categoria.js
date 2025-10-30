const divGraficoRenda = document.querySelector("#ganhoPorCategoria");
const divGraficoDespesa = document.querySelector("#despesaPorCategoria");

const categorias = Object.keys(rendaPorCategoria);
const valoresRenda = Object.values(rendaPorCategoria);
const valoresDespesa = Object.values(despesaPorCategoria);

gerarGraficoCategoria(divGraficoDespesa, valoresDespesa, 'Despesa por Categoria', 2);
gerarGraficoCategoria(divGraficoRenda, valoresRenda, 'Renda Por Categoria', 1);

function gerarGraficoCategoria(elemento, dados, titulo, modo) {
    new Chart(elemento, {
        type: 'pie',
        data: {
            labels: modo == 1 ? Object.keys(rendaPorCategoria) : Object.keys(despesaPorCategoria),
            datasets: [{
                data: dados,
                backgroundColor:
                    [
                        "#FF6347", //Tom de vermelho
                        "#4682B4", //Azul-aço
                        "#3CB371", //Verde-marinho
                        "#FFD700", //Dourado
                        "#A0522D", //Marrom?
                        "#808080", //Cinza
                        "#228B22", //Verde-floresta
                        "#DC143C", //Carmim
                        "#6A5ACD" //Tipo de azul, acho
                    ],
                borderColor: [
                    '#000000'
                ],
                borderWidth: 2,
                hoverOffset: 4
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'left',
                },
                title: {
                    display: true,
                    text: titulo,
                    font: {
                        size: 30
                    }
                }
            }
        }
    });
}

const rendaDespesa = document.querySelector('#rendaDespesa');
const meses = Object.keys(rendaPorMes);
const valoresPorMesRenda = Object.values(rendaPorMes);
const valoresPorMesDespesa = Object.values(despesaPorMes);

new Chart(rendaDespesa, {
    type: 'line',
    data: {
        labels: meses,
        datasets: [
            {
                label: 'Renda',
                data: valoresPorMesRenda,
                borderColor: "#3CB371", //Verde-marinho
                fill: true,
                backgroundColor: "rgba(178,224,199,0.4)",
                tension: 0.4
            },
            {
                label: 'Despesa',
                data: valoresPorMesDespesa,
                borderColor: "#DC143C", //Carmim
                fill: true,
                backgroundColor: 'rgba(243,178,190,0.4)',
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Renda vs Despesa 2024',
                font: {
                    size: 30
                }
            }
        },
        scales: {
            y: {
                beginAtZero: false,
                ticks: {
                    callback: function (value) {
                        return value.toLocaleString();
                    }
                }
            }
        }
    }
});
