<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else 
{
	header("Location: index.html");
	exit;
}
$now = time();
if($now > $_SESSION['expire'])
{
	session_destroy();
	header("Location: index.html");	
}
?>
<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>AGREGAR CALIFICACIONES</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing">
		<div id='page-wrapper'>
			<!-- Header -->
				<header id="header" class="alt">
					<nav id="nav">
						<ul>
							<li><a href="Principal.php">Inicio</a></li>
							<li><a href="CerrarSesion.php">Cerrar Sesión</a></li>
							
						</ul>
					</nav>
				</header>
<?php
	include ("conexion.php");
	include ("obtenerUsuario.php");
	// Probamos la conexion
	$con= conectar();
	if($con)
	{
		$idUsuario=$_SESSION['username'];
		$idmateria=ObtenerMateria($idUsuario, $con);
		$materia=nombreMateria($idmateria, $con);
		$grupo=$_POST['grupo'];
			// echo "GRUPO:".$grupo;
		$i = 0;


		if(isset($_POST['Aceptar']))
		{
			echo"		<section id='cta'>
						<h2>".$_SESSION['username']."</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>AGREGAR CALIFICACIONES - ".$materia."</h3>
					</header>				
			";
			
			echo "				<center>
									<ul class='actions'>
										<li><a href='Principal.php' class='button'>Inicio</a></li>
										<li><a href='CalProfesor.php' class='button'>Regresar a Grupos</a></li>
									</ul>
								</center>
			";
			
			

			$alumno=mysqli_query($con, "SELECT u.Nombre, u.ApPaterno, u.ApMaterno, a.idGrupo, g.nombre, u.idusuario FROM usuario u, Alumno a, grupo g WHERE u.idUsuario=a.idAlumno AND a.idGrupo=g.idGrupo AND g.idGrupo=$grupo ORDER BY u.ApPaterno, u.ApMaterno, u.nombre ASC;"); 

			$califActual=mysqli_query($con, "SELECT am.calificacion FROM usuario u, am am, alumno a WHERE u.idusuario=a.idalumno and a.idalumno=am.idalumno and am.idMateria=$idmateria and a.idgrupo=$grupo ORDER BY u.ApPaterno, u.ApMaterno, u.nombre ASC;"); 


			echo" 	<div class='row'>
						<div class='12u'>
							<!-- Table -->

								<section class='box'>
									<div class='table-wrapper'>
										<table>
											<thead>
												<tr>
													<th><center>GRUPO </center></th>
													<th><center>ID</center></th>
													<th><center>ALUMNOS</center></th>
													<th><center>CALIFICACION</center></th>
													<th><center>NUEVA CALIFICACION</center></th>
												</tr>
											</thead>
											<tbody>
											<form action= 'ConfirmarCal.php' method = 'POST'>
												<tr>
				";
				if (mysqli_num_rows($alumno) && mysqli_num_rows($califActual)) 
				{ 
					while (($rowAlumno = mysqli_fetch_array($alumno)) && $rowCalif = mysqli_fetch_array($califActual))
					{
						$combo=califActual($rowCalif[0]);
					    echo "						<td><center>$rowAlumno[4]</center></td>
					    							<td><center>$rowAlumno[5]</center></td>
					    							<td><center>$rowAlumno[2] $rowAlumno[1] $rowAlumno[0]</center> </td> 
					    							<td><center>$rowCalif[0]</center></td>
													<td>
														<select name='cal_".$i."' value=10>
															<option value=0 $combo[0]>0</option>
															<option value=1 $combo[1]>1</option>
															<option value=2 $combo[2]>2</option>
															<option value=3 $combo[3]>3</option>
															<option value=4 $combo[4]>4</option>
															<option value=5 $combo[5]>5</option>
															<option value=6 $combo[6]>6</option>
															<option value=7 $combo[7]>7</option>
															<option value=8 $combo[8]>8</option>
															<option value=9 $combo[9]>9</option>
															<option value=10 $combo[10]>10</option>
											 			</select>
											 		</td>
												
												</tr>
				";
				 $i++;
					} 
					echo "				
										
												<ul class='actions align-center'>
												<input type=hidden name='var' value='$i'>
												<input type=hidden name='grupo' value='$grupo'>
										<li><input type='submit' name='Enviar' value='Agregar  Calificaciones' class='button special'></li>
												</ul>								
									</form>
					";
				} // FIN MSQLY_NUM_ROWS $ALUMNO
				echo "						</tbody>
											<tfoot>
											</tfoot>
										</table>
									</div>
								</section>
						</div>
					</div>
			";
			
		} // FIN ACEPTAR
		
	} // FIN CONEXION
	
?>
			</section>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>