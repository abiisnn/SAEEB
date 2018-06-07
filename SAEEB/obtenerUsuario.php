<?php
	function tipoUsuario($idusuario, $conex){
		$tipo=mysqli_query($conex, "SELECT tipo FROM usuario WHERE idusuario=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}

	function DestiAlumno($idUsuario, $conex){
		$destinatariosA= mysqli_query($conex, "SELECT distinct u.idusuario, u.appaterno, u.apmaterno, u.nombre
											FROM usuario u, profesor p, alumno a, grupo g, pg pg , orientador o
											WHERE ((u.idusuario=pg.idprofesor and pg.idgrupo=g.idgrupo) or (u.idusuario=g.idorientador)) and g.idgrupo=a.idgrupo and a.idalumno=$idUsuario order by 1 asc;"); 
		return $destinatariosA;
	}

	function DestiOri($idUsuario, $conex){
		$destinatariosO= mysqli_query($conex, "SELECT distinct a.idalumno, a.tutor
												FROM orientador o, alumno a, grupo g
												WHERE a.idgrupo=g.idgrupo and g.idorientador=o.idorientador and o.idorientador=$idUsuario order by 1 asc;"); 
		return $destinatariosO;
		
	}

	function DestiProf($idUsuario, $conex){
		$destinatariosP= mysqli_query($conex, "SELECT distinct a.idalumno, a.tutor
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
					$usuario=mysqli_query($conex, "SELECT appaterno, apmaterno, nombre  FROM usuario WHERE idusuario=".$idusuario.""); 
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
		$Alumno= mysqli_query($conex, "SELECT u.idUsuario,u.appaterno, u.apmaterno,u.nombre FROM Usuario u, grupo g,alumno a WHERE g.idgrupo=a.idgrupo and a.idalumno=u.idUsuario and g.idgrupo=$idgrupo order by 1 asc;"); 
		return $Alumno;	
	}
	function OtenerGrupo($idusuario, $conex){
		$tipo=mysqli_query($conex, "SELECT idgrupo FROM grupo where idorientador=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}
	// Función para OBTENER GRUPOS de un Profesor
	function ObtenerGrupos($idprofesor, $conex)
	{
		$tipo = mysqli_query($conex, "SELECT g.idGrupo, g.Nombre FROM grupo g, pg pg, profesor p WHERE g.idGrupo=pg.idGrupo AND pg.idProfesor=p.idProfesor and p.idProfesor=$idprofesor order by 1 asc;");
		return $tipo;		
	}
	// OBTIENE LA MATERIA QUE IMPARTE UN PROFESOR
	function ObtenerMateria($idUsuario, $conex){
		$tipo = mysqli_query($conex, "SELECT idMateria FROM Profesor WHERE idProfesor=$idUsuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}


?>