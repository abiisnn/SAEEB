<?php
	function tipoUsuario($idusuario, $conex){
		$tipo=mysqli_query($conex, "SELECT tipo FROM usuario WHERE idusuario=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}


	function DestiAlumno($idUsuario, $conex){
		$destinatariosA= mysqli_query($conex, "SELECT u.idusuario, u.nombre, u.appaterno, u.apmaterno
											FROM usuario u, profesor p, alumno a, grupo g, pg pg , orientador o
											WHERE ((u.idusuario=pg.idprofesor and pg.idgrupo=g.idgrupo) or (u.idusuario=g.idorientador)) and g.idgrupo=a.idgrupo and a.idalumno=$idUsuario order by 1 asc;"); 
		return $destinatariosA;
	}

	function DestiOri($idUsuario, $conex){
		$destinatariosO= mysqli_query($conex, "SELECT a.idalumno, a.tutor
												FROM orientador o, alumno a, grupo g
												WHERE a.idgrupo=g.idgrupo and g.idorientador=o.idorientador and o.idorientador=$idUsuario order by 1 asc;"); 
		return $destinatariosO;
		
	}

	function DestiProf($idUsuario, $conex){
		$destinatariosP= mysqli_query($conex, "SELECT a.idalumno, a.tutor
												FROM profesor p, alumno a, grupo g, pg pg
												WHERE a.idgrupo=g.idgrupo and g.idgrupo=pg.idgrupo and pg.idprofesor=p.idprofesor and p.idprofesor=$idUsuario order by 1 asc;"); 
		return $destinatariosP;
	}

	function usuario($idusuario, $conex){

				if(tipoUsuario($idusuario, $conex)=='ALUMNO'){ //Usuario inicia en 2: ALUMNO
					$usuario=mysqli_query($conex, "SELECT tutor FROM alumno WHERE idalumno=".$idusuario.""); 
					$rowUsuario = mysqli_fetch_array($usuario);
					$nombreUsuario= $rowUsuario[0];
				}
				else{
					$usuario=mysqli_query($conex, "SELECT nombre, appaterno, apmaterno FROM usuario WHERE idusuario=".$idusuario.""); 
					$rowUsuario = mysqli_fetch_array($usuario);
					$nombreUsuario= $rowUsuario[0]." ".$rowUsuario[1]." ".$rowUsuario[2];
				}
				return $nombreUsuario;	
		}
	function GrupoOrientador($idUsuario,$conex){
		$grupo=mysqli_query($conex, "SELECT Nombre FROM Grupo WHERE idOrientador=$idUsuario"); 
		$row = mysqli_fetch_array($grupo);

		return $row[0];
	}
	function ObtenerAlumnosGrupo($idgrupo,$conex)
	{
		$Alumno= mysqli_query($conex, "SELECT u.idUsuario,u.nombre,u.appaterno, u.apmaterno FROM Usuario u, grupo g,alumno a WHERE g.idgrupo=a.idgrupo and a.idalumno=u.idUsuario and g.idgrupo=$idgrupo order by 1 asc;"); 
		return $Alumno;	
	}
	function OtenerGrupo($idusuario, $conex){
		$tipo=mysqli_query($conex, "SELECT idgrupo FROM grupo where idorientador=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}
?>