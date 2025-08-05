CREATE TABLE `assinatura` ( 
  `cd_assinatura` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_assinatura` VARCHAR(30) NOT NULL,
   PRIMARY KEY (`cd_assinatura`)
)
ENGINE = InnoDB;
CREATE TABLE `categoria` ( 
  `cd_categoria` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_categoria` VARCHAR(50) NOT NULL,
   PRIMARY KEY (`cd_categoria`)
)
ENGINE = InnoDB;
CREATE TABLE `forma_pagamento` ( 
  `cd_tipo_forma` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_tipo_metodos` VARCHAR(50) NOT NULL,
   PRIMARY KEY (`cd_tipo_forma`)
)
ENGINE = InnoDB;
CREATE TABLE `historico` ( 
  `cd_historico` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `cd_origem_fixo` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_origem_flutuante` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_tipo_hist` BIGINT UNSIGNED NOT NULL,
  `vl_valor` DECIMAL(9,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_historico`)
)
ENGINE = InnoDB;
CREATE TABLE `localizacao` ( 
  `cd_localizacao` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_localizacao` VARCHAR(50) NOT NULL,
   PRIMARY KEY (`cd_localizacao`)
)
ENGINE = InnoDB;
CREATE TABLE `metas` ( 
  `cd_metas` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `cd_nivel_imp` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `nm_meta` VARCHAR(50) NOT NULL,
  `dt_termino` DATE NULL DEFAULT NULL ,
  `ic_status` TINYINT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_metas`)
)
ENGINE = InnoDB;
CREATE TABLE `metas_projeto` ( 
  `cd_metas` BIGINT UNSIGNED NOT NULL,
  `cd_projeto` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_metas`, `cd_projeto`)
)
ENGINE = InnoDB;
CREATE TABLE `metas_reg_fixo` ( 
  `cd_metas` BIGINT UNSIGNED NOT NULL,
  `cd_registro_fixo` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_metas`, `cd_registro_fixo`)
)
ENGINE = InnoDB;
CREATE TABLE `metas_reg_flut` ( 
  `cd_registro_flutuante` BIGINT UNSIGNED NOT NULL,
  `cd_metas` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_registro_flutuante`, `cd_metas`)
)
ENGINE = InnoDB;
CREATE TABLE `metodo_pagamento` ( 
  `cd_tipo_metodo` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_tipo_metodo` VARCHAR(50) NOT NULL,
   PRIMARY KEY (`cd_tipo_metodo`)
)
ENGINE = InnoDB;
CREATE TABLE `migrations` ( 
  `id` INT UNSIGNED AUTO_INCREMENT NOT NULL,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
   PRIMARY KEY (`id`)
)
ENGINE = InnoDB;
CREATE TABLE `nivel_imp` ( 
  `cd_nivel_imp` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `sg_nivel_imp` CHAR(2) NOT NULL,
   PRIMARY KEY (`cd_nivel_imp`),
  CONSTRAINT `nivel_imp_sg_nivel_imp_unique` UNIQUE (`sg_nivel_imp`)
)
ENGINE = InnoDB;
CREATE TABLE `panorama` ( 
  `cd_resumo` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
  `cd_usuario` BIGINT UNSIGNED NOT NULL,
  `vl_debito` DECIMAL(9,2) NOT NULL,
  `vl_superavit` DECIMAL(9,2) NOT NULL,
  `balanco` DECIMAL(9,2) NOT NULL,
   PRIMARY KEY (`cd_resumo`)
)
ENGINE = InnoDB;
CREATE TABLE `projeto` ( 
  `cd_projeto` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `ds_tema_projeto` TINYTEXT NOT NULL,
   PRIMARY KEY (`cd_projeto`)
)
ENGINE = InnoDB;
CREATE TABLE `realizador_transacao` ( 
  `cd_realizador` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_realizador` VARCHAR(100) NOT NULL,
  `ds_realizador` TINYTEXT NOT NULL,
   PRIMARY KEY (`cd_realizador`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_fix_metodoP` ( 
  `cd_tipo_metodo` BIGINT UNSIGNED NOT NULL,
  `cd_registro_fixo` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_tipo_metodo`, `cd_registro_fixo`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_fix_tipoP` ( 
  `cd_tipo_forma` BIGINT UNSIGNED NOT NULL,
  `cd_registro_fixo` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_tipo_forma`, `cd_registro_fixo`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_fixo` ( 
  `cd_registro_fixo` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `cd_usuario` BIGINT UNSIGNED NOT NULL,
  `cd_tipo_registro` BIGINT UNSIGNED NOT NULL,
  `cd_nivel_imp` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_categoria` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_localizacao` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_realizador` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `nm_registroFixo` VARCHAR(30) NOT NULL,
  `vl_valor` DECIMAL(9,2) NOT NULL,
  `ic_pago` TINYINT NOT NULL,
  `ic_status` TINYINT NOT NULL,
  `dt_pagamento` DATE NULL DEFAULT NULL ,
  `ds_descricao` TINYTEXT NOT NULL,
  `qt_parcelas` TINYINT NULL DEFAULT NULL ,
  `qt_parcelas_pagas` TINYINT NULL DEFAULT NULL ,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_registro_fixo`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_flut_metodoP` ( 
  `cd_tipo_metodo` BIGINT UNSIGNED NOT NULL,
  `cd_registro_flut` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_tipo_metodo`, `cd_registro_flut`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_flut_tipoP` ( 
  `cd_registro_flutuante` BIGINT UNSIGNED NOT NULL,
  `cd_tipo_forma` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_registro_flutuante`, `cd_tipo_forma`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_flutuante` ( 
  `cd_registro_flutuante` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
  `cd_usuario` BIGINT UNSIGNED NOT NULL,
  `cd_tipo_registro` BIGINT UNSIGNED NOT NULL,
  `cd_tipo_juro` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_nivel_imp` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_categoria` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_localizacao` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `cd_realizador` BIGINT UNSIGNED NULL DEFAULT NULL ,
  `nm_registro_flutuante` VARCHAR(30) NOT NULL,
  `vl_valor_registro` DECIMAL(9,2) NOT NULL,
  `ic_pago` TINYINT NOT NULL,
  `ic_status` TINYINT NOT NULL,
  `pc_taxa_juros` DECIMAL(6,3) NOT NULL,
  `qt_parcelas` TINYINT NULL DEFAULT NULL ,
  `qt_parcelas_pagas` TINYINT NULL DEFAULT NULL ,
  `dt_pagamento` DATE NULL DEFAULT NULL ,
  `dt_vencimento` DATE NULL DEFAULT NULL ,
  `ds_descricao` TINYTEXT NOT NULL,
   PRIMARY KEY (`cd_registro_flutuante`)
)
ENGINE = InnoDB;
CREATE TABLE `registro_tipo_juros` ( 
  `cd_tipo_juro` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_tipo_juro` VARCHAR(30) NOT NULL,
   PRIMARY KEY (`cd_tipo_juro`)
)
ENGINE = InnoDB;
CREATE TABLE `tipo_historico` ( 
  `cd_tipo_hist` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_tipo_hist` VARCHAR(30) NOT NULL,
   PRIMARY KEY (`cd_tipo_hist`)
)
ENGINE = InnoDB;
CREATE TABLE `tipo_registro` ( 
  `cd_tipo_registro` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `nm_tipo` VARCHAR(30) NOT NULL,
   PRIMARY KEY (`cd_tipo_registro`)
)
ENGINE = InnoDB;
CREATE TABLE `usuario` ( 
  `cd_usuario` BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
  `cd_assinatura` BIGINT UNSIGNED NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL ,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL ,
  `nm_usuario` VARCHAR(50) NOT NULL,
  `dt_nascimento` DATE NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL ,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ,
   PRIMARY KEY (`cd_usuario`),
  CONSTRAINT `usuario_email_unique` UNIQUE (`email`)
)
ENGINE = InnoDB;
ALTER TABLE `historico` ADD CONSTRAINT `historico_cd_origem_flutuante_foreign` FOREIGN KEY (`cd_origem_flutuante`) REFERENCES `registro_flutuante` (`cd_registro_flutuante`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `historico` ADD CONSTRAINT `historico_cd_tipo_hist_foreign` FOREIGN KEY (`cd_tipo_hist`) REFERENCES `tipo_historico` (`cd_tipo_hist`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `historico` ADD CONSTRAINT `historico_cd_origem_fixo_foreign` FOREIGN KEY (`cd_origem_fixo`) REFERENCES `registro_fixo` (`cd_registro_fixo`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas` ADD CONSTRAINT `metas_cd_nivel_imp_foreign` FOREIGN KEY (`cd_nivel_imp`) REFERENCES `nivel_imp` (`cd_nivel_imp`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas_projeto` ADD CONSTRAINT `metas_projeto_cd_metas_foreign` FOREIGN KEY (`cd_metas`) REFERENCES `metas` (`cd_metas`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas_projeto` ADD CONSTRAINT `metas_projeto_cd_projeto_foreign` FOREIGN KEY (`cd_projeto`) REFERENCES `projeto` (`cd_projeto`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas_reg_fixo` ADD CONSTRAINT `metas_reg_fixo_cd_metas_foreign` FOREIGN KEY (`cd_metas`) REFERENCES `metas` (`cd_metas`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas_reg_fixo` ADD CONSTRAINT `metas_reg_fixo_cd_registro_fixo_foreign` FOREIGN KEY (`cd_registro_fixo`) REFERENCES `registro_fixo` (`cd_registro_fixo`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas_reg_flut` ADD CONSTRAINT `metas_reg_flut_cd_registro_flutuante_foreign` FOREIGN KEY (`cd_registro_flutuante`) REFERENCES `registro_flutuante` (`cd_registro_flutuante`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `metas_reg_flut` ADD CONSTRAINT `metas_reg_flut_cd_metas_foreign` FOREIGN KEY (`cd_metas`) REFERENCES `metas` (`cd_metas`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `panorama` ADD CONSTRAINT `panorama_cd_usuario_foreign` FOREIGN KEY (`cd_usuario`) REFERENCES `usuario` (`cd_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fix_metodoP` ADD CONSTRAINT `registro_fix_metodop_cd_tipo_metodo_foreign` FOREIGN KEY (`cd_tipo_metodo`) REFERENCES `metodo_pagamento` (`cd_tipo_metodo`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fix_metodoP` ADD CONSTRAINT `registro_fix_metodop_cd_registro_fixo_foreign` FOREIGN KEY (`cd_registro_fixo`) REFERENCES `registro_fixo` (`cd_registro_fixo`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fix_tipoP` ADD CONSTRAINT `registro_fix_tipop_cd_registro_fixo_foreign` FOREIGN KEY (`cd_registro_fixo`) REFERENCES `registro_fixo` (`cd_registro_fixo`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fix_tipoP` ADD CONSTRAINT `registro_fix_tipop_cd_tipo_forma_foreign` FOREIGN KEY (`cd_tipo_forma`) REFERENCES `forma_pagamento` (`cd_tipo_forma`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fixo` ADD CONSTRAINT `registro_fixo_cd_categoria_foreign` FOREIGN KEY (`cd_categoria`) REFERENCES `categoria` (`cd_categoria`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fixo` ADD CONSTRAINT `registro_fixo_cd_realizador_foreign` FOREIGN KEY (`cd_realizador`) REFERENCES `realizador_transacao` (`cd_realizador`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fixo` ADD CONSTRAINT `registro_fixo_cd_localizacao_foreign` FOREIGN KEY (`cd_localizacao`) REFERENCES `localizacao` (`cd_localizacao`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fixo` ADD CONSTRAINT `registro_fixo_cd_tipo_registro_foreign` FOREIGN KEY (`cd_tipo_registro`) REFERENCES `tipo_registro` (`cd_tipo_registro`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fixo` ADD CONSTRAINT `registro_fixo_cd_nivel_imp_foreign` FOREIGN KEY (`cd_nivel_imp`) REFERENCES `nivel_imp` (`cd_nivel_imp`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_fixo` ADD CONSTRAINT `registro_fixo_cd_usuario_foreign` FOREIGN KEY (`cd_usuario`) REFERENCES `usuario` (`cd_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flut_metodoP` ADD CONSTRAINT `registro_flut_metodop_cd_registro_flut_foreign` FOREIGN KEY (`cd_registro_flut`) REFERENCES `registro_flutuante` (`cd_registro_flutuante`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flut_metodoP` ADD CONSTRAINT `registro_flut_metodop_cd_tipo_metodo_foreign` FOREIGN KEY (`cd_tipo_metodo`) REFERENCES `metodo_pagamento` (`cd_tipo_metodo`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flut_tipoP` ADD CONSTRAINT `registro_flut_tipop_cd_registro_flutuante_foreign` FOREIGN KEY (`cd_registro_flutuante`) REFERENCES `registro_flutuante` (`cd_registro_flutuante`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flut_tipoP` ADD CONSTRAINT `registro_flut_tipop_cd_tipo_forma_foreign` FOREIGN KEY (`cd_tipo_forma`) REFERENCES `forma_pagamento` (`cd_tipo_forma`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_categoria_foreign` FOREIGN KEY (`cd_categoria`) REFERENCES `categoria` (`cd_categoria`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_realizador_foreign` FOREIGN KEY (`cd_realizador`) REFERENCES `realizador_transacao` (`cd_realizador`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_usuario_foreign` FOREIGN KEY (`cd_usuario`) REFERENCES `usuario` (`cd_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_localizacao_foreign` FOREIGN KEY (`cd_localizacao`) REFERENCES `localizacao` (`cd_localizacao`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_tipo_juro_foreign` FOREIGN KEY (`cd_tipo_juro`) REFERENCES `registro_tipo_juros` (`cd_tipo_juro`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_nivel_imp_foreign` FOREIGN KEY (`cd_nivel_imp`) REFERENCES `nivel_imp` (`cd_nivel_imp`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `registro_flutuante` ADD CONSTRAINT `registro_flutuante_cd_tipo_registro_foreign` FOREIGN KEY (`cd_tipo_registro`) REFERENCES `tipo_registro` (`cd_tipo_registro`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `usuario` ADD CONSTRAINT `usuario_cd_assinatura_foreign` FOREIGN KEY (`cd_assinatura`) REFERENCES `assinatura` (`cd_assinatura`) ON DELETE CASCADE ON UPDATE RESTRICT;
