/*
    * Variávies necessárias
    * Dados
    * - Array de legendas para o gráfico.
    * - Array de valores para cada marco temporal.
    *
    * Elementos
    * - canvas(gráfico)
    * */

const canvas = document.querySelector('#grafico_historico');
const dias = historico.map(entrada => entrada.updated_at);

//Obtem os dados corretos para cada tipo de meta :)
const dadosProgresso = ('pc_progresso' in historico[0])
    ? historico.map(entrada => entrada.pc_progresso)
    : historico.map(entrada => entrada.vl_progresso);
const dadosAlvo = ('pc_progresso' in historico[0])
    ? historico.map(entrada => entrada.pc_alvo)
    : historico.map(entrada => entrada.vl_alvo);

new Chart(canvas, {
    type: 'line',
    data: {
        labels: dias,
        datasets: [
            {
                label: 'Progresso',
                data: dadosProgresso,
                borderColor: "#3CB371", //Verde-marinho
                fill: true,
                backgroundColor: "rgba(178,224,199,0.2)",
                tension: 0.4
            },
            {
                label: 'Meta',
                data: dadosAlvo,
                borderColor: "#0d6efd", //Azul primary
                fill: true,
                backgroundColor: 'rgba(13,110,153,0.2)',
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Progresso ao longo do tempo',
                font: {
                    size: 25
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
