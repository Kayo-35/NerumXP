-- REGISTROS
-- Gatilho para recordar historico de metas
delimiter $$
CREATE TRIGGER tr_historico_registro_au
    AFTER UPDATE ON registro
    FOR EACH ROW
BEGIN
    -- Verifica se um novo valor deve ser associado
    IF(NEW.vl_valor != OLD.vl_valor) THEN
        INSERT INTO historico(cd_registro,vl_valor,created_at,updated_at) VALUES
        (NEW.cd_registro,NEW.vl_valor,OLD.created_at,NEW.updated_at);
    END IF;
END $$
delimiter ;

-- Gatiho para atualizar novas entradas de historico para registros
delimiter $$
CREATE TRIGGER tr_historico_registro_ai
    AFTER INSERT ON registro
    FOR EACH ROW
BEGIN
    -- Verifica se um novo valor deve ser associado
    INSERT INTO historico(cd_registro,vl_valor,created_at,updated_at) VALUES
    (NEW.cd_registro,NEW.vl_valor,NOW(),NOW());
END $$
delimiter ;


-- METAS
delimiter $$
CREATE TRIGGER tr_historico_metas_ai
    AFTER INSERT ON metas
    FOR EACH ROW
BEGIN
    -- Para metas de valor Fixo
    DECLARE cd_tipo_meta_var INT;
    
    select
        cd_tipo_meta
    into
        cd_tipo_meta_var
    from
        metas
    where
        cd_meta = NEW.cd_meta;
        
    -- Inserindo entrada de histórico
    if (cd_tipo_meta_var < 5) then
        INSERT INTO historico_metas(cd_meta,vl_alvo,vl_progresso,created_at,updated_at) VALUES
        (NEW.cd_meta,NEW.vl_valor_meta,NEW.vl_valor_progresso,NOW(),NOW());
    else
        if(cd_tipo_meta_var < 7) then
            INSERT INTO historico_metas(cd_meta,pc_meta,pc_progresso,created_at,updated_at) VALUES
            (NEW.cd_meta,NEW.pc_meta,NEW.pc_progresso,NOW(),NOW());       
        end if;
    end if;
END
delimiter ;

delimiter $$
CREATE TRIGGER tr_historico_metas_au
    AFTER UPDATE ON metas
    FOR EACH ROW
BEGIN
    -- Para metas de valor Fixo
    DECLARE vl_alvo_var DECIMAL(9,2);
    DECLARE vl_progresso_var DECIMAL(9,2);
    DECLARE pc_alvo_var DECIMAL(6,3);
    DECLARE pc_progresso_var DECIMAL(6,3);
    DECLARE cd_tipo_meta_var INT,
    
    select
        cd_tipo_meta
    into
        cd_tipo_meta_var
    from
        metas
    where
        cd_meta = NEW.cd_meta;
        
    -- Checando sequencialmente que valor atribuir a cada variavel
    
    IF(cd_tipo_meta_var < 5) THEN
        IF(NEW.vl_valor_meta <> OLD.vl_valor_meta) THEN
            SET vl_alvo_var = NEW.vl_valor_meta;
        ELSE
            SET vl_alvo_var = OLD.vl_alvo_var;
        END IF;
    
        IF(NEW.vl_valor_progresso <> OLD.vl_valor_progresso) THEN
            SET vl_progresso_var = NEW.vl_valor_progresso;
        ELSE
            SET vl_progresso_var = OLD.vl_valor_progresso;
        END IF;   
        
        INSERT INTO historico_metas(cd_meta,vl_alvo,vl_progresso,created_at,updated_at) VALUES
        (NEW.cd_meta,vl_alvo_var,vl_progresso_var,NEW.created_at,NEW.updated_at);
    ELSE
        IF(cd_tipo_meta_var < 7)THEN
            IF(NEW.pc_meta <> OLD.pc_meta) THEN
                SET pc_alvo_var = NEW.pc_meta;
            ELSE
                SET pc_alvo_var = OLD.pc_meta;
            END IF;
        
            IF(NEW.pc_progresso <> OLD.pc_progresso) THEN
                SET pc_progresso_var = NEW.pc_progresso;
            ELSE
                SET pc_progresso_var = OLD.pc_progresso;
            END IF;
            
            INSERT INTO historico_metas(cd_meta,pc_alvo,pc_progresso,created_at,updated_at) VALUES
            (NEW.cd_meta,pc_alvo_var,pc_progresso_var,NEW.created_at,NEW.updated_at);
        END IF;
    END IF;
END
delimiter ;

delimiter $$
CREATE TRIGGER tr_status_meta_bi 
    BEFORE INSERT ON metas
    FOR EACH ROW
BEGIN
    DECLARE categorias_somatorio_var DECIMAL(12,2) DEFAULT 0;
    DECLARE pc_final_var DECIMAL(6,3);
    DECLARE somatorio_vl_meta_var DECIMAL(12,2);
    DECLARE done_flag BOOL DEFAULT FALSE;
    DECLARE c_cd_categoria_meta INT;
    DECLARE cd_tipo_meta_var INT;
    
    -- cursor para obtenção das categorias das metas e loop futuro
    DECLARE cursor_metas CURSOR FOR 
        select cd_categoria from metas_categoria where cd_meta = NEW.cd_meta;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_flag = TRUE;
    
    -- Obtendo o valor total de todos os registros associados a meta e tipo da meta
    select sfSomatorioValorMetas(NEW.cd_meta) into somatorio_vl_meta_var;
    select cd_tipo_meta into cd_tipo_meta_var from metas where cd_meta = NEW.cd_meta;
    
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
            
            SET NEW.pc_progresso = somatorio_vl_meta_var / categorias_somatorio_var * 100;
        else 
            SET NEW.vl_valor_progresso = somatorio_vl_meta_var;
        end if;
    end if;
END $$
delimiter ;


delimiter $$
CREATE TRIGGER tr_status_meta_ai
    AFTER INSERT ON metas_registro
    FOR EACH ROW
BEGIN
    -- Utiliza o gerente de metas para atribuir progresso adequado
    CALL spGerenteMetas(NEW.cd_meta);
END $$
delimiter ;

delimiter $$
CREATE TRIGGER tr_status_meta_ad
    AFTER DELETE ON metas_registro
    FOR EACH ROW
BEGIN
    -- Utiliza o gerente de metas para atribuir progresso adequado
    CALL spGerenteMetas(OLD.cd_meta);
END $$
delimiter ;

delimiter $$
CREATE TRIGGER tr_registroChange_au 
    AFTER UPDATE ON registro 
    FOR EACH ROW
BEGIN
    DECLARE c_cd_meta INT;
    DECLARE done_flag BOOL DEFAULT FALSE;
    
    -- Cursor para todas as metas que o registro pertence
    DECLARE cursor_metas_registro CURSOR FOR 
        select cd_meta from metas_registro where cd_registro = OLD.cd_registro;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_flag = TRUE;
    
    if(select count(*) from metas_registro where cd_registro = OLD.cd_registro > 0) then
        -- Atualiza todas as metas pertencentes ao registro
        OPEN cursor_metas_registro;
            metas_do_registro: loop
                fetch cursor_metas_registro into c_cd_meta;
                if done_flag then
                    leave metas_do_registro;
                end if;
                CALL spGerenteMetas(c_cd_meta);
            end loop metas_do_registro;
        CLOSE cursor_metas_registro;
    end if;
END $$
delimiter ;

delimiter $$
CREATE TRIGGER tr_registroChange_ad
    AFTER DELETE ON registro 
    FOR EACH ROW
BEGIN
    DECLARE c_cd_meta INT;
    DECLARE done_flag BOOL DEFAULT FALSE;
    
    -- Cursor para todas as metas que o registro pertence
    DECLARE cursor_metas_registro CURSOR FOR 
        select cd_meta from metas where cd_usuario = OLD.cd_usuario;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_flag = TRUE;
    -- Atualiza todas as metas pertencentes ao registro
    OPEN cursor_metas_registro;
        metas_do_registro: loop
            fetch cursor_metas_registro into c_cd_meta;
            if done_flag then
                leave metas_do_registro;
            end if;
            CALL spGerenteMetas(c_cd_meta);
        end loop metas_do_registro;
    CLOSE cursor_metas_registro;
END $$
delimiter ;