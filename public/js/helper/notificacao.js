document.addEventListener('DOMContentLoaded', () => {
    painelNotificacao = document.querySelector('#notification');
    if(painelNotificacao !== 'null') {
        setTimeout(() => painelNotificacao.remove(), 5000);
    }
});
