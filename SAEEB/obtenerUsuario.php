<?php
	function tipoUsuario($idusuario, $conex){
		$tipo=mysqli_query($conex, "SELECT tipo FROM usuario WHERE idusuario=$idusuario"); 
		$row = mysqli_fetch_array($tipo);

		return $row[0];
	}

	function consultaDesti($idUsuario, $conex){
		$destinatarios=null;
		$rowD=null;
		echo "".$idUsuario;

		if(tipoUsuario($idUsuario, $conex)=='ALUMNO'){
			$destinatarios= mysqli_query($conex, "SELECT u.*
														FROM usuario u, profesor p, alumno a, grupo g, pg pg , orientador o
														WHERE ((u.idusuario=pg.idprofesor and pg.idgrupo=g.idgrupo) or (u.idusuario=g.idorientador)) and g.idgrupo=a.idgrupo and a.idalumno=$idUsuario order by 3 asc;"); 
			$rowD = mysqli_fetch_array($destinatarios);
		}
		else if(tipoUsuario($idUsuario, $conex)=='PROFESOR'){//Obtener padres de familia
			$destinatarios= mysqli_query($conex, "SELECT a.*
													FROM profesor p, alumno a, grupo g, pg pg
													WHERE a.idgrupo=g.idgrupo and g.idgrupo=pg.idgrupo and pg.idprofesor=p.idprofesor and p.idprofesor=$idUsuario order by 2 asc;"); 
			$rowD = mysqli_fetch_array($destinatarios);
		}
		else if(tipoUsuario($idUsuario, $conex)=='ORIENTADOR'){//Obtener padres de familia
			$destinatarios= mysqli_query($conex, "SELECT a.*
													FROM orientador o, alumno a, grupo g
													WHERE a.idgrupo=g.idgrupo and g.idorientador=o.idorientador and o.idorientador=$idUsuario order by 2 asc;"); 
			$rowD = mysqli_fetch_array($destinatarios);
		}

		
		if (mysqli_num_rows($destinatarios)) { 
	  				while ($rowD) {
	  					echo "".$rowD[0]." ".$rowD[1];
	  					echo "<br>";
	  				}
	  			}
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


?>