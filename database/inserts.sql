-- Inserções de dados fixos
INSERT INTO `assinatura` (`nm_assinatura`) VALUES
("Bronze"),
("Prata"),
("Ouro");

INSERT INTO `categoria` (`nm_categoria`) VALUES
("Moradia"),
("Transporte"),
("Contas"),
("Saúde"),
("Educação"),
("Alimentação"),
("Salário"),
("Investimento"),
("Lazer"),
("Outros");

INSERT INTO `forma_pagamento` (`nm_tipo_metodos`) VALUES
("Parcelado"),
("À Vista");

INSERT INTO `localizacao` (`nm_localizacao`) VALUES
("Casa"),
("Trabalho"),
("Supermercado"),
("Rua"),
("Online");

INSERT INTO `metodo_pagamento` (`nm_tipo_metodo`) VALUES
("Cartão de Crédito"),
("Cartão de Débito"),
("Dinheiro"),
("Transferência"),
("Pix");

INSERT INTO `nivel_imp` (`sg_nivel_imp`) VALUES
("Ba"),
("Me"),
("Al"),
("Cr"),
("Ur");

INSERT INTO `realizador_transacao` (`nm_realizador`, `ds_realizador`) VALUES
("Próprio", "Transação realizada pelo próprio usuário"),
("Cônjuge", "Transação realizada pelo cônjuge"),
("Filho", "Transação realizada por um filho"),
("Amigo", "Transação realizada por um amigo"),
("Outro", "Transação realizada por outra pessoa");

INSERT INTO `registro_tipo_juros` (`nm_tipo_juro`) VALUES
("Simples"),
("Composto");

INSERT INTO `tipo_historico` (`nm_tipo_hist`) VALUES
("Entrada"),
("Saída");

INSERT INTO `tipo_registro` (`nm_tipo`) VALUES
("Receita"),
("Despesa");

-- Inserções de usuários
INSERT INTO `usuario` (`cd_assinatura`, `password`, `email`, `email_verified_at`, `remember_token`, `nm_usuario`, `dt_nascimento`, `created_at`, `updated_at`) VALUES
(1,
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'joao.silva@email.com',
'2023-01-15 10:00:00',
NULL,
'João Silva',
'1985-03-20',
'2023-01-15 10:00:00',
'2023-01-15 10:00:00');

INSERT INTO `usuario` (`cd_assinatura`, `password`, `email`, `email_verified_at`, `remember_token`, `nm_usuario`, `dt_nascimento`, `created_at`, `updated_at`) VALUES
(3,
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'maria.souza@email.com',
'2023-01-15 10:00:00',
NULL,
'Maria Souza',
'1990-07-10',
'2023-01-15 10:00:00',
'2023-01-15 10:00:00');

-- Inserções de dados gerados
INSERT INTO `registro_fixo` (`cd_usuario`, `cd_tipo_registro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registroFixo`, `vl_valor`, `ic_pago`, `ic_status`, `dt_pagamento`, `ds_descricao`, `qt_parcelas`, `qt_parcelas_pagas`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 1, 1, 1, 'Aluguel', 800.00, 1, 1, '2024-07-05', 'Aluguel mensal', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 2, 2, 1, 3, 'Transporte', 150.00, 1, 1, '2024-07-05', 'Gastos com transporte público', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 1, 4, 7, 4, 1, 'Salário', 1500.00, 1, 1, '2024-07-05', 'Salário mensal', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 3, 3, 1, 3, 'Contas de Consumo', 200.00, 1, 1, '2024-07-10', 'Água, luz, gás', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 1, 1, 3, 1, 'Compras Essenciais', 300.00, 1, 1, '2024-07-15', 'Compras de supermercado', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 2, 3, 1, 1, 1, 'Aluguel - Agosto', 820.00, 0, 1, '2024-08-05', 'Aluguel mensal de agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 2, 2, 2, 1, 3, 'Transporte - Agosto', 160.00, 0, 1, '2024-08-05', 'Gastos com transporte público em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 1, 4, 7, 4, 1, 'Salário - Agosto', 1550.00, 1, 1, '2024-08-05', 'Salário mensal de agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 2, 3, 3, 1, 3, 'Contas de Consumo - Agosto', 210.00, 0, 1, '2024-08-10', 'Água, luz, gás em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 2, 1, 1, 3, 1, 'Compras Essenciais - Agosto', 310.00, 0, 1, '2024-08-15', 'Compras de supermercado em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00');

INSERT INTO `registro_fixo` (`cd_usuario`, `cd_tipo_registro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registroFixo`, `vl_valor`, `ic_pago`, `ic_status`, `dt_pagamento`, `ds_descricao`, `qt_parcelas`, `qt_parcelas_pagas`, `created_at`, `updated_at`) VALUES
(2, 2, 5, 3, 1, 2, 'Financiamento Imóvel', 3500.00, 1, 1, '2024-07-05', 'Parcela do financiamento da casa', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 4, 2, 1, 2, 'Financiamento Carro', 1200.00, 1, 1, '2024-07-05', 'Parcela do financiamento do carro', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 1, 5, 7, 4, 2, 'Salário', 8000.00, 1, 1, '2024-07-05', 'Salário mensal', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 3, 9, 5, 4, 'Assinatura Streaming', 50.00, 1, 1, '2024-07-10', 'Assinatura de serviços de streaming', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 2, 4, 1, 2, 'Plano de Saúde', 400.00, 1, 1, '2024-07-15', 'Plano de saúde familiar', NULL, NULL, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, 5, 3, 1, 2, 'Financiamento Imóvel - Agosto', 3550.00, 0, 1, '2024-08-05', 'Parcela do financiamento da casa em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(2, 2, 4, 2, 1, 2, 'Financiamento Carro - Agosto', 1250.00, 0, 1, '2024-08-05', 'Parcela do financiamento do carro em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(2, 1, 5, 7, 4, 2, 'Salário - Agosto', 8200.00, 1, 1, '2024-08-05', 'Salário mensal de agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(2, 2, 3, 9, 5, 4, 'Assinatura Streaming - Agosto', 55.00, 0, 1, '2024-08-10', 'Assinatura de serviços de streaming em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(2, 2, 2, 4, 1, 2, 'Plano de Saúde - Agosto', 420.00, 0, 1, '2024-08-15', 'Plano de saúde familiar em agosto', NULL, NULL, '2024-08-01 00:00:00', '2024-08-01 00:00:00');

INSERT INTO `registro_flutuante` (`cd_usuario`, `cd_tipo_registro`, `cd_tipo_juro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registro_flutuante`, `vl_valor_registro`, `ic_pago`, `ic_status`, `pc_taxa_juros`, `dt_pagamento`, `dt_vencimento`, `ds_descricao`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 2, 6, 4, 3, 'Lanche', 30.00, 1, 1, 0.000, '2024-07-02', '2024-07-02', 'Lanche na padaria', '2024-07-02 00:00:00', '2024-07-02 00:00:00'),
(1, 2, NULL, 1, 1, 3, 1, 'Compra Extra Supermercado', 80.00, 1, 1, 0.000, '2024-07-08', '2024-07-08', 'Compras extras para casa', '2024-07-08 00:00:00', '2024-07-08 00:00:00'),
(1, 1, NULL, 3, 9, 1, 5, 'Bico', 200.00, 1, 1, 0.000, '2024-07-12', '2024-07-12', 'Trabalho extra', '2024-07-12 00:00:00', '2024-07-12 00:00:00'),
(1, 2, NULL, 2, 6, 4, 3, 'Café da manhã', 25.00, 0, 1, 0.000, '2024-08-02', '2024-08-02', 'Café da manhã na padaria', '2024-08-02 00:00:00', '2024-08-02 00:00:00'),
(1, 2, NULL, 1, 1, 3, 1, 'Compras de emergência', 100.00, 0, 1, 0.000, '2024-08-08', '2024-08-08', 'Compras de última hora', '2024-08-08 00:00:00', '2024-08-08 00:00:00'),
(1, 1, NULL, 3, 9, 1, 5, 'Freela', 250.00, 1, 1, 0.000, '2024-08-12', '2024-08-12', 'Trabalho freelancer', '2024-08-12 00:00:00', '2024-08-12 00:00:00');

INSERT INTO `registro_flutuante` (`cd_usuario`, `cd_tipo_registro`, `cd_tipo_juro`, `cd_nivel_imp`, `cd_categoria`, `cd_localizacao`, `cd_realizador`, `nm_registro_flutuante`, `vl_valor_registro`, `ic_pago`, `ic_status`, `pc_taxa_juros`, `dt_pagamento`, `dt_vencimento`, `ds_descricao`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 4, 6, 4, 2, 'Jantar Restaurante', 250.00, 1, 1, 0.000, '2024-07-03', '2024-07-03', 'Jantar em restaurante sofisticado', '2024-07-03 00:00:00', '2024-07-03 00:00:00'),
(2, 2, NULL, 3, 9, 5, 4, 'Compras Online', 500.00, 1, 1, 0.000, '2024-07-09', '2024-07-09', 'Compras de roupas e acessórios', '2024-07-09 00:00:00', '2024-07-09 00:00:00'),
(2, 1, NULL, 5, 8, 1, 2, 'Rendimento Investimento', 1000.00, 1, 1, 0.000, '2024-07-14', '2024-07-14', 'Rendimento de aplicação financeira', '2024-07-14 00:00:00', '2024-07-14 00:00:00'),
(2, 2, NULL, 4, 6, 4, 2, 'Almoço de negócios', 300.00, 0, 1, 0.000, '2024-08-03', '2024-08-03', 'Almoço com clientes importantes', '2024-08-03 00:00:00', '2024-08-03 00:00:00'),
(2, 2, NULL, 3, 9, 5, 4, 'Gadgets eletrônicos', 700.00, 0, 1, 0.000, '2024-08-09', '2024-08-09', 'Compra de novos eletrônicos', '2024-08-09 00:00:00', '2024-08-09 00:00:00'),
(2, 1, NULL, 5, 8, 1, 2, 'Dividendos', 1500.00, 1, 1, 0.000, '2024-08-14', '2024-08-14', 'Recebimento de dividendos de ações', '2024-08-14 00:00:00', '2024-08-14 00:00:00');

INSERT INTO `historico` (`cd_origem_fixo`, `cd_origem_flutuante`, `cd_tipo_hist`, `vl_valor`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 800.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(2, NULL, 2, 150.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(3, NULL, 1, 1500.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(NULL, 1, 2, 30.00, '2024-07-02 00:00:00', '2024-07-02 00:00:00'),
(NULL, 2, 2, 80.00, '2024-07-08 00:00:00', '2024-07-08 00:00:00'),
(NULL, 3, 1, 200.00, '2024-07-12 00:00:00', '2024-07-12 00:00:00'),
(6, NULL, 2, 820.00, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(7, NULL, 2, 160.00, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(8, NULL, 1, 1550.00, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(NULL, 4, 2, 25.00, '2024-08-02 00:00:00', '2024-08-02 00:00:00'),
(NULL, 5, 2, 100.00, '2024-08-08 00:00:00', '2024-08-08 00:00:00'),
(NULL, 6, 1, 250.00, '2024-08-12 00:00:00', '2024-08-12 00:00:00');

INSERT INTO `historico` (`cd_origem_fixo`, `cd_origem_flutuante`, `cd_tipo_hist`, `vl_valor`, `created_at`, `updated_at`) VALUES
(11, NULL, 2, 3500.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(12, NULL, 2, 1200.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(13, NULL, 1, 8000.00, '2024-07-05 00:00:00', '2024-07-05 00:00:00'),
(NULL, 7, 2, 250.00, '2024-07-03 00:00:00', '2024-07-03 00:00:00'),
(NULL, 8, 2, 500.00, '2024-07-09 00:00:00', '2024-07-09 00:00:00'),
(NULL, 9, 1, 1000.00, '2024-07-14 00:00:00', '2024-07-14 00:00:00'),
(16, NULL, 2, 3550.00, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(17, NULL, 2, 1250.00, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(18, NULL, 1, 8200.00, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(NULL, 10, 2, 300.00, '2024-08-03 00:00:00', '2024-08-03 00:00:00'),
(NULL, 11, 2, 700.00, '2024-08-09 00:00:00', '2024-08-09 00:00:00'),
(NULL, 12, 1, 1500.00, '2024-08-14 00:00:00', '2024-08-14 00:00:00');

INSERT INTO `metas` (`cd_nivel_imp`, `nm_meta`, `dt_termino`, `ic_status`, `created_at`, `updated_at`) VALUES
(2, 'Economizar para curso técnico', '2025-12-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 'Quitar dívida do cartão', '2024-10-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 'Comprar um notebook novo', '2025-06-30', 0, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 'Fazer uma reserva de emergência', '2024-12-31', 0, '2024-08-01 00:00:00', '2024-08-01 00:00:00');

INSERT INTO `metas` (`cd_nivel_imp`, `nm_meta`, `dt_termino`, `ic_status`, `created_at`, `updated_at`) VALUES
(5, 'Comprar imóvel na praia', '2027-12-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(4, 'Aumentar investimentos em 20%', '2025-12-31', 0, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(5, 'Viagem de luxo para Europa', '2026-06-30', 0, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(4, 'Adquirir um carro esportivo', '2025-09-30', 0, '2024-08-01 00:00:00', '2024-08-01 00:00:00');

INSERT INTO `projeto` (`ds_tema_projeto`) VALUES
('Reforma do quarto'),
('Organização financeira pessoal'),
('Aprender nova habilidade'),
('Melhorar a alimentação');

INSERT INTO `projeto` (`ds_tema_projeto`) VALUES
('Planejamento de viagem internacional'),
('Construção de área de lazer'),
('Investimento em imóveis'),
('Criação de um fundo de caridade');

INSERT INTO `panorama` (`cd_usuario`, `vl_debito`, `vl_superavit`, `balanco`, `created_at`, `updated_at`) VALUES
(1, 1500.00, 1700.00, 200.00, '2024-07-19 10:00:00', '2024-07-19 10:00:00'),
(1, 1665.00, 1820.00, 155.00, '2024-08-01 10:00:00', '2024-08-01 10:00:00');

INSERT INTO `panorama` (`cd_usuario`, `vl_debito`, `vl_superavit`, `balanco`, `created_at`, `updated_at`) VALUES
(2, 5150.00, 9000.00, 3850.00, '2024-07-19 10:00:00', '2024-07-19 10:00:00'),
(2, 5700.00, 11000.00, 5300.00, '2024-08-01 10:00:00', '2024-08-01 10:00:00');

INSERT INTO `registro_fix_metodoP` (`cd_tipo_metodo`, `cd_registro_fixo`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(5, 3, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(3, 4, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 5, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 11, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(4, 12, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(4, 13, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 14, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 15, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 6, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(5, 7, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 9, '2024-08-10 00:00:00', '2024-08-10 00:00:00'),
(3, 16, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(5, 17, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(2, 19, '2024-08-10 00:00:00', '2024-08-10 00:00:00');

INSERT INTO `registro_fix_tipoP` (`cd_tipo_forma`, `cd_registro_fixo`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 3, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 4, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 5, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 11, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(1, 12, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 13, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 14, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 15, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 6, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 7, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(1, 9, '2024-08-10 00:00:00', '2024-08-10 00:00:00'),
(2, 16, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(2, 17, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(1, 19, '2024-08-10 00:00:00', '2024-08-10 00:00:00');

INSERT INTO `registro_flut_metodoP` (`cd_tipo_metodo`, `cd_registro_flut`, `created_at`, `updated_at`) VALUES
(3, 1, '2024-07-02 00:00:00', '2024-07-02 00:00:00'),
(1, 2, '2024-07-08 00:00:00', '2024-07-08 00:00:00'),
(5, 3, '2024-07-12 00:00:00', '2024-07-12 00:00:00'),
(1, 7, '2024-07-03 00:00:00', '2024-07-03 00:00:00'),
(1, 8, '2024-07-09 00:00:00', '2024-07-09 00:00:00'),
(4, 9, '2024-07-14 00:00:00', '2024-07-14 00:00:00'),
(2, 4, '2024-08-02 00:00:00', '2024-08-02 00:00:00'),
(5, 5, '2024-08-08 00:00:00', '2024-08-08 00:00:00'),
(1, 6, '2024-08-12 00:00:00', '2024-08-12 00:00:00'),
(2, 10, '2024-08-03 00:00:00', '2024-08-03 00:00:00'),
(5, 11, '2024-08-09 00:00:00', '2024-08-09 00:00:00'),
(1, 12, '2024-08-14 00:00:00', '2024-08-14 00:00:00');

INSERT INTO `registro_flut_tipoP` (`cd_registro_flutuante`, `cd_tipo_forma`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-07-02 00:00:00', '2024-07-02 00:00:00'),
(2, 2, '2024-07-08 00:00:00', '2024-07-08 00:00:00'),
(3, 2, '2024-07-12 00:00:00', '2024-07-12 00:00:00'),
(7, 2, '2024-07-03 00:00:00', '2024-07-03 00:00:00'),
(8, 1, '2024-07-09 00:00:00', '2024-07-09 00:00:00'),
(9, 2, '2024-07-14 00:00:00', '2024-07-14 00:00:00'),
(4, 1, '2024-08-02 00:00:00', '2024-08-02 00:00:00'),
(5, 1, '2024-08-08 00:00:00', '2024-08-08 00:00:00'),
(6, 1, '2024-08-12 00:00:00', '2024-08-12 00:00:00'),
(10, 1, '2024-08-03 00:00:00', '2024-08-03 00:00:00'),
(11, 2, '2024-08-09 00:00:00', '2024-08-09 00:00:00'),
(12, 1, '2024-08-14 00:00:00', '2024-08-14 00:00:00');

INSERT INTO `metas_reg_fixo` (`cd_metas`, `cd_registro_fixo`, `created_at`, `updated_at`) VALUES
(1, 3, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 1, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(5, 13, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(6, 13, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(3, 8, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(4, 6, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(7, 18, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(8, 16, '2024-08-01 00:00:00', '2024-08-01 00:00:00');

INSERT INTO `metas_reg_flut` (`cd_registro_flutuante`, `cd_metas`, `created_at`, `updated_at`) VALUES
(3, 1, '2024-07-12 00:00:00', '2024-07-12 00:00:00'),
(9, 6, '2024-07-14 00:00:00', '2024-07-14 00:00:00'),
(6, 3, '2024-08-12 00:00:00', '2024-08-12 00:00:00'),
(12, 7, '2024-08-14 00:00:00', '2024-08-14 00:00:00');

INSERT INTO `metas_projeto` (`cd_metas`, `cd_projeto`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(2, 2, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(5, 5, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(6, 6, '2024-07-01 00:00:00', '2024-07-01 00:00:00'),
(3, 3, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(4, 4, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(7, 7, '2024-08-01 00:00:00', '2024-08-01 00:00:00'),
(8, 8, '2024-08-01 00:00:00', '2024-08-01 00:00:00');
