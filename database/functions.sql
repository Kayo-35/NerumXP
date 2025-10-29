DELIMITER $$
CREATE FUNCTION sfDespesaFlutuante(
    cd_usuario_param INT,
    dt_inicio_param DATE,
    dt_termino_param DATE,
    dt_alvo_param DATE
) RETURNS DECIMAL(12,2)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE total_var DECIMAL(12,2) DEFAULT 0;
    DECLARE qt_meses_var INT;
    DECLARE incremento_var INT;

    -- Variáveis temporárias para o cursor
    DECLARE c_cd_tipo_juros INT DEFAULT 1;
    DECLARE c_vl_valor DECIMAL(12,2) DEFAULT 0;
    DECLARE c_pc_taxa_juros DECIMAL(6,4) DEFAULT 0;
    DECLARE c_dt_vencimento DATE DEFAULT NULL;
    DECLARE c_qt_meses_incidencia INT DEFAULT 1;
    DECLARE c_created_at DATE;
    DECLARE done_flag BOOL DEFAULT FALSE;

    -- Cursor
    DECLARE cursor_flutuante CURSOR FOR
        SELECT cd_tipo_juro, vl_valor, pc_taxa_juros, dt_vencimento, qt_meses_incidencia, DATE(created_at)
        FROM registro
        WHERE cd_usuario = cd_usuario_param
          AND cd_modalidade = 2
          AND cd_tipo_registro = 2
          AND created_at BETWEEN dt_inicio_param AND dt_termino_param;

    -- Handler para fim de cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_flag = TRUE;

    OPEN cursor_flutuante;

    flutuantes_loop: LOOP
        FETCH cursor_flutuante INTO c_cd_tipo_juros, c_vl_valor, c_pc_taxa_juros, c_dt_vencimento, c_qt_meses_incidencia, c_created_at;
        IF done_flag THEN
            LEAVE flutuantes_loop;
        END IF;

        -- Calcula meses efetivos do período para inclusão de intervalo
        IF(dt_alvo_param > c_dt_vencimento) THEN
            SET qt_meses_var = PERIOD_DIFF(date_format(dt_alvo_param,'%Y%m'),
                                    date_format(c_dt_vencimento, '%Y%m')) + 1;
        ELSE
            set total_var = total_var + c_vl_valor;
            ITERATE flutuantes_loop;
        END IF;

        -- Número de incrementos de juros impostos sobre o registro
        SET incremento_var = FLOOR(qt_meses_var / c_qt_meses_incidencia);
        IF incremento_var < 1 THEN
            set total_var = total_var + c_vl_valor;
            ITERATE flutuantes_loop;
        END IF;

        -- Cálculo dos juros
        IF c_cd_tipo_juros = 1 THEN
            -- Juros simples            valor_registro + os juros aplicados durante o intervalo
            SET total_var = total_var + c_vl_valor + (c_vl_valor * (c_pc_taxa_juros/100) * incremento_var);
        ELSE
            -- Juros compostos
            SET total_var = total_var + c_vl_valor + (c_vl_valor * POW(1 + c_pc_taxa_juros/100, incremento_var) - c_vl_valor);
        END IF;

    END LOOP flutuantes_loop;

    CLOSE cursor_flutuante;

    RETURN total_var;

END$$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION sfRendaFlutuante(
    cd_usuario_param INT,
    dt_inicio_param DATE,
    dt_termino_param DATE,
    dt_alvo_param DATE
) RETURNS DECIMAL(12,2)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE total_var DECIMAL(12,2) DEFAULT 0;
    DECLARE qt_meses_var INT;
    DECLARE incremento_var INT;

    -- Variáveis temporárias para o cursor
    DECLARE c_cd_tipo_juros INT DEFAULT 1;
    DECLARE c_vl_valor DECIMAL(12,2) DEFAULT 0;
    DECLARE c_pc_taxa_juros DECIMAL(6,4) DEFAULT 0;
    DECLARE c_dt_vencimento DATE DEFAULT NULL;
    DECLARE c_qt_meses_incidencia INT DEFAULT 1;
    DECLARE c_created_at DATE;
    DECLARE done_flag BOOL DEFAULT FALSE;

    -- Cursor
    DECLARE cursor_flutuante CURSOR FOR
        SELECT cd_tipo_juro, vl_valor, pc_taxa_juros, dt_vencimento, qt_meses_incidencia, DATE(created_at)
        FROM registro
        WHERE cd_usuario = cd_usuario_param
          AND cd_modalidade = 2
          AND cd_tipo_registro = 1
          AND created_at BETWEEN dt_inicio_param AND dt_termino_param;

    -- Handler para fim de cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done_flag = TRUE;

    OPEN cursor_flutuante;

    flutuantes_loop: LOOP
        FETCH cursor_flutuante INTO c_cd_tipo_juros, c_vl_valor, c_pc_taxa_juros, c_dt_vencimento, c_qt_meses_incidencia, c_created_at;
        IF done_flag THEN
            LEAVE flutuantes_loop;
        END IF;

        -- Calcula meses efetivos do período para inclusão de intervalo
        IF c_dt_vencimento < dt_alvo_param THEN
            SET qt_meses_var = PERIOD_DIFF(date_format(c_dt_vencimento,'%Y%m'),
                                            date_format(c_created_at, '%Y%m')) + 1;
        ELSE
            SET qt_meses_var = PERIOD_DIFF(date_format(dt_alvo_param,'%Y%m'),
                                           date_format(c_created_at,'%Y%m')) + 1;
        END IF;

        -- Número de incrementos de juros impostos sobre o registro
        SET incremento_var = FLOOR(qt_meses_var / c_qt_meses_incidencia);
        IF incremento_var < 1 THEN
            set total_var = total_var + c_vl_valor;
            ITERATE flutuantes_loop;
        END IF;

        -- Cálculo dos juros
        IF c_cd_tipo_juros = 1 THEN
            -- Juros simples            valor_registro + os juros aplicados durante o intervalo
            SET total_var = total_var + c_vl_valor + (c_vl_valor * (c_pc_taxa_juros/100) * incremento_var);
        ELSE
            -- Juros compostos
            SET total_var = total_var + c_vl_valor + (c_vl_valor * POW(1 + c_pc_taxa_juros/100, incremento_var) - c_vl_valor);
        END IF;

    END LOOP flutuantes_loop;

    CLOSE cursor_flutuante;

    RETURN total_var;

END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION sfRDFixaTotal(
    cd_usuario_param INT,
    cd_tipo_registro_param INT,
    dt_inicio_param DATE,
    dt_termino_param DATE
) RETURNS DECIMAL(9,2)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE total_var DECIMAL(9,2);

    select
        sum(vl_valor)
    into
        total_var
    from
        registro
    where
        cd_usuario = cd_usuario_param and
        cd_tipo_registro = cd_tipo_registro_param and
        cd_modalidade = 1 and
        date(created_at) between dt_inicio_param and dt_termino_param;
    return total_var;
END$$
DELIMITER ;

-- Gerenciamento de metas e auxiliares
DELIMITER $$
CREATE FUNCTION sfSomatorioValorMetas(
    cd_meta_param INT
) RETURNS DECIMAL(12,2)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE somatorio_var DECIMAL(12,2) DEFAULT 0;
    select
        sum(vl_valor)
    into
        somatorio_var
    from
        registro
    where
        cd_registro in (select cd_registro from metas_registro where cd_meta = cd_meta_param);

    RETURN somatorio_var;
END
DELIMITER ;

DELIMITER $$
CREATE FUNCTION sfSomatorioValorRegistroCategoria(
    cd_categoria_param INT
) RETURNS DECIMAL(12,2)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE somatorio_var DECIMAL(12,2) DEFAULT 0;
    select
        sum(vl_valor)
    into
        somatorio_var
    from registro
    where cd_categoria = cd_categoria_param;

    RETURN somatorio_var;
END
DELIMITER ;
