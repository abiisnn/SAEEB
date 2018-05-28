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
				<header id='header' class='alt'>
					<nav id='nav'>
						<ul>
							<li><a href='Principal.html'>Inicio</a></li>
							<li>
								<a href='#' class='icon fa-angle-down'>Opciones</a>
								<ul>
									<li><a href='generic.html'>Contacto</a></li>
									<li><a href='contact.html'>Cerrar Sesión</a></li>
									<li>
										<a href='#'>Submenu</a>
										<ul>
											<li><a href='#'>Option One</a></li>
											<li><a href='#'>Option Two</a></li>
											<li><a href='#'>Option Three</a></li>
											<li><a href='#'>Option Four</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</header>
				<section id="cta">
					<h2>Contact Us</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h2>   </h2>
					</header>				
<?php
	include ("conexion.php");
	// Probamos la conexion
	$conexion = conectar();
	if($conexion)
	{
		// Consultas para usuario
		$result = mysqli_query($conexion,"SELECT*FROM usuario where idUsuario='" . $_SESSION['username']. "'");
		$extraido=$result->fetch_array();
		// Consulta para Tutor, Grado, Turno y Promedio
		$result1 = mysqli_query($conexion,"SELECT*FROM alumno where idAlumno='" . $_SESSION['username']. "'");
		$extraido1=$result1->fetch_array();
		// Para saber la Escuela
		$result2 = mysqli_query($conexion, "SELECT e.nombre FROM usuario u, escuela e where e.ClaveEscuela=u.ClaveEscuela and u.idUsuario='".$_SESSION['username']."'");
		$Escuela=$result2->fetch_array();
		// Para saber el grupo
		$result3 = mysqli_query($conexion, "SELECT g.nombre FROM grupo g, alumno a where g.idGrupo=a.idGrupo and a.idAlumno='".$_SESSION['username']."'");
		$Grupo=$result3->fetch_array();
		
		
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
									<p>".$extraido[2]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Apellido Paterno:</b></label>
									<p>".$extraido[3]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Apellido Materno:</b></label>
									<p>".$extraido[4]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Edad:</b></label>
									<p>".$extraido[8]."</p>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='5u 12u(mobilep)'>
									<label for='nombre'><b>Tutor:</b></label>
									<p>".$extraido1[2]."</p>
								</div>
								<div class='4u 12u(mobilep)'>
									<label for='nombre'><b>Email:</b></label>
									<p>".$extraido[6]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Sexo:</b></label>
									<p>".$extraido[9]."</p>
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
									<p>".$extraido1[4]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'><b>Grupo:</b></label>
									<p>".$Grupo[0]."</p>
								</div>
								<div class='2u 12u(mobilep)'>
									<label for='nombre'><b>Promedio:</b></label>
									<p>".$extraido1[5]."</p>
								</div>
							</div>

							<div class='row uniform'>
								<div class='12u'>
									<ul class='actions align-center'>
										<li><a href='Principal_Alumno.php' class='button special'>Regresar</a></li>
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