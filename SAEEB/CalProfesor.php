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
		<title>SELECCION GRUPO</title>
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
	if($con)
	{
		
		$idUsuario=$_SESSION['username'];
		$idGrupo=OtenerGrupo($idUsuario,$con);
		$Alumno=ObtenerAlumnosGrupo($idGrupo,$con);
		$Grupos = ObtenerGrupos($idUsuario, $con);
		//$grupo=GrupoOrientador($idUsuario, $con);
		echo "			
						<div class='box'>
							<form method='post' action='AgregarCal.php'>
								<div class='row uniform 50%'>
									<div class='3u 12u(mobilep)'>
										<label for='nombre'><b></b></label>							
									</div>
								</div>
								<div class='row uniform 50%'>
									<div class='12u 12u(mobilep)'>
										<label for='nombre'><b>Seleccione un Grupo</b></label>
										<select name='grupo'>";
					if (mysqli_num_rows($Grupos)) 
					{ 
						while ($row = mysqli_fetch_array($Grupos)) 
						{ 
							echo "<option value='$row[0]'> $row[0] - $row[1] </option>";
						}
					} //FIN MYSQLI_NUM_ROWS
					echo"			</select>
							</div>";
									
					echo " 
						<div class='row uniform'>
							<div class='12u'>
								<ul class='actions align-center'>
									<input type='hidden' value='$row[0]' name='idgrupo'>
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
	
	} // FIN CONEXION
	
?>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>