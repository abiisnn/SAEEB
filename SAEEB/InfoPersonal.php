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
echo"				<section id='cta'>
					<h2>".$_SESSION['username']."</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>INFORMACIÓN PERSONAL</h3>
					</header>				
";
	include ("conexion.php");
	// Probamos la conexion
	$conexion = conectar();
	if($conexion)
	{
		// Consultas para USUARIO EN GENERAL
		$result = mysqli_query($conexion,"SELECT*FROM usuario where idUsuario='" . $_SESSION['username']. "'");
		$Usuario=$result->fetch_array();
		// Para saber la Escuela
		$result1 = mysqli_query($conexion, "SELECT e.nombre FROM usuario u, escuela e where e.ClaveEscuela=u.ClaveEscuela and u.idUsuario='".$_SESSION['username']."'");
		$Escuela=$result1->fetch_array();

		// PARA EL USUARIO TIPO: ALUMNO
		// Consulta para Tutor, Grado, Turno y Promedio
		$result2 = mysqli_query($conexion,"SELECT*FROM alumno where idAlumno='" . $_SESSION['username']. "'");
		$Alumno=$result2->fetch_array();
		// Para saber el grupo
		$result3 = mysqli_query($conexion, "SELECT g.nombre FROM grupo g, alumno a where g.idGrupo=a.idGrupo and a.idAlumno='".$_SESSION['username']."'");
		$Grupo=$result3->fetch_array();

		// PARA EL USUARIO TIPO: ORIENTADOR
		$result4 = mysqli_query($conexion, "SELECT Licenciatura FROM Orientador where idOrientador='".$_SESSION['username']."'");
		$Lic=$result4->fetch_array();

		// PARA EL USUARIO TIPO: PROFESOR
		$result5 = mysqli_query($conexion, "SELECT Area FROM Profesor where idProfesor='".$_SESSION['username']."'");
		$Area=$result5->fetch_array();
	}
echo "			
					<div class='box'>
						<form method='post' action='#'>
							<div class='row uniform 50%'>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>DATOS PERSONALES</b></label>							
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Nombre(s):</b></label>
									<p>".$Usuario[2]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Apellido Paterno:</b></label>
									<p>".$Usuario[3]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Apellido Materno:</b></label>
									<p>".$Usuario[4]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Edad:</b></label>
									<p>".$Usuario[8]."</p>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='5u 12u(mobilep)'>
									<label for='nombre'><b>Tutor:</b></label>
									<p>".$Alumno[2]."</p>
								</div>
								<div class='4u 12u(mobilep)'>
									<label for='nombre'><b>Email:</b></label>
									<p>".$Usuario[6]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Sexo:</b></label>
									<p>".$Usuario[9]."</p>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>DATOS ACADEMICOS</b></label>							
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='4u 12u(mobilep)'>
									<label for='nombre'><b>Escuela:</b></label>
									<p>".$Escuela[0]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Turno:</b></label>
									<p>".$Alumno[4]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Grupo:</b></label>
									<p>".$Grupo[0]."</p>
								</div>
								<div class='2u 12u(mobilep)'>
									<label for='nombre'><b>Promedio:</b></label>
									<p>".$Alumno[5]."</p>
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
				</section>
";
?>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>