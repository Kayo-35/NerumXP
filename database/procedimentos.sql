/*Primeiro procedimento (regras de negocio)
spFinalizaRegistro tem como finalidade concluir registros financeiros dos quais sejam parcelados. Durante a utilização da aplicação de gerenciamento financeiro um usuário poderia utilizar a mesma para indicar que o registro de despesa fora pago, ou um investimento fora concluido, relativos a registros fixos. Mas para garantir a integridade da realidade de negócios isso não bastaria, pois se o mesmo for parcelado então devemos também indicar que a quantidade de parcelas pagas é igual a quantidade total de parcelas, então concluindo o registro.

Esse procedimento recebe como parâmetro de valor um código, que seria referente a que registro deveria ser concluido, e realiza as instruções indicadas nos comentários a seguir:
*/
delimiter $
CREATE PROCEDURE spFinalizaRegistro(IN codigo INT)
BEGIN
    DECLARE qtParcelasPagas INT;
    DECLARE qtParcelasNao INT;
    DECLARE pago INT;
    
	-- Tomada de decisão composta: Primeiro avalia-se se o código fornecido como entrada de dados manual, se os mesmo estiver associado a alguma tupla de registro_fixo o bloco de códigos subordinado a verdadeiro executa a próxima etapa, senão ocorre a 'impressão' da string 'ERRO!!! Registro inexistente'.
	IF EXISTS(SELECT cd_registro_fixo FROM registro_fixo WHERE cd_registro_fixo = codigo) THEN
	    SET pago = (SELECT ic_pago FROM registro_fixo WHERE cd_registro_fixo = codigo);
	    SET qtParcelasPagas = (SELECT qt_parcelas_pagas FROM registro_fixo WHERE cd_registro_fixo = codigo);
	    SET qtParcelasNao =(SELECT qt_parcelas FROM registro_fixo WHERE cd_registro_fixo = codigo);
	    
		-- A segunda tomada de decisão de mesmo tipo: Agora avalia-se se o registro indicado já fora pago ou não, se foi o procedimento apenas indica que já fora pago, caso contrário o bloco subordinado é executado
		IF (pago = 0) THEN
			-- Por último verifica-se se a quantidade de parcelas pagas é menor que as fixas, se sim atribui-se a quantidade de parcelas pagas a mesma presente na quantidade total
			IF (qtParcelasPagas < qtParcelasNao) THEN
				UPDATE registro_fixo
					SET qt_parcelas_pagas = qt_parcelas
						WHERE cd_registro_fixo = codigo;
			END IF;

            -- Neste trecho tornamos o registro pago
			UPDATE registro_fixo
				SET ic_pago = 1
				WHERE cd_registro_fixo = codigo;
		ELSE
			SELECT ('Registro Já pago!');
        END IF;
	ELSE
		SELECT('ERRO!!! Registro inexistente!');
    END IF;
END $
delimiter ;

-- Crud
/*
O resumo geral seria o painel Dashboard mais básico, contendo as informações básicas dos registros fixos de nossos usuários: O deficit de despesas, renda e o balanço geral, a partir de um determinado período de tempo. O procedimento a seguir inclui algumas validações essenciais, mas deixaríamos outras para serem concluidas na aplicação (por exemplo, a data de termino não pode ser menor que a de ínicio, por motivos óbvios :/). Tanto os valores de deficit, balanço e renda são gerados a partír de processamento aritmético de valores obtidos por subconsultas.
*/
delimiter $
CREATE PROCEDURE spAtualizaResumo(IN codigoU INT, IN dataIniReg DATE, IN dataFimReg DATE)
BEGIN
	-- chaveM tem a função de adquirir o valor máximo presente como identificador de uma tupla em resumoGeral, para que ao realizarmos inserções para tal campo sejamos capazes de fornecer um valor válido(o mesmo mais 1)
	DECLARE chaveM INT;
    
    -- Verificamos se o usuário em questão existe em primeiro lugar
	IF EXISTS(SELECT cd_usuario FROM usuario WHERE codigoU = cd_usuario) THEN
		/* Aqui realizamos a atribuição do valor da chaveM, se existir já alguma o valor de chaveM será o maior delas, senão o valor 1 é utilizado, mas o mesmo é simbólico */
        IF (SELECT MAX(cd_resumo) FROM resumoGeral) IS NOT NULL THEN
			SET chaveM = (SELECT MAX(cd_resumo) FROM resumoGeral);
        ELSE
			SET chaveM = 1;
        END IF;
        
		-- A próxima etapa é verificar se já existe algum registro em resumoGeral para o usuário, se existir update será realizado para os campos dinâmicos (deficit,superavit,balanco) senão inserções completas para a tupla
        IF NOT EXISTS(SELECT * FROM resumoGeral WHERE cd_usuario = codigoU)THEN
			INSERT INTO resumoGeral (cd_resumo,cd_usuario,vl_debito,vl_superavit,vl_balanco) VALUES
				((chaveM + 1),
				codigoU,
				(SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor < 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg),
				(SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor > 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg),
				((SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor < 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg) +  (SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor > 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg)) -- Essa subconsulta realiza soma algébrica, já que o valor de qualquer despesa em nossa base é negativo, o que simboliza uma dívida.
				);
        ELSE
			UPDATE resumoGeral
				SET 
					vl_debito = (SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor < 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg),
					vl_superavit = (SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor > 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg),
					vl_balanco = ((SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor < 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg) + (SELECT SUM(vl_valor) FROM registro_fixo WHERE cd_usuario = codigoU AND vl_valor > 0 AND dt_registro >= dataIniReg AND dt_registro < dataFimReg))
					WHERE cd_usuario = codigoU;
        END IF;
    ELSE 
		SELECT('Usuário não existente');
    END IF;
END $
delimiter ;

-- regra de negocio
/*Esse procedimento lida com os registros flutuantes da nossa base de dados, ou seja todos aqueles dos quais se aplicam juros compostos ou simples. O objetivo do mesmo é sempre que invocado retornar o lucro ou o prejuízo de um determinado registro ao longo do tempo baseado em sua taxa de juros, data de vencimento e tipo de juros. Acreditamos que sua implementação na base de dados como um procedimento aliviaria carga de processamento e código em nossa aplicação, além da facilidade de manipulação dos dados presentes aqui.*/
delimiter $
CREATE PROCEDURE spCalculaJuros(IN codigoRegistro INT,IN dataAtual DATE)
BEGIN
-- Neste trecho declaro as variáveis que utilizarei, como o procedimento é um tanto longo preferi utilizar mais variáveis locais.
DECLARE tipo_juros INT;
DECLARE dias INT;
DECLARE dataVencimento DATE;
DECLARE dataRegistro DATE;
DECLARE valorInicial DECIMAL(13,6);
DECLARE valorFinal DECIMAL(13,6);
DECLARE juros DECIMAL(13,6);
DECLARE taxa DECIMAL(13,6);
DECLARE tipo INT;

IF EXISTS(SELECT * FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro) THEN
	SET tipo_juros = (SELECT cd_tipo_juro FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro);
    SET taxa = ((SELECT pc_taxa_juros FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro)/100); -- A divisão por 100 é devido a forma como é armazenada no banco
    SET valorInicial = (SELECT vl_valor_registro FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro);
	SET dataVencimento = (SELECT dt_vencimento FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro);
    SET dataRegistro = (SELECT dt_registro FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro);
	SET tipo = (SELECT cd_tipo_registro FROM registro_flutuante WHERE cd_registro_flutuante = codigoRegistro);

    /*Essa primeira tomada de decisão composta tem com objetivo atribuir a quantidade de dias válidas para inclusão da taxa de juros, que por padrão permitiremos que nossos usuários as forneça por ano. Porém cada tipo de registro possui uma faixa de tempo diferente: 
    Rendas(tipo 1) possuem período de lucratividade baseada no intervalo da data do registro(poderia ser antes? Sim mas se o usuário acabou registrando depois preferimos que o mesmo realizasse tal controle) até a data do vencimento, quando o investimento termina, etc. 
    Despesas possuem raciocínio inverso, o juros começam a serem aplicados após uma data de vencimento, como uma multa(obs: Existem despesas que possuem juros aplicados desde sempre, mas nesse procedimento inclui o primeiro caso descrito).
    */
    IF(tipo = 2) THEN
        -- Trecho subordinado a registros de receita
        /*O raciocínio segue da seguinte forma: Sendo o intervalo de dias desde o registro inserido até data x, x será obtido a partír de dois cenários, sendo a data inserida pelo usuário(dataAtual) fornecida anterior a dataRegistro o intervalo de dias será calculada sobre o mesmo(para os casos citados anteriormente, supondo que o usuário tenha erroneamente cadastrado a data de registro). Caso contrário o intervalo será baseado na dataRegistro até o valor da dataVencimento */
		IF (DATEDIFF(dataAtual,dataRegistro) < 0) THEN
			SET dias = (SELECT DATEDIFF(dataAtual,dataVencimento));
		ELSE
			SET dias = (SELECT DATEDIFF(dataRegistro,dataVencimento));
		END IF;
    ELSE
        -- Trecho subordinado a registros de despesas
        -- A lógica é semelhante ao bloco anterior, mas inversamente aplicada, juros começariam a serem aplicados a partír da data de vencimento até data x, sendo x ou a data fornecida como parâmetro ou CURDATE(). Observe que logicamente um resultado anormal seria obtido se tanto CURDATE() retornar um valor anterior a vencimento e a dataAtual, mas impediriamos tais casos com validações em nossa aplicação, já que o objetivo é obter os valores monetários que realmente impactariam o registro, não faria sentido permitir que o usuário quando tentasse gerar um relatório de juros querer saber quantos juros seriam aplicados, nesse contexto, antes do inicio do período de vigência dos próprios juros :/
		IF (DATEDIFF(dataAtual,dataVencimento) < 0) THEN
			SET dias = (SELECT DATEDIFF(CURDATE(),dataVencimento));
		ELSE
			SET dias = (SELECT DATEDIFF(dataAtual,dataVencimento));
		END IF;
    END IF;
    
    CASE tipo_juros
		WHEN 1 THEN
			SET juros = valorInicial*(taxa/365*dias);
            SET valorFinal = valorInicial+juros;
            SELECT FORMAT(valorInicial,2) AS 'Montante Inicial',FORMAT(juros,2) AS Juros, FORMAT(valorFinal,2) AS 'Montante Final';
        WHEN 2 THEN
			SET juros = valorInicial*POWER(1+taxa/365,dias);
            SET valorFinal = valorInicial + juros;
            SELECT FORMAT(valorInicial,2) AS 'Montante Inicial',FORMAT(juros,2) AS Juros, FORMAT(valorFinal,2) AS 'Montante Final';
        WHEN 3 THEN
			SELECT('NADA A SER FEITO!');
	END CASE;
ELSE
	SELECT('NENHUM REGISTRO ENCONTRADO');
END IF;
END $
delimiter ;


/* 
    Essa consulta seria utilizada apenas para análise administrativa da plataforma, não invocada por seus clientes. O objetivos é obter um panoram completo das movimentações financeiras em nossa plataforma por categoria de gastos(alimentação,medicamentos,etc), claro que registros flutuantes teriams juros a serem cotados, mas a saída dessa consulta visa os valores bases para critérios de comparação. Podemos, por exemplo, deduzir que se os valores gerais de despesas, tipo 1, tiverem seus módulos(armazenamos como valores negativos) maiores que a renda geral, nossa plataforma estaria sendo mais utilizada por pessoas que desejam controlar suas despesas com mais afinco e não tanto suas fontes de renda, no fúturo talvez isso seja últil se o projeto fosse implementado e a equipe de devs quissesse desenvolver novos recursos a plataforma.
*/
DELIMITER $
CREATE PROCEDURE spEstatisticas(IN cat INT, IN tipo INT)
BEGIN
    DECLARE operador CHAR(1);
	 -- Verifica se a categoria fornecida existe na base de dados
    IF cat IN (SELECT cd_categoria FROM categoria) THEN
        -- Agora se o tipo é válido (renda ou despesa)
        IF tipo IN (SELECT cd_tipo_registro FROM tipo_registro) THEN
             -- Define o operador
            IF tipo = 1 THEN
                SET operador = '<';  -- Despesas (negativos)
            ELSE
                SET operador = '>';  -- Rendas (positivos)
            END IF;
            
            SELECT 
                FORMAT(AVG(rfx.vl_valor), 2) AS 'AVG registro_fixo',
                FORMAT(AVG(rft.vl_valor_registro), 2) AS 'AVG registro_flutuante',
                FORMAT(MAX(rfx.vl_valor), 2) AS 'MAX registro_fixo',
                FORMAT(MAX(rft.vl_valor_registro), 2) AS 'MAX registro_flutuante',
                FORMAT(MIN(rfx.vl_valor), 2) AS 'MIN registro_fixo',
                FORMAT(MIN(rft.vl_valor_registro), 2) AS 'MIN registro_flutuante'
            FROM registro_fixo AS rfx
            INNER JOIN usuario AS u ON u.cd_usuario = rfx.cd_usuario
            INNER JOIN registro_flutuante AS rft ON u.cd_usuario = rft.cd_usuario
            WHERE 
                ((operador = '<' AND rfx.vl_valor < 0 AND rft.vl_valor_registro < 0) OR (operador = '>' AND rfx.vl_valor > 0 AND rft.vl_valor_registro > 0))
              AND rfx.cd_categoria = cat
              AND rft.cd_categoria = cat;
        ELSE
            SELECT 'Tipo inválido' AS mensagem;
        END IF;
    ELSE
        SELECT 'Categoria Inválida' AS mensagem;
    END IF;
END $
DELIMITER ;

-- Historico: Constrói o historico de valores de registro_fixos
DELIMITER $
CREATE TRIGGER trgHistoricoFixo BEFORE UPDATE ON registro_fixo 
FOR EACH ROW
BEGIN
    DECLARE dt_referencia TIMESTAMP;
    DECLARE idRegistro INT;
    DECLARE tipo INT;
    
    SET
      tipo = NEW.cd_tipo_registro;
    SET
      idRegistro = NEW.cd_registro_fixo;
    SELECT
      MAX(updated_at) INTO dt_referencia
    FROM
      historico
    WHERE
      cd_origem_fixo = idRegistro;
      
    IF dt_referencia IS NULL OR DATE(NEW.updated_at) > DATE(dt_referencia)
        INSERT INTO
          historico(
            cd_origem_fixo,
            cd_tipo_hist,
            vl_valor,
            created_at,
            updated_at
          )
        VALUES
          (
            NEW.cd_registro_fixo,
            tipo,
            NEW.vl_valor,
            NOW(),
            NOW()
          );
    END IF;
END $
DELIMITER ;
