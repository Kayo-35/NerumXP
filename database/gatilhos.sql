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
    IF(NEW.vl_valor_meta is not null AND NEW.vl_valor_progresso is not null) THEN
        INSERT INTO historico_metas(cd_meta,vl_alvo,vl_progresso,created_at,updated_at) VALUES
        (NEW.cd_meta,NEW.vl_valor_meta,NEW.vl_valor_progresso,NOW(),NOW());       
    ELSE 
        -- Para metas de valor percentual
        IF(NEW.pc_meta is not null AND NEW.pc_progresso is not null) THEN
            INSERT INTO historico_metas(cd_meta,vl_alvo,vl_progresso,created_at,updated_at) VALUES
            (NEW.cd_meta,NEW.vl_valor_meta,NEW.vl_valor_progresso,NOW(),NOW());          
        END IF;
    END IF;
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
    
    -- Checando sequencialmente que valor atribuir a cada variavel
    IF(NEW.vl_valor_meta <> OLD.vl_valor_meta) THEN
        SET vl_alvo_var = NEW.vl_valor_meta;
    ELSE
        SET vl_alvo_var = NULL;
    END IF;
    
    IF(NEW.vl_valor_progresso <> OLD.vl_valor_progresso) THEN
        SET vl_progresso_var = NEW.vl_valor_progresso;
    ELSE
        SET vl_progresso_var = NULL;
    END IF;
    
    IF(NEW.pc_meta <> OLD.pc_meta) THEN
        SET pc_alvo_var = NEW.pc_meta;
    ELSE
        SET pc_alvo_var = NULL;
    END IF;
    
    IF(NEW.pc_progresso <> OLD.pc_progresso) THEN
        SET pc_progresso_var = NEW.pc_progresso;
    ELSE
        SET pc_progresso_var = NULL;
    END IF;
    
    IF(pc_progresso_var is not null OR pc_alvo_var is not null OR vl_progresso_var is not null OR vl_alvo_var is not null) THEN
        INSERT INTO historico_metas(cd_meta,vl_alvo,vl_progresso,pc_alvo,pc_progresso,created_at,updated_at) VALUES
        (NEW.cd_meta,vl_alvo_var,vl_progresso_var,pc_alvo_var,pc_progresso_var,NEW.created_at,NEW.updated_at());
    END IF;
END
delimiter ;