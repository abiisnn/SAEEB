delimiter #
CREATE PROCEDURE usuario(IN usu INT)
begin
	SELECT * FROM usuario where idUsuario= usu;
end #

delimiter ;