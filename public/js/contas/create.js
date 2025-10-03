/*
Esse script tem como objetivo fornecer auxilio visual durante a criação de contas em nossa plataforma, dessa maneira o usuário pode identificar campos dos quais possuam dados inválidos.
*/

//Adicionado o comportamento
document.addEventListener('DOMContentLoaded', () => {
    //Obtendo os campos
    const nome = document.querySelector("#nome");
    const email = document.querySelector("#email");
    const password = document.querySelector("#password");

    trimFinal(nome);
    trimFinal(email);

    nome.addEventListener('input', () => {
        //Se menor que 4 erro, maior que 50 o mesmo
        nome.value = nome.value.trimStart();
        if (nome.value.length < 4 || nome.value.length > 50) showError(nome, 'Nome inválido');
        else removeError(nome);
    });

    email.addEventListener('input', () => {
        if (!validateEmail(email)) showError(email, 'Email Inválido');
        else removeError(email);
    })

    senha.addEventListener('input', () => {
        if (!validateSenha(senha)) showError(senha, 'Senha fraca');
        else removeError(senha);
    })

    function showError(item, message) {
        let errorMessage = document.createElement('p');

        item.classList.add('bg-danger-subtle', 'text-danger-emphasis');
        errorMessage.classList.add('text-danger', 'fw-bold');
        errorMessage.textContent = message;

        switch (item) {
            case (nome):
                errorMessage.setAttribute('id', 'errorNome');
                if (document.querySelectorAll('#errorNome').length === 0) {
                    item.after(errorMessage);
                }
                break;
            case (email):
                errorMessage.setAttribute('id', 'errorEmail');
                if (document.querySelectorAll('#errorEmail').length === 0) {
                    item.after(errorMessage);
                }
                break;
            case (senha):
                errorMessage.setAttribute('id', 'errorSenha');
                if (document.querySelectorAll('#errorSenha').length === 0) {
                    item.after(errorMessage);
                }
                break;
        }
    }

    function removeError(item) {
        item.classList.remove('bg-danger-subtle', 'text-danger-emphasis');
        item = document.querySelector('#error' + item.id.charAt(0).toUpperCase() + item.id.substring(1))
        if (item !== null) item.remove();
    }

    function validateEmail(email) {
        //email.value.length < 5 || email.value.length > 255
        //campos: nome @ dominio . dominio de topo
        if (email.value.length < 5 || email.value.length > 255) return false;

        if (!email.value.includes('@') || !email.value.includes('.')) return false;

        //Se o fragmento anterior ao @
        if (email.value.substring(0, email.value.indexOf('@')).length < 1) return false;

        if (email.value.substring(email.value.indexOf('@'), email.value.indexOf('.')).length < 1) {
            return false;
        }
        if (email.value.substring(email.value.indexOf('.')).length < 1) {
            return false;
        }

        //Valido
        return true;
    }
    function validateSenha(senha) {
        /*
        Regras sugeridas por IA
        Minimum Length:** Usually between 8 and 12 characters, with 10-12 being a strong recommendation.
        *   **Character Variety:**
            *   At least one uppercase letter (A-Z).
            *   At least one lowercase letter (a-z).
            *   At least one number (0-9).
            *   At least one special character (e.g., `!@#$%^&*()_+-=[]{}|;:'",.<>/?`).
        */
        if (senha.value.length < 8) return false;

        let senhaChars = senha.value.split('');
        let hasUpperLetter = hasNumber = hasSpecialChar = false;
        const regex = /[^A-Za-z0-9]/;

        senhaChars.forEach((char) => {
            //checando por ao menos um caractere maisculo
            if (isNaN(char)) {
                if (char.toUpperCase() === char) hasUpperLetter = true;
            } else {
                hasNumber = true;
            }
        });

        hasSpecialChar = regex.test(senha.value);

        if (!hasNumber || !hasUpperLetter || !hasSpecialChar) return false;

        //Valid password
        return true;
    }

    function trimFinal(element) {
        //Remove caracteres após preenchimento, por via das duvidas também do inicio :)
        element.addEventListener('blur', () => {
            element.value = element.value.trim();
        });
    }
});
