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
		<title>SAEEB</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
							<li><a href="CerrarSesion.php">Cerrar Sesión</a></li>
							
						</ul>
					</nav>
				</header>
	<?php
	 	echo"
	 		<section id='cta'>
					<h2>SAEEB</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>Boleta de Calificaciones</h3>
					</header>				
		";
	include ("conexion.php");
	include ("obtenerUsuario.php");
	$con=conectar();
	$idAlumno=$_GET['idAlumno'];
	$idGrupo=$_GET['idGrupo'];
	$result = mysqli_query($con,"SELECT nombre,appaterno,apmaterno,curp FROM usuario where idUsuario='$idAlumno'");
	$escuela= mysqli_query($con, "SELECT e.ClaveEscuela, e.nombre, e.tipoe, e.periodoActual FROM usuario u, escuela e where e.ClaveEscuela=u.ClaveEscuela and u.idUsuario='".$idAlumno."'");
	$School= mysqli_fetch_array($escuela);
	$Nombre = mysqli_fetch_array($result);
	$res = mysqli_query($con,"SELECT nombre FROM grupo where idGrupo='$idGrupo'");
	$Grupo = mysqli_fetch_array($res);
	$res1 = mysqli_query($con,"SELECT * FROM alumno where idAlumno='$idAlumno'");
	$IformacionAlumno= mysqli_fetch_array($res1);
	if($con){
		echo"<div class='box'>
				<form method='post' action='#'>
				<div class='row uniform 50%'>
				<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>ID Alumno:</b></label>
							<p>$IformacionAlumno[0]</p>
					</div>

					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Nombre:</b></label>
							<p>$Nombre[0]</p>
					</div>
					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Apellido Paterno:</b></label>
							<p>$Nombre[1]</p>
					</div>
					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Apellido Materno:</b></label>
							<p>$Nombre[2]</p>
					</div>

					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Grado:</b></label>
							<p>$IformacionAlumno[3]</p>
					</div>

					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Grupo:</b></label>
							<p>$Grupo[0]</p>
					</div>
					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>CURP:</b></label>
							<p>$Nombre[3]</p>
					</div>
					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Turno:</b></label>
							<p>$IformacionAlumno[4]</p>
					</div>

					

					<div class='6u 12u(mobilep)'>
						<label for='nombre'><b>Escuela:</b></label>
							<p>".$School[0]." - ".$School[1]."</p>
					</div>

					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Tipo de Secundaria:</b></label>
							<p>$School[2]</p>
					</div>

					<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Periodo:</b></label>
							<p>$School[3]</p>
					</div>
					<br></br><br></br>
					<table style='width:100%'  charset='UTF-8'>
					<br></br><br></br><br></br><br></br>
					<tr></tr>
 						<tr>
    						<th>ID Materia</th>
    						<th>Materia</th> 
    						<th>Calificacion</th>
  						</tr>

  					";
  		$res2 = mysqli_query($con,"SELECT m.idMateria,m.Nombre,x.Calificacion from 	Materia m,am x where m.idmateria=x.idmateria and idAlumno='$idAlumno'");
  		if (mysqli_num_rows($res2)){
			while ($row = mysqli_fetch_array($res2)) 
			{
					echo"
						 <tr>
    						<td>$row[0]</td>
   							<td>$row[1]</td> 
    						<td>$row[2]</td>
  						</tr>
					";
			}
		}
		$res3 = mysqli_query($con,"SELECT AVG(calificacion) from am where idAlumno='$idAlumno'");//Promedio
		$promedio = mysqli_fetch_array($res3);
		echo"
			</table>
			<div class='8u 12u(mobilep)'>
						<label for='nombre'><b></b></label>
							<p></p>
					</div>
			<div class='3u 12u(mobilep)'>
						<label for='nombre'><b>Promedio</b></label>
							<p>$promedio[0]</p>
					</div>
			<div class='row uniform'>
							<div class='12u'>
								<ul class='actions align-center'>
									<li><a href='Boleta.php?idAlumno=$idAlumno&idGrupo=$idGrupo' class='button special' TARGET='_blanc'>PDF</a></li>
								</ul>
							</div>
						</div>
			<div class='row uniform'>
							<div class='12u'>
								<ul class='actions align-center'>
									<li><a href='SeleccionarAlumno.php' class='button special'>Regresar</a></li>
								</ul>
							</div>
						</div>
					</form>
					</div>
			</section>";



				
	}

	?>
				<!-- CTA -->
				<section id="cta">
			</section>
		</div>
	</body>
</html>