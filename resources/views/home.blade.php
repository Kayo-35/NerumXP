<x-layout>
    <div class="container mt-3">
        <h1>NerumXP</h1>
        <h2>Views a serem criadas</h2>
        <p>
            Em <span class="text-success">verde</span> encontram-se views finalizadas, em <span class="text-danger">vermelho</span> as mais complexas. Em <span class="text-info">ciano</span> as mais fáceis para codificação.
        </p>
        <ul>
            <li class="text-info">Base
                <ul>
                    <li>NavBar</li>
                    <li>Rodapé</li>
                </ul>
            </li>
            <li class="text-warning">Páginas "Estáticas"
                <ul>
                    <li>Home</li>
                    <li>About</li>
                </ul>
            </li>
            <li class="text-danger">Páginas Dinâmicas
                <ul>

                    <li>Resumo</li>
                    <li>Relatórios</li>
                    <li>Registros Fixos/Flutuantes</li>
                    <li>Resumo Inicial</li>
                </ul>
            </li>
        </ul>
        <h2>Etapas básicas</h2>
        <ol>
            <li>Base de Dados configurada(migrations,modelos), views estáticas/base</li>
            <li>Views dinâmicas</li>
            <li>CRUD Elementar: Criação,remoção,atualização e consulta de registros,metas,projetos,categorias,etc</li>
            <li>Relatórios Elementares</li>
            <li>Ingresso na plataforma: Sistema de login, autorização e autenticação</li>
            <li>Sistema de assinaturas</li>
            <li>Relatórios Complexos(inclui gráficos)</li>
            <li>Simulações</li>
        </ol>
        <h3>Pré Requisitos páginas dinâmicas</h3>
        <h4>Registros Fixos/Flutuantes</h4>
        <p>
            Página deve conter um formulário para envio de dados. Os elementos a seguir devem estar presentes
        </p>
        <h6>Gerais</h6>
        <ul>
            <li>Tipo Registro (I)
                <ul>
                    <li>select</li>
                    <li>Associa-se a natureza do registro, renda ou despesa</li>
                </ul>
            </li>
            <li>Nome do Registro (I)
                <ul>
                    <li>Text</li>
                    <li>Qual o nome do registro?</li>
                </ul>
            </li>
            <li>Valor(I)
                <ul>
                    <li>Text(formatado pelo back-end)</li>
                    <li>Qual o valor do registro?</li>
                </ul>
            </li>
            <li>Pago?(I)
                <ul>
                    <li>checkbox</li>
                    <li>Já pago ou não?</li>
                </ul>
            </li>
            <hr>
            <li>Data de Pagamento (II)
                <ul>
                    <li>Date</li>
                    <li>Qual a data do pagamento?</li>
                </ul>
            </li>
            <li>Método de pagamento (II)
                <ul>
                    <li>Checkbox ou Select</li>
                    <li>Cartões,dinheiro em espécie,cheques,</li>
                </ul>
            </li>
            <li>Forma de pagamento (II)
                <ul>
                    <li>Checkbox ou Select</li>
                    <li>A vista ou parcelado?</li>
                </ul>
            </li>
            <li>Nivel de Importância (II)
                <ul>
                    <li>select</li>
                    <li>Associa-se ao grau de urgência,(1 a 5), inventem nomes para cada um :)</li>
                    <li class="fst-italic">Pontos de exclamação costumam ser bons icones para tal</li>
                </ul>
            </li>
            <li>Categoria (II)
                <ul>
                    <li>select</li>
                    <li>Que categoria o registro pertence?</li>
                    <li class="fst-italic">Icones de categorias acompanhando as opções</li>
                </ul>
            </li>
            <hr>
            <li>Descrição (III)
                <ul>
                    <li>textarea</li>
                    <li>Descrição detalhada do registro</li>
                </ul>
            </li>
            <li>Localização (III)
                <ul>
                    <li>select</li>
                    <li>Local do registro?</li>
                    <li class="fst-italic">Que tal usar ícones de relevos para as opções?</li>
                </ul>
            </li>
            <li>Realizador (III)
                <ul>
                    <li>select</li>
                    <li>Quem realizou?</li>
                    <li class="fst-italic">Que tal usar ícones de silhuetas de rostos para as opções?</li>
                </ul>
            </li>
            <li>Status (III)
                <ul>
                    <li>Checkbox</li>
                    <li>Ativou ou não</li>
                </ul>
            </li>



        </ul>
    </div>
</x-layout>
