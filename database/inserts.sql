-- Script SQL para inserção de dados de exemplo na base de dados
-- Gerado em: 2024-07-19 (Revisado)

-- Inserções para a tabela 'assinatura'
INSERT INTO `assinatura` (`nm_assinatura`) VALUES
('Bronze'),
('Prata'),
('Ouro');

-- Inserções para a tabela 'nivel_imp'
INSERT INTO `nivel_imp` (`sg_nivel_imp`) VALUES
('N1'),
('N2'),
('N3'),
('N4'),
('N5');

-- Inserções para a tabela 'categoria'
INSERT INTO `categoria` (`nm_categoria`) VALUES
('Alimentação'),
('Transporte'),
('Moradia'),
('Saúde'),
('Educação'),
('Lazer'),
('Salário'),
('Investimento'),
('Outros');

-- Inserções para a tabela 'forma_pagamento' (Apenas Parcelado ou À Vista)
INSERT INTO `forma_pagamento` (`nm_tipo_metodos`) VALUES
('Parcelado'),
('À Vista');

-- Inserções para a tabela 'localizacao'
INSERT INTO `localizacao` (`nm_localizacao`) VALUES
('Casa'),
('Trabalho'),
('Supermercado'),
('Restaurante'),
('Online'),
('Academia'),
('Viagem');

-- Inserções para a tabela 'metodo_pagamento'
INSERT INTO `metodo_pagamento` (`nm_tipo_metodo`) VALUES
('Cartão de Crédito'),
('Cartão de Débito'),
('Dinheiro em Espécie'),
('Transferência Bancária'),
('Pix');

-- Inserções para a tabela 'realizador_transacao' (Quem fez o registro e detalhes do evento)
INSERT INTO `realizador_transacao` (`nm_realizador`, `ds_realizador`) VALUES
('João Silva', 'Registro feito pelo próprio João'),
('Maria Souza', 'Registro feito pela própria Maria'),
('Esposa de João', 'Registro de despesa de casa'),
('Irmã de Maria', 'Registro de compra para presente'),
('Filho de João', 'Registro de mesada recebida'),
('Amigo de Maria', 'Registro de despesa de lazer');

-- Inserções para a tabela 'registro_tipo_juros'
INSERT INTO `registro_tipo_juros` (`nm_tipo_juro`) VALUES
('Simples'),
('Composto');

-- Inserções para a tabela 'tipo_historico'
INSERT INTO `tipo_historico` (`nm_tipo_hist`) VALUES
('Receita'),
('Despesa'),
('Transferência');

-- Inserções para a tabela 'tipo_registro' (Apenas Despesa ou Renda)
INSERT INTO `tipo_registro` (`nm_tipo`) VALUES
('Renda'),
('Despesa');

-- Inserções para a tabela 'usuario'
-- Usuário 1: Baixo poder aquisitivo (Assinatura Bronze)
INSERT INTO `usuario` (`cd_assinatura`, `password`, `email`, `email_verified_at`, `remember_token`, `nm_usuario`, `dt_nascimento`, `created_at`, `updated_at`) VALUES
(1,
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
',
'joao.silva@email.com',
'2023-01-15 10:00:00',
NULL,
'João Silva',
'1985-03-20',
'2023-01-15 10:00:00',
'2023-01-15 10:00:00');

-- Usuário 2: Classe média alta (Assinatura Ouro)
INSERT INTO `usuario` (`cd_assinatura`, `password`, `email`, `email_verified_at`, `remember_token`, `nm_usuario`, `dt_nascimento`, `created_at`, `updated_at`) VALUES
(3,
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
',
'maria.souza@email.com',
'1990-07-10',
NULL,
'Maria Souza',
'1990-07-10',
'2023-01-15 10:00:00',
'2023-01-15 10:00:00');

-- Inserções para a tabela 'registro_fixo' (Usuário 1: João Silva - Baixo poder aquisitivo)
INSERT INTO `registro_fixo` (`cd_usuario`, `cd_tipo_registro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registroFixo`, `vl_valor`, `ic_pago`, `ic_status`, `dt_pagamento`, `ds_descricao`, `qt_parcelas`, `qt_parcelas_pagas`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 1, 1, 1, 'Aluguel', 800.00, 1, 1, '2024-07-05', 'Aluguel mensal', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 2, 2, 1, 3, 'Transporte', 150.00, 1, 1, '2024-07-05', 'Gastos com transporte público', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 1, 4, 7, 4, 1, 'Salário', 1500.00, 1, 1, '2024-07-05', 'Salário mensal', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 3, 3, 1, 3, 'Contas de Consumo', 200.00, 1, 1, '2024-07-10', 'Água, luz, gás', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 1, 1, 3, 1, 'Compras Essenciais', 300.00, 1, 1, '2024-07-15', 'Compras de supermercado', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00');

-- Inserções para a tabela 'registro_fixo' (Usuário 2: Maria Souza - Classe média alta)
INSERT INTO `registro_fixo` (`cd_usuario`, `cd_tipo_registro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registroFixo`, `vl_valor`, `ic_pago`, `ic_status`, `dt_pagamento`, `ds_descricao`, `qt_parcelas`, `qt_parcelas_pagas`, `created_at`, `updated_at`) VALUES
(2, 2, 5, 3, 1, 2, 'Financiamento Imóvel', 3500.00, 1, 1, '2024-07-05', 'Parcela do financiamento da casa', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 4, 2, 1, 2, 'Financiamento Carro', 1200.00, 1, 1, '2024-07-05', 'Parcela do financiamento do carro', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 1, 5, 7, 4, 2, 'Salário', 8000.00, 1, 1, '2024-07-05', 'Salário mensal', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 3, 9, 5, 4, 'Assinatura Streaming', 50.00, 1, 1, '2024-07-10', 'Assinatura de serviços de streaming', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 2, 4, 1, 2, 'Plano de Saúde', 400.00, 1, 1, '2024-07-15', 'Plano de saúde familiar', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00');

-- Inserções para a tabela 'registro_flutuante' (Usuário 1: João Silva - Baixo poder aquisitivo)
INSERT INTO `registro_flutuante` (`cd_usuario`, `cd_tipo_registro`, `cd_tipo_juro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registro_flutuante`, `vl_valor_registro`, `ic_pago`, `ic_status`, `pc_taxa_juros`, `dt_pagamento`, `dt_vencimento`, `ds_descricao`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2, 6, 4, 3, 'Lanche', 30.00, 1, 1, 0.000, '2024-07-02', '2024-07-02', 'Lanche na padaria', '2024-07-02 00:00:00', '2024-07-02 00:00:00'),
(1, 2, NULL, 1, 1, 3, 1, 'Compra Extra Supermercado', 80.00, 1, 1, 0.000, '2024-07-08', '2024-07-08', 'Compras extras para casa', '2024-07-08 00:00:00', '2024-07-08 00:00:00'),
(1, 1, NULL, 3, 9, 1, 5, 'Bico', 200.00, 1, 1, 0.000, '2024-07-12', '2024-07-12', 'Trabalho extra', '2024-07-12 00:00:00', '2024-07-12 00:00:00');

-- Inserções para a tabela 'registro_flutuante' (Usuário 2: Maria Souza - Classe média alta)
INSERT INTO `registro_flutuante` (`cd_usuario`, `cd_tipo_registro`, `cd_tipo_juro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registro_flutuante`, `vl_valor_registro`, `ic_pago`, `ic_status`, `pc_taxa_juros`, `dt_pagamento`, `dt_vencimento`, `ds_descricao`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 4, 6, 4, 2, 'Jantar Restaurante', 250.00, 1, 1, 0.000, '2024-07-03', '2024-07-03', 'Jantar em restaurante sofisticado', '2024-07-03 00:00:00', '2024-07-03 00:00:00'),
(2, 2, NULL, 3, 9, 5, 4, 'Compras Online', 500.00, 1, 1, 0.000, '2024-07-09', '2024-07-09', 'Compras de roupas e acessórios', '2024-07-09 00:00:00', '2024-07-09 00:00:00'),
(2, 1, NULL, 5, 8, 1, 2, 'Rendimento Investimento', 1000.00, 1, 1, 0.000, '2024-07-14', '2024-07-14', 'Rendimento de aplicação financeira', '2024-07-14 00:00:00', '2024-07-14 00:00:00');

-- Inserções para a tabela 'historico'
-- Histórico para João Silva (usuário 1)
INSERT INTO `historico` (`cd_origem_fixo`, `cd_origem_flutuante`, `cd_tipo_hist`, `vl_valor`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 800.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(2, NULL, 2, 150.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(3, NULL, 1, 1500.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(NULL, 1, 2, 30.00, '2024-07-02 00:00:00', '2024-07-02 00:00:00'),
(NULL, 2, 2, 80.00, '2024-07-08 00:00:00', '2024-07-08 00:00:00'),
(NULL, 3, 1, 200.00, '2024-07-12 00:00:00', '2024-07-12 00:00:00');

-- Histórico para Maria Souza (usuário 2)
INSERT INTO `historico` (`cd_origem_fixo`, `cd_origem_flutuante`, `cd_tipo_hist`, `vl_valor`, `created_at`, `updated_at`) VALUES
(4, NULL, 2, 3500.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(5, NULL, 2, 1200.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(6, NULL, 1, 8000.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(NULL, 4, 2, 250.00, '2024-07-03 00:00:00', '2024-07-03 00:00:00'),
(NULL, 5, 2, 500.00, '2024-07-09 00:00:00', '2024-07-09 00:00:00'),
(NULL, 6, 1, 1000.00, '2024-07-14 00:00:00', '2024-07-14 00:00:00');

-- Inserções para a tabela 'metas' (Usuário 1: João Silva - Baixo poder aquisitivo)
INSERT INTO `metas` (`cd_nivel_imp`, `nm_meta`, `dt_termino`, `ic_status`, `created_at`, `updated_at`) VALUES
(2, 'Economizar para curso técnico', '2025-12-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 'Quitar dívida do cartão', '2024-10-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00');

-- Inserções para a tabela 'metas' (Usuário 2: Maria Souza - Classe média alta)
INSERT INTO `metas` (`cd_nivel_imp`, `nm_meta`, `dt_termino`, `ic_status`, `created_at`, `updated_at`) VALUES
(5, 'Comprar imóvel na praia', '2027-12-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(4, 'Aumentar investimentos em 20%', '2025-12-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00');

-- Inserções para a tabela 'projeto' (Usuário 1: João Silva - Baixo poder aquisitivo)
INSERT INTO `projeto` (`ds_tema_projeto`) VALUES
('Reforma do quarto'),
('Organização financeira pessoal');

-- Inserções para a tabela 'projeto' (Usuário 2: Maria Souza - Classe média alta)
INSERT INTO `projeto` (`ds_tema_projeto`) VALUES
('Planejamento de viagem internacional'),
('Construção de área de lazer');

-- Inserções para a tabela 'panorama' (Usuário 1: João Silva - Baixo poder aquisitivo)
INSERT INTO `panorama` (`cd_usuario`, `vl_debito`, `vl_superavit`, `balanco`, `created_at`, `updated_at`) VALUES
(1, 1500.00, 1700.00, 200.00, '2024-07-19 10:00:00', '2024-07-19 10:00:00');

-- Inserções para a tabela 'panorama' (Usuário 2: Maria Souza - Classe média alta)
INSERT INTO `panorama` (`cd_usuario`, `vl_debito`, `vl_superavit`, `balanco`, `created_at`, `updated_at`) VALUES
(2, 5150.00, 9000.00, 3850.00, '2024-07-19 10:00:00', '2024-07-19 10:00:00');



-- Inserções para tabelas associativas

-- Associações entre registros fixos e métodos de pagamento
INSERT INTO `registro_fix_metodoP` (`cd_tipo_metodo`, `cd_registro_fixo`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Aluguel com Cartão de Crédito
(2, 2, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Transporte com Cartão de Débito
(5, 3, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Salário com Pix
(3, 4, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Contas com Dinheiro
(1, 5, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Compras com Cartão de Crédito
(1, 6, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Financiamento Imóvel com Cartão de Crédito
(4, 7, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Financiamento Carro com Transferência
(4, 8, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Salário com Transferência
(1, 9, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Streaming com Cartão de Crédito
(2, 10, '2024-07-01 00:00:00', '2024-07-01 00:00:00'); -- Plano de Saúde com Cartão de Débito

-- Associações entre registros fixos e formas de pagamento
INSERT INTO `registro_fix_tipoP` (`cd_tipo_forma`, `cd_registro_fixo`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Aluguel Parcelado
(2, 2, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Transporte À Vista
(2, 3, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Salário À Vista
(2, 4, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Contas À Vista
(2, 5, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Compras À Vista
(1, 6, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Financiamento Imóvel Parcelado
(1, 7, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Financiamento Carro Parcelado
(2, 8, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Salário À Vista
(2, 9, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Streaming À Vista
(2, 10, '2024-07-01 00:00:00', '2024-07-01 00:00:00'); -- Plano de Saúde À Vista

-- Associações entre registros flutuantes e métodos de pagamento
INSERT INTO `registro_flut_metodoP` (`cd_tipo_metodo`, `cd_registro_flut`, `created_at`, `updated_at`) VALUES
(3, 1, '2024-07-02 00:00:00', '2024-07-02 00:00:00'), -- Lanche com Dinheiro
(1, 2, '2024-07-08 00:00:00', '2024-07-08 00:00:00'), -- Compra Extra com Cartão de Crédito
(5, 3, '2024-07-12 00:00:00', '2024-07-12 00:00:00'), -- Bico com Pix
(1, 4, '2024-07-03 00:00:00', '2024-07-03 00:00:00'), -- Jantar com Cartão de Crédito
(1, 5, '2024-07-09 00:00:00', '2024-07-09 00:00:00'), -- Compras Online com Cartão de Crédito
(4, 6, '2024-07-14 00:00:00', '2024-07-14 00:00:00'); -- Investimento com Transferência

-- Associações entre registros flutuantes e formas de pagamento
INSERT INTO `registro_flut_tipoP` (`cd_registro_flutuante`, `cd_tipo_forma`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-07-02 00:00:00', '2024-07-02 00:00:00'), -- Lanche À Vista
(2, 2, '2024-07-08 00:00:00', '2024-07-08 00:00:00'), -- Compra Extra À Vista
(3, 2, '2024-07-12 00:00:00', '2024-07-12 00:00:00'), -- Bico À Vista
(4, 2, '2024-07-03 00:00:00', '2024-07-03 00:00:00'), -- Jantar À Vista
(5, 1, '2024-07-09 00:00:00', '2024-07-09 00:00:00'), -- Compras Online Parcelado
(6, 2, '2024-07-14 00:00:00', '2024-07-14 00:00:00'); -- Investimento À Vista

-- Associações entre metas e registros fixos
INSERT INTO `metas_reg_fixo` (`cd_metas`, `cd_registro_fixo`, `created_at`, `updated_at`) VALUES
(1, 3, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Meta curso técnico associada ao salário de João
(2, 1, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Meta quitar dívida associada ao aluguel de João
(3, 8, '2024-07-01 00:00:00', '2024-07-01 00:00:00'), -- Meta imóvel praia associada ao salário de Maria
(4, 8, '2024-07-01 00:00:00', '2024-07-01 00:00:00'); -- Meta investimentos associada ao salário de Maria

-- Associações entre metas e registros flutuantes
INSERT INTO `metas_reg_flut` (`cd_registro_flutuante`, `cd_metas`, `created_at`, `updated_at`) VALUES
(3, 1, '2024-07-12 00:00:00', '2024-07-12 00:00:00'), -- Bico de João associado à meta do curso técnico
(6, 4, '2024-07-14 00:00:00', '2024-07-14 00:00:00'); -- Rendimento investimento de Maria associado à meta de investimentos
