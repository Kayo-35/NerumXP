# Projeto NerumXP

Componentes tecnológicos:

- Laravel (Framework full-stack): Gerenciará todos os aspectos do back-end e fornecerá suporte para o front. Permitirá nosso projeto atingir padrões industriais de segurança e eficiência.
- HTML/CSS/JavaScript: Serão utilizado para construir os aspectos de interface normalmente
- MySQL/MariaDB: Nossas bases de dados
- Talvez no futuro alguma Framework JavaScript (De preferência React ou Vue)

# Aonde devo enviar meus arquivos?

Samuel,Kallyu e William enviem as paginas que criarem: Home, Sobre e de Login no diretório anz que tanto(kayo como josé) serão responsáveis por adaptarem as mesmas para views

## Instruções para quando clonarem pela primeira vez o repositório:

> Necessários uma única vez antes de iniciar o projeto

1. Use **npm install** (instala as dependências do front-end)
2. **composer install** (o mesmo para o back end php)
3. Crie uma cópia do arquivo **.env.example** com nome **.env**

- (contém configurações de ambiente de execução, por isso cada pc teria uma, por exemplo número da porta da sua base de dados, etc, altere o valor de session_driver para file porque não estamos utilizando uma base de dados para isso.

4. **Execute php artisan key:generate** (Um valor de env para ser usado pelo algoritmo quando criptografa algo, preciso para a aplicação
5. Logo após **npm run build** (Compila as dependências do bootstrap)

## Como executar a aplicação?

- **php artisan serve**

## Recomendações

- Estude MVC e OOP(Orientação a objetos) com PHP antes de tentar começar a aprender Laravel!
