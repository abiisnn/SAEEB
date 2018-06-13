<?php


	function getEscuela($idusuario, $conex){
		$escuelita=mysqli_query($conex, "SELECT claveescuela FROM usuario WHERE idusuario=$idusuario"); 
		$rowE = mysqli_fetch_array($escuelita);

		return $rowE[0];
	}



	function tipoUsuario($idusuario, $conex){
		$tipo=mysqli_query($conex, "SELECT tipo FROM usuario WHERE idusuario=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}

	function DestiAlumno($idUsuario, $idGrupo, $idEscuela, $conex){//grupo del alumno
		$destinatariosA= mysqli_query($conex, "SELECT u.idusuario, u.nombre,u.appaterno, u.apmaterno from usuario u, grupo g
												where u.idusuario=g.idorientador and u.claveescuela=g.claveescuela and u.tipo='ORIENTADOR' and g.idgrupo=$idGrupo and g.claveescuela=$idEscuela
												union
												select idusuario, nombre,appaterno, apmaterno from usuario where idusuario in (select p.idprofesor from profesor p, pg pg, grupo g where p.idprofesor=pg.idprofesor and pg.idgrupo=g.idgrupo and g.idgrupo=$idGrupo and g.claveescuela=$idEscuela) order by 1 asc;"); 
		return $destinatariosA;
	}

	function DestiOri($idUsuario, $idGrupo, $idEscuela, $conex){//grupo del orientador
		$destinatariosO= mysqli_query($conex, "SELECT a.idalumno, a.tutor from usuario u, grupo g, alumno a
where u.idusuario=a.idalumno and u.claveescuela=g.claveescuela and g.idgrupo=a.idgrupo and a.idgrupo=$idGrupo and u.claveescuela=$idEscuela order by 1 asc;"); 
		return $destinatariosO;
		
	}

	function DestiProf($idUsuario, $idEscuela, $conex){
		$destinatariosP= mysqli_query($conex, "SELECT a.idalumno, a.tutor from usuario u, grupo g, alumno a
												where u.idusuario=a.idalumno and u.claveescuela=g.claveescuela and g.idgrupo=a.idgrupo and u.tipo='ALUMNO' and g.idgrupo in (select idgrupo from pg where idprofesor=$idUsuario) and g.claveescuela=$idEscuela order by 1 asc;"); 
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
		$Alumno= mysqli_query($conex, "SELECT u.idUsuario,u.appaterno, u.apmaterno,u.nombre FROM Usuario u, grupo g,alumno a WHERE g.idgrupo=a.idgrupo and a.idalumno=u.idUsuario and g.idgrupo=$idgrupo order by 1 asc;"); 
		return $Alumno;	
	}
	function OtenerGrupo($idusuario, $conex){//Orientador
		$tipo=mysqli_query($conex, "SELECT idgrupo FROM grupo where idorientador=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}

	function getGrupoAlumno($idusuario, $conex){//Alumno
		$tipo=mysqli_query($conex, "SELECT idgrupo FROM alumno where idalumno=$idusuario"); 
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

	function nombreMateria($idMateria, $conex){
		$mat = mysqli_query($conex, "SELECT nombre FROM materia WHERE idMateria=$idMateria"); 
		$row = mysqli_fetch_array($mat);

		return $row[0];
	}

	function califActual($calif){

		for($j=0; $j<11; $j++){
			if($calif==$j)
			$sel[$j]="selected";
			else
				$sel[$j]="";
		}

		return $sel;
	}


?>