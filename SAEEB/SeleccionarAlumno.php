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
		<title>SELECCION ALUMNO</title>
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
echo"				<section id='cta'>
					<h2>SAEEB</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>Boleta de Calificaciones</h3>
					</header>				
";
	include ("conexion.php");
	include ("obtenerUsuario.php");

	// Probamos la conexion
	$con= conectar();
	if($con){
		$idUsuario=$_SESSION['username'];
		if(isset($_POST['Aceptar'])){
			$idAlumno=$_POST['alumno'];
			$grupo=$_POST['grupo'];
			$idGrupo=OtenerGrupo($idUsuario,$con);
			$result = mysqli_query($con,"SELECT appaterno,apmaterno, nombre FROM usuario where idUsuario='$idAlumno'");
			$Nombre = mysqli_fetch_array($result);
			echo "
				<div class='box'>
					<form method='post' action='#'>
						<div class='row uniform 50%'>
							<div class='3u 12u(mobilep)'>
								<h4>Alumno Seleccionado</h4>							
							</div>
						</div>
					<div class='row uniform 50%'>
							<div class='3u 12u(mobilep)'>
								<label for='nombre'><b>Grupo Asignado</b></label>
									<p>$grupo</p>
							</div>
					<div class='row uniform 50%'>
						<div class='12u 12u(mobilep)'>
							<label for='nombre'><b>Alumno</b></label>
								<p> $idAlumno - $Nombre[0] $Nombre[1] $Nombre[2]</p>
					</div>
					<div class='row uniform'>
							<div class='12u'>
								<ul class='actions align-center'>
									<li><a href='BoletaInicio.php?idAlumno=$idAlumno&idGrupo=$idGrupo' class='button special'>Confirmar</a></li>
								</ul>
							</div>
						</div>
					</form>
					</div>
				</section>";

			//$producto=$_REQUEST['mi_select'];

		}
		else{
		$grupo=GrupoOrientador($idUsuario,$con);
		$idGrupo=OtenerGrupo($idUsuario,$con);
		$Alumno=ObtenerAlumnosGrupo($idGrupo,$con);
		//$grupo=GrupoOrientador($idUsuario, $con);
		echo "			
						<div class='box'>
							<form method='post' action='#'>
								<div class='row uniform 50%'>
									<div class='3u 12u(mobilep)'>
										<label for='nombre'><b></b></label>							
									</div>
								</div>
								<div class='row uniform 50%'>
									<div class='3u 12u(mobilep)'>
										<label for='nombre'><b>Grupo Asignado</b></label>
										<p>".$grupo."</p>
								</div>
								<div class='row uniform 50%'>
									<div class='12u 12u(mobilep)'>
										<label for='nombre'><b>Alumnos</b></label>
										<select name='alumno'>";
					if (mysqli_num_rows($Alumno)) { 
						while ($row = mysqli_fetch_array($Alumno)) { 
							echo "<option value='$row[0]'> $row[0] - $row[1] $row[2] $row[3]</option>";
						}
					}
					echo"			</select>
							</div>";
									
					echo " 
						<div class='row uniform'>
							<div class='12u'>
								<ul class='actions align-center'>
									<input type='hidden' value='$grupo' name='grupo'>
									<li><input type='submit' name='Aceptar' value='Aceptar' class='button special'></li>
								</ul>
							</div>
						</div>
						<div class='row uniform'>
							<div class='12u'>
								<ul class='actions align-center'>
									<li><a href='Principal.php' class='button special'>Regresar</a></li>
								</ul>
							</div>
						</div>
					</form>
					</div>
				</section>";
		}
	}
	
?>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>