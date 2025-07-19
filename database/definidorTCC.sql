CREATE DATABASE db_tcc;
USE db_tcc;
DROP DATABASE db_tcc;

-- Seria como avaliações com estrelas, ou outra unidade, para indicar grau de importância ou eficiência, sua utilização seria coringa
CREATE TABLE nivel_imp (
cd_nivel_imp INT NOT NULL AUTO_INCREMENT,
sg_nivel_imp CHAR(1),

CONSTRAINT pk_nivel_imp
	PRIMARY KEY(cd_nivel_imp)
);

-- Contém tipos de histórico
CREATE TABLE tipo_historio (
cd_tipo_his INT UNSIGNED NOT NULL,
nm_tipo_hist VARCHAR(30) NOT NULL,

CONSTRAINT pk_tipo_historico
	PRIMARY KEY(cd_tipo_his)
);

-- Armazenaria quem realizou as transições
CREATE TABLE realizador_transacao (
cd_realizador INT NOT NULL,
nm_realizador VARCHAR(100) NOT NULL,
ds_realizador TINYTEXT,
CONSTRAINT pk_realizador
	PRIMARY KEY(cd_realizador)
);

-- Categorias seriam que áreas os registros financeiros seriam associados
CREATE TABLE categoria (
cd_categoria INT NOT NULL,
nm_categoria VARCHAR(50) NOT NULL,

CONSTRAINT pk_categoria
	PRIMARY KEY(cd_categoria)
);

-- Em que país foi realizado/obtido o registro, util para filtragem e definição da moeda utilizada
CREATE TABLE localizacao (
cd_localizacao INT NOT NULL,
nm_localizacao VARCHAR(50),

CONSTRAINT pk_localizacao
	PRIMARY KEY(cd_localizacao)
);

-- Cartões, transferências, etc
CREATE TABLE tipo_m_pagamento (
cd_tipo_metodo INT NOT NULL,
nm_tipo_metodo VARCHAR(50),

CONSTRAINT pk_tipo_m_pagamento
	PRIMARY KEY(cd_tipo_metodo)
);

-- A vista, parcelado, misto, etc
CREATE TABLE tipo_f_pagamento (
cd_tipo_forma INT NOT NULL,
nm_tipo_forma VARCHAR(50),

CONSTRAINT pk_tipo_f_pagamento
	PRIMARY KEY(cd_tipo_forma)
);

-- Ganho ou despesa
CREATE TABLE tipo_registro(
cd_tipo_registro INT NOT NULL,
nm_tipo VARCHAR(30),

CONSTRAINT pk_tipo
	PRIMARY KEY(cd_tipo_registro)
);

-- Simples, compostos, etc
CREATE TABLE tipo_juro(
cd_tipo_juro INT NOT NULL,
nm_tipo_juro VARCHAR(30),

CONSTRAINT pk_tipo_juro
	PRIMARY KEY(cd_tipo_juro)
);

-- Ainda temos de verificar isso, mas seriam os niveis de assinatura
CREATE TABLE assinatura(
cd_assinatura INT NOT NULL,
nm_assinatura VARCHAR(30),

CONSTRAINT pk_assinatura
	PRIMARY KEY(cd_assinatura)
);

-- Conjuntos de metas, como por exemplo aquelas que permitiriam um usuário realizar uma viagem
CREATE TABLE projeto (
cd_projeto INT NOT NULL,
ds_tema_projeto TINYTEXT,

CONSTRAINT pk_projeto
	PRIMARY KEY(cd_projeto)
);

-- Armazena histórico de valores(util para metas)
CREATE TABLE historico (
cd_historico INT UNSINGED NOT NULL,
cd_origem_fixo INT UNSIGNED,
cd_origem_flut INT UNSINGED,

vl_valor DECIMAL(9,2) NOT NULL,
dt_edicao DATE NOT NULL

CONSTRAINT pk_historico
	PRIMARY KEY(cd_historico)
CONSTRAINT fk_fixo_historico
	FOREIGN KEY(cd_origem_fixo)
		REFERENCES registro_fixo(cd_registro_fixo)
CONSTRAINT fk_flut_historico
	FOREIGN KEY(cd_origem_flut)
		REFERENCES registro_flutuante(cd_registro_flutuante)
);

-- Objetivos baseados em registros
CREATE TABLE metas (
cd_metas INT NOT NULL,
cd_nivel_imp INT,
nm_meta VARCHAR(50),
-- dt_meta_criacao DATE,TimeStamps já inclui
dt_termino DATE,
ic_status BOOL,
ds_descricao TINYTEXT,
-- TimeStamps Laravel
created_at TIMESTAMP,
updated_at TIMESTAMP,

CONSTRAINT pk_metas
	PRIMARY KEY(cd_metas),
CONSTRAINT fk_imp_metas
	FOREIGN KEY(cd_nivel_imp)
		REFERENCES nivel_imp(cd_nivel_imp)
);

-- Associa projetos a metas ****
CREATE TABLE proj_metas (
cd_projeto INT NOT NULL,
cd_metas INT NOT NULL,
ds_tema_projeto TEXT,
qt_metas_projeto TINYINT(255),

CONSTRAINT pk_proj_metas
	PRIMARY KEY(cd_projeto,cd_metas),
CONSTRAINT fk_proj
	FOREIGN KEY(cd_projeto)
		REFERENCES projeto(cd_projeto),
CONSTRAINT fk_metas
	FOREIGN KEY(cd_metas)
		REFERENCES metas(cd_metas)
);

-- Bem essa é autoexplicativa
CREATE TABLE usuario (
cd_usuario INT NOT NULL AUTO_INCREMENT,
cd_assinatura INT NOT NULL,

password VARCHAR(255),
email VARCHAR(255) UNIQUE;
email_verified_at TIMESTAMP,
remember_token VARCHAR(100),
nm_usuario VARCHAR(100),
dt_nascimento DATE,
created_at TIMESTAMP NULL,
update_at TIMESTAMP NULL,

CONSTRAINT pk_usuario
	PRIMARY KEY(cd_usuario),
CONSTRAINT fk_assinatura_usuario
	FOREIGN KEY(cd_assinatura)
		REFERENCES assinatura(cd_assinatura)
);

-- Registros afetados por juros
CREATE TABLE registro_flutuante (
cd_registro_flutuante INT NOT NULL,
cd_usuario INT NOT NULL,
cd_tipo_registro INT NOT NULL,
cd_tipo_juro INT NOT NULL,
cd_nivel_imp INT,
cd_categoria INT,
cd_localizacao INT,
cd_realizador INT,

vl_valor_registro DECIMAL(9,2),
ic_pago BOOL NOT NULL,
nm_registro_flutuante VARCHAR(30),
ic_status BOOL NOT NULL,
pc_taxa_juros DECIMAL(5,3) NOT NULL,
dt_pagamento DATE,
-- dt_registro DATE, TimeStamps já inclui
dt_vencimento DATE,
ds_descricao TINYTEXT,

-- PRESENTES ATRIBUTOS SÃO ASSOCIADOS APENAS A TUPLAS QUE ATENDEM AO TRIGGER 1, A SER CRIADO :)
qt_parcelas TINYINT,
qt_parcelas_pagas TINYINT,

CONSTRAINT pk_registro_flutuante
	PRIMARY KEY(cd_registro_flutuante),
CONSTRAINT fk_usuario_reg_fixo
	FOREIGN KEY(cd_usuario)
		REFERENCES usuario(cd_usuario),
CONSTRAINT fk_tipo_registro
	FOREIGN KEY(cd_tipo_registro)
		REFERENCES tipo_registro(cd_tipo_registro),
CONSTRAINT fk_tipo_juro_registro
	FOREIGN KEY(cd_tipo_juro)
		REFERENCES tipo_juro(cd_tipo_juro),
CONSTRAINT fk_categoria_registroFlut
	FOREIGN KEY(cd_categoria)
		REFERENCES categoria(cd_categoria),
CONSTRAINT fk_localizacao_registroFlut
	FOREIGN KEY(cd_localizacao)
		REFERENCES localizacao(cd_localizacao),
CONSTRAINT fk_realizador_flut
	FOREIGN KEY(cd_realizador)
		REFERENCES realizador_transacao(cd_realizador)
);

-- Registros basicos
CREATE TABLE registro_fixo(
cd_registro_fixo INT NOT NULL,
cd_usuario INT NOT NULL,
cd_tipo_registro INT NOT NULL,
cd_nivel_imp INT,
cd_categoria INT,
cd_localizacao INT,
cd_realizador INT,

nm_registro_fixo VARCHAR(30),
vl_valor DECIMAL(9,2),
ic_pago BOOL,
ic_status BOOL,
dt_pagamento DATE,
ds_descricao TINYTEXT,
-- dt_registro DATE, (substituido pelos timestamps)

-- TimeStamps Laravel
created_at TIMESTAMP,
updated_at TIMESTAMP,
-- ATRIBUTOS ABAIXO SERÃO PREENCHIDOS APENAS SE ATENDEREM A CONDIÇÃO LÓGICA DOS TRIGGER 2, A SER CRIADO :)
qt_parcelas TINYINT,
qt_parcelas_pagas TINYINT,

CONSTRAINT pk_registro_fixo
	PRIMARY KEY(cd_registro_fixo),
CONSTRAINT fk_usuario_registro_fixo
	FOREIGN KEY(cd_usuario)
		REFERENCES usuario(cd_usuario),
CONSTRAINT fk_categoria_registro_fixo
	FOREIGN KEY(cd_categoria)
		REFERENCES categoria(cd_categoria),
CONSTRAINT fk_localizacao_registroFixo
	FOREIGN KEY(cd_localizacao)
		REFERENCES localizacao(cd_localizacao),
CONSTRAINT fk_realizador_fixo
	FOREIGN KEY(cd_realizador)
		REFERENCES realizador_transacao(cd_realizador)
);

-- Associativa
CREATE TABLE metas_reg_flut(
cd_registro_flutuante INT NOT NULL,
cd_metas INT NOT NULL,

CONSTRAINT pk_metas_reg_flut
	PRIMARY KEY(cd_registro_flutuante,cd_metas),
CONSTRAINT fk_registroFlutuante
	FOREIGN KEY(cd_registro_flutuante)
		REFERENCES registro_flutuante(cd_registro_flutuante),
CONSTRAINT fk_metas_reg
	FOREIGN KEY(cd_metas)
		REFERENCES metas(cd_metas)
);

-- Associativa
CREATE TABLE metas_reg_fixo(
cd_registro_fixo INT NOT NULL,
cd_metas INT NOT NULL,

CONSTRAINT pk_metas_reg_fixo
	PRIMARY KEY(cd_registro_fixo),
CONSTRAINT fk_registro_fixo_metas
	FOREIGN KEY(cd_registro_fixo)
		REFERENCES registro_fixo(cd_registro_fixo),
CONSTRAINT fk_metas_regFixo
	FOREIGN KEY(cd_metas)
		REFERENCES metas(cd_metas)
);

-- Associativa
CREATE TABLE registro_flut_tipoP (
cd_tipo_forma INT NOT NULL,
cd_registro_flut INT NOT NULL,

CONSTRAINT pk_regFlut_tipoP
	PRIMARY KEY(cd_tipo_forma,cd_registro_flut),
CONSTRAINT fk_registro_flut_tipoP
	FOREIGN KEY(cd_registro_flut)
		REFERENCES registro_flutuante(cd_registro_flutuante),
CONSTRAINT fk_registro_flut_inOut
	FOREIGN KEY(cd_tipo_forma)
		REFERENCES tipo_f_pagamento(cd_tipo_forma)
);

-- Mesma coisa
CREATE TABLE reg_flut_mtpgto (
cd_tipo_metodo INT NOT NULL,
cd_registro_flut INT NOT NULL,

CONSTRAINT pk_reg_flut_mtpgto
	PRIMARY KEY(cd_tipo_metodo,cd_registro_flut),
CONSTRAINT fk_regFlut
	FOREIGN KEY(cd_registro_flut)
		REFERENCES registro_flutuante(cd_registro_flutuante),
CONSTRAINT fk_regFlut_metodo
	FOREIGN KEY(cd_tipo_metodo)
		REFERENCES tipo_m_pagamento(cd_tipo_metodo)
);

-- msm coisa
CREATE TABLE reg_fix_mtpgto(
cd_tipo_metodo INT NOT NULL,
cd_registro_fixo INT NOT NULL,

CONSTRAINT pk_reg_fix_mtpgto
	PRIMARY KEY reg_fix_mtpgto(cd_tipo_metodo,cd_registro_fixo),
CONSTRAINT fk_reg_fixo
	FOREIGN KEY(cd_registro_fixo)
		REFERENCES registro_fixo(cd_registro_fixo),
CONSTRAINT fk_tipo_metodo
	FOREIGN KEY(cd_tipo_metodo)
		REFERENCES tipo_m_pagamento(cd_tipo_metodo)
);
-- msm coisa
CREATE TABLE registro_fixo_tipoP(
cd_tipo_fixo INT NOT NULL,
cd_tipo_forma INT NOT NULL,

CONSTRAINT pk_registro_fixo_tipo
	PRIMARY KEY(cd_tipo_fixo,cd_tipo_forma),
CONSTRAINT fk_flut_tipo_c
	FOREIGN KEY(cd_tipo_fixo)
		REFERENCES registro_fixo(cd_registro_fixo),
CONSTRAINT fk_fixo_tipo_c
	FOREIGN KEY(cd_tipo_forma)
		REFERENCES tipo_f_pagamento(cd_tipo_forma)
);

CREATE TABLE resumoGeral (
	cd_resumo INT NOT NULL,
	cd_usuario INT NOT NULL,
    vl_debito DECIMAL(9,2),
    vl_superavit DECIMAL(9,2),
    vl_balanco DECIMAL(9,2),

    CONSTRAINT pk_resumo_geral
		PRIMARY KEY(cd_resumo),
	CONSTRAINT fk_resumo_usuario
		FOREIGN KEY(cd_usuario)
			REFERENCES usuario(cd_usuario)
);
