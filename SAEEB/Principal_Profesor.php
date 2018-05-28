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
		<div id="page-wrapper">
			<!-- Header -->
				<header id="header" class="alt">
					<nav id="nav">
						<ul>
							<li><a href="Principal_Orientador.php">Inicio</a></li>
							<li>
								<a href="CerrarSesion.php">Cerrar Sesión</a>
							</li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<h2>Bienvenido a SAEEB</h2>
				</section>

			<!-- Main -->
				<section id="main" class="container">
					<section class="box special features">
						<div class="features-row">
							<section>
								<span class="icon major fa fa-child accent2"></span>
								<h3>Información Personal</h3>
								<ul class="actions">
									<li><a href="InfoPersonal_Profesor.php" class="button alt">Ver</a></li>
								</ul>
							</section>
							<section>
								<span class="icon major fa fa-folder-open-o accent3"></span>
								<h3>Ver Calificaciones</h3>
								<ul class="actions">
									<li><a href="#" class="button alt">Ver</a></li>
								</ul>
							</section>
						</div>
						<div class="features-row">
							<section>
								<span class="icon major fa fa-envelope accent4"></span>
								<h3>Bandeja de Entrada</h3>
								<ul class="actions">
									<li><a href="bandeja.php" class="button alt">Ver</a></li>
								</ul>
							</section>
							<section>
								<span class="icon major fa fa-calendar-plus-o accent1"></span>
								<h3>Agregar Citas</h3>
								<ul class="actions">
									<li><a href="#" class="button alt">Ver</a></li>
								</ul>
							</section>
							<section>
								<span class="icon major fa fa-calendar-check-o accent2"></span>
								<h3>Ver Citas</h3>
								<ul class="actions">
									<li><a href="#" class="button alt">Ver</a></li>
								</ul>
							</section>
							<section>
								<span class="icon major fa fa-file-pdf-o accent3"></span>
								<h3>Boletas de Calificaciones</h3>
								<ul class="actions">
									<li><a href="#" class="button alt">Ver</a></li>
								</ul>
							</section>
						</div>
					</section>
				</section>

			<!-- CTA -->
				<section id="cta">
					<form>
						<div class="row uniform 50%">
							
						</div>
					</form>
				</section>
		</div>
	</body>
</html>