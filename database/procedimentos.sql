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
CREATE PROCEDURE spAtualizaResumo(IN idUsuario_param INT, IN dataInicio_param TIMESTAMP, IN dataFim_param TIMESTAMP, IN dataAlvo_param TIMESTAMP)
BEGIN
    DECLARE vl_renda_fix_var decimal(9,2);
    DECLARE vl_desp_fix_var decimal(9,2);
    DECLARE vl_renda_flut_var decimal(9,2);
    DECLARE vl_desp_flut_var decimal(9,2);

    DECLARE vl_juros_superavit_var decimal(9,2);
    DECLARE vl_juros_debito_var decimal(9,2);
    DECLARE vl_debito_var decimal(9,2);
    DECLARE vl_superavit_var decimal(9,2);

    DECLARE vl_balanco_var decimal(9,2);
    DECLARE agora_var timestamp;

    -- Verificamos se o usuário em questão existe em primeiro lugar
	IF EXISTS(SELECT cd_usuario FROM usuario WHERE cd_usuario = idUsuario_param) THEN
        -- Atribuição
        select sfRDFixaTotal(idUsuario_param,1,dataInicio_param,dataFim_param) into vl_renda_fix_var;
        select sfRDFixaTotal(idUsuario_param,2,dataInicio_param,dataFim_param) into vl_desp_fix_var;

        select sfRendaFlutuante(idUsuario_param,date(dataInicio_param),date(dataFim_param),date(dataAlvo_param)) into vl_renda_flut_var;
        select sfDespesaFlutuante(idUsuario_param,date(dataInicio_param),date(dataFim_param),date(dataAlvo_param)) into vl_desp_flut_var;

        select (vl_renda_flut_var -
            (select sum(vl_valor)
                from registro
            where
                cd_usuario = idUsuario_param and
                cd_tipo_registro = 1 and
                cd_modalidade = 2 and
                date(created_at) between date(dataInicio_param) and date(dataFim_param)
            )) into vl_juros_superavit_var;


        select (vl_desp_flut_var -
            (select sum(vl_valor)
            from registro
            where
             cd_usuario = idUsuario_param and
                cd_tipo_registro = 2 and
                cd_modalidade = 2 and
                date(created_at) between date(dataInicio_param) and date(dataFim_param)
            )) into vl_juros_debito_var;

        select vl_renda_flut_var + vl_renda_fix_var into vl_superavit_var;
        select vl_desp_flut_var + vl_desp_fix_var into vl_debito_var;

        select now() into agora_var;

        -- Inserindo ou atualizando o panorama do usuário
        IF NOT EXISTS(SELECT cd_usuario FROM panorama WHERE cd_usuario = idUsuario_param) THEN
			INSERT INTO panorama (cd_usuario,vl_debito,vl_superavit,balanco,vl_juros_debito,vl_juros_superavit,dt_inicio,dt_termino,created_at,updated_at) VALUES
				(idUsuario_param,
				vl_debito_var,
				vl_superavit_var,
				vl_superavit_var - vl_debito_var,
				vl_juros_debito_var,
				vl_juros_superavit_var,
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
					vl_juros_debito = vl_juros_debito_var,
					vl_juros_superavit = vl_juros_superavit_var,
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

-- O procedimento a seguir é responsável por atualizar o panorama de metas associado a cada usuário;
delimiter $$
create procedure sp_panorama_metas(IN cd_usuario_param INT)
begin
    declare assinatura_usuario_var INT;
    declare qt_metas_renda_var INT;
    declare qt_metas_despesa_var INT;
    declare pc_metas_finalizadas_var DECIMAL(5,2);
    declare pc_metas_nao_finalizadas_var DECIMAL(5,2);

    select
        cd_assinatura into assinatura_usuario_var
    from usuario
        where cd_usuario = cd_usuario_param;

    if(assinatura_usuario_var > 1) then
        -- qt metas renda
        select count(*) into qt_metas_renda_var
            from metas as m
            inner join tipo_metas as tm
                using(cd_tipo_meta)
            where
                tm.cd_tipo_meta in(1,2) and
                m.cd_usuario = cd_usuario_param;
        -- qt metas despesa
        select count(*) into qt_metas_despesa_var
            from metas as m
            inner join tipo_metas as tm
                using(cd_tipo_meta)
            where
                tm.cd_tipo_meta not in(1,2) and tm.cd_tipo_meta < 7 and
                m.cd_usuario = cd_usuario_param;
        -- pc_metas_finalizadas
        select (
            format(
                (select count(*) from metas where ic_finalizada = 1 and cd_usuario = cd_usuario_param) / (select count(*) from metas where cd_usuario = cd_usuario_param) * 100,2)
        ) into pc_metas_finalizadas_var;
        -- pc_metas_nao_finalizadas
        select format(100 - pc_metas_finalizadas_var,2) into pc_metas_nao_finalizadas_var;

        -- Verificando a existência de algum panora prévio
        if exists(select * from panorama_metas where cd_usuario = cd_usuario_param) then
            update panorama_metas
                set
                    qt_metas_renda = qt_metas_renda_var,
                    qt_metas_despesa = qt_metas_despesa_var,
                    pc_metas_finalizadas = pc_metas_finalizadas_var,
                    pc_metas_nao_finalizadas = pc_metas_nao_finalizadas_var
                where cd_usuario = cd_usuario_param;
        else
            insert into panorama_metas(cd_usuario,qt_metas_renda,qt_metas_despesa,pc_metas_finalizadas,pc_metas_nao_finalizadas) values
                (cd_usuario_param,qt_metas_renda_var,qt_metas_despesa_var,pc_metas_finalizadas_var,pc_metas_nao_finalizadas_var);
        end if;
    end if;
    select * from panorama_metas where cd_usuario = cd_usuario_param;
end $$
delimiter ;

DELIMITER $$
CREATE PROCEDURE spGerenteMetas(IN cd_meta_param INT)
BEGIN
    DECLARE categorias_somatorio_var DECIMAL(12,2) DEFAULT 0;
    DECLARE pc_final_var DECIMAL(6,3);
    DECLARE somatorio_vl_meta_var DECIMAL(12,2);
    DECLARE done_flag BOOL DEFAULT FALSE;
    DECLARE c_cd_categoria_meta INT;
    DECLARE cd_tipo_meta_var INT;

    -- cursor para obtenção das categorias das metas e loop futuro
    DECLARE cursor_metas CURSOR FOR
        select cd_categoria from metas_categoria where cd_meta = cd_meta_param;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_flag = TRUE;

    -- Obtendo o valor total de todos os registros associados a meta e tipo da meta
    select sfSomatorioValorMetas(cd_meta_param) into somatorio_vl_meta_var;
    select cd_tipo_meta into cd_tipo_meta_var from metas where cd_meta = cd_meta_param;

    -- Realizando encaminhamento condicional de acordo com o tipo de meta
    if(cd_tipo_meta_var < 7) then
        if(cd_tipo_meta_var > 4) then
            -- Obtendo o somatorio do valor dos registros associados as categorias da meta
            OPEN cursor_metas;

            metas_loop: LOOP
                fetch cursor_metas into c_cd_categoria_meta;
                if done_flag then
                    LEAVE metas_loop;
                end if;
                set categorias_somatorio_var = categorias_somatorio_var + sfSomatorioValorRegistroCategoria(c_cd_categoria_meta);
            END LOOP metas_loop;

            CLOSE cursor_metas;

            -- Atualizando o progresso da meta se necessário
            if(
                somatorio_vl_meta_var / categorias_somatorio_var * 100 <> (select pc_progresso from metas where cd_meta = cd_meta_param)
            ) then
                update metas
                    set pc_progresso = somatorio_vl_meta_var / categorias_somatorio_var * 100
                    where cd_meta = cd_meta_param;
            end if;
        else
            -- Atualizando o progresso da meta se necessário
            if(
                somatorio_vl_meta_var <> (select vl_valor_progresso from metas where cd_meta = cd_meta_param)
            ) then
                update metas
                    set vl_valor_progresso = somatorio_vl_meta_var
                    where cd_meta = cd_meta_param;
            end if;
        end if;
    end if;
END $$
DELIMITER ;
