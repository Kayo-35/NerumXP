const finalizadasCtx = document.getElementById('finalizadas').getContext('2d');
const compararCtx = document.getElementById('comparar').getContext('2d');
const dataSetFinalizadas = {
    labels: ['Concluidas', 'Inconcluídas'],
    datasets: [{
        data: [pc_metas_finalizadas, pc_metas_nao_finalizadas],
        backgroundColor: [
            "#198754", //finalizadas
            "#dc3545", //não finalizadas
        ],
        hoverOffset: 4
    }]
};

const dataSetComparar = {
    labels: ['Metas de Renda', 'Metas de Despesa'],
    datasets: [{
        data: [qt_metas_renda, qt_metas_despesa],
        backgroundColor: [
            "#198754", //finalizadas
            "#dc3545", //não finalizadas
        ],
        hoverOffset: 4
    }]
};

const configFinalizadas = {
    type: 'doughnut',
    data: {
        labels: dataSetFinalizadas.labels,
        datasets: dataSetFinalizadas.datasets
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: false,
                text: "",
                font: {
                    size: 5
                }
            },
            legend: {
                display: false,
                position: "right",
                labels: {
                    font: {
                        size: 3
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let label = context.label || "";
                        if (label) {
                            label += ": ";
                        }
                        if (context.parsed !== null) {
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
    }
}

const configComparar = {
    type: 'doughnut',
    data: {
        labels: dataSetComparar.labels,
        datasets: dataSetComparar.datasets
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: false,
                text: "",
                font: {
                    size: 5
                }
            },
            legend: {
                display: false,
                position: "right",
                labels: {
                    font: {
                        size: 3
                    }
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let label = context.label || "";
                        if (label) {
                            label += ": ";
                        }
                        if (context.parsed !== null) {
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
    }
}
const finalizadasChart = new Chart(finalizadasCtx, configFinalizadas);
const compararChart = new Chart(compararCtx, configComparar);
