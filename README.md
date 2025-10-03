# NerumXP

Aplicação web construída com Laravel no back-end e tecnologias web modernas no front-end, seguindo práticas de segurança e organização MVC.

## Tecnologias

- **Laravel** - Framework PHP full-stack para back-end
- **HTML/CSS/JavaScript** - Interface e interatividade
- **Chart.js** - Biblioteca para visualização de gráficos
- **MySQL/MariaDB** - Banco de dados relacional
- **Bootstrap** - Framework CSS para estilização

## Instalação

**Pré-requisitos:** PHP, Composer, NPM e MySQL/MariaDB.

1. Clone o repositório e entre na pasta do projeto
2. Instale as dependências:composer install
npm install3. 
3. Configure o ambiente:
`cp .env.example .env`

`php artisan key:generate`

4. Configure o banco de dados no arquivo `.env` e defina 

`SESSION_DRIVER=file`

Acesso o diretorio database e extraia as procedures/functions que a aplicação utiliza

5. Compile os assets:

npm run build

## Uso

## Estrutura

O projeto segue a estrutura padrão do Laravel com organização MVC:
- `app/` - Lógica da aplicação
- `resources/views/` - Templates Blade
- `resources/js/` - JavaScript e componentes
- `resources/css/` - Estilos CSS
- `public/` - Assets públicos

## Configuração

Principais variáveis do `.env`:
- `APP_NAME` - Nome da aplicação
- `DB_CONNECTION=mysql` - Tipo de banco
- `DB_HOST`, `DB_PORT`, `DB_DATABASE` - Configurações do banco
- `SESSION_DRIVER=file` - Driver de sessão

## Contribuição

1. Abra uma issue descrevendo a mudança proposta
2. Crie um branch de feature
3. Faça commit das alterações com mensagens descritivas.

## Licença

Este projeto está sob licença MIT. Consulte o arquivo `LICENSE` para mais detalhes.

## Contato

Para dúvidas e sugestões, abra uma issue no repositório.
