delimiter $$
create function sfRendaDespesaTotal(
    cdUsuario_param int,
    tipo_param int,
    dtInicio_param timestamp,
    dtFim_param timestamp
) returns decimal(9,2) deterministic reads sql data
begin
    declare superavit_var decimal(9,2);
    
    if(tipo_param = 1) then
        select 
            sum(vl_valor)
        into superavit_var
        from 
            registro 
        where 
            cd_usuario = cdUsuario_param and
            cd_tipo_registro = 1 and
            created_at between dtInicio_param and dtFim_param;
    elseif(tipo_param = 2) then
        select 
            sum(vl_valor)
        into superavit_var
        from 
            registro 
        where 
            cd_usuario = cdUsuario_param and
            cd_tipo_registro = 2 and
            created_at between dtInicio_param and dtFim_param;
    else 
        set superavit_var = 0;
    end if;
    return(superavit_var);
end$$
delimiter ;