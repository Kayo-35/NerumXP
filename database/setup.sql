delete from historico_metas where vl_progresso is not null and vl_alvo is null;
delete from historico_metas where pc_alvo is null and pc_progresso is not null;
