-- Responsável por finalizar registros, será atualizado para um gatilho
delimiter $
CREATE PROCEDURE spFinalizaRegistro(IN codigo_param INT)
BEGIN
    DECLARE qtParcelasPagas_var INT;
    DECLARE qtParcelas_var INT;
    DECLARE pago_var INT;
	IF EXISTS(SELECT cd_registro FROM registro WHERE cd_registro = codigo_param) THEN
	    -- Atribuição de variáveis
	    SELECT ic_pago INTO pago_var FROM registro WHERE cd_registro = codigo_param;
	    SELECT qt_parcelas_pagas INTO qtParcelasPagas_var FROM registro WHERE cd_registro = codigo_param;
	    SELECT qt_parcelas INTO qtParcelas_var FROM registro WHERE cd_registro = codigo_param;
	    -- Processamento
		IF (pago_var = 0) THEN
		    -- Neste trecho tornamos o registro pago
			UPDATE registro
				SET ic_pago = 1
				WHERE cd_registro = codigo_param;
				
			-- Igualamos a quantidade de parcelas pagas ao total, se parcelado
			IF(qtParcelas_var > 0 AND qtParcelasPagas_var < qtParcelas_var) THEN
    			UPDATE registro
    				SET qt_parcelas_pagas = qtParcelas_var 
    				WHERE cd_registro = codigo_param;
    		END IF;
		ELSE
			SELECT ('Registro Já pago!');
        END IF;
	ELSE
		SELECT('ERRO!!! Registro inexistente!');
    END IF;
END $
delimiter ;

-- Define o dashboard de renda/despesa de nossos usuários
delimiter $
CREATE PROCEDURE spAtualizaResumo(IN idUsuario_param INT, IN dataInicio_param TIMESTAMP, IN dataFim_param TIMESTAMP)
BEGIN
    DECLARE vl_debito_var decimal(9,2);
    DECLARE vl_superavit_var decimal(9,2);
    DECLARE vl_balanco_var decimal(9,2);
    DECLARE agora_var timestamp;
    
    -- Verificamos se o usuário em questão existe em primeiro lugar
	IF EXISTS(SELECT cd_usuario FROM usuario WHERE cd_usuario = idUsuario_param) THEN
        -- Atribuição
        select sfRendaDespesaTotal(idUsuario_param,2,dataInicio_param,dataFim_param) into vl_debito_var;
        select sfRendaDespesaTotal(idUsuario_param,1,dataInicio_param,dataFim_param) into vl_superavit_var;
        select now() into agora_var;
        
        -- Inserindo ou atualizando o panorama do usuário
        IF NOT EXISTS(SELECT cd_usuario FROM panorama WHERE cd_usuario = idUsuario_param) THEN
			INSERT INTO panorama (cd_usuario,vl_debito,vl_superavit,balanco,dt_inicio,dt_termino,created_at,updated_at) VALUES
				(idUsuario_param,
				vl_debito_var,
				vl_superavit_var,
				vl_superavit_var - vl_debito_var,
				dataInicio_param,
				dataFim_param,
				agora_var,
				agora_var
				);
        ELSE
			UPDATE panorama
				SET 
					vl_debito = vl_debito_var,
					vl_superavit = vl_superavit_var,
					balanco = vl_superavit_var - vl_debito_var,
					dt_inicio = dataInicio_param,
					dt_termino = dataFim_param,
					updated_at = agora_var 
					WHERE cd_usuario = idUsuario_param;
        END IF;
    ELSE 
		SELECT('Usuário não existente');
    END IF;
    
    -- Retornando valores
	SELECT * FROM panorama where cd_usuario = idUsuario_param;
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
