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
		<title>MENSAJE</title>
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
				<section id='main' class='container 50%'>
					<header>
						<h3>MENSAJE</h3>
					</header>				
";
	include("conexion.php");
	include("obtenerUsuario.php");

	$con=conectar();

	if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  	else{
  		$id = $_GET['idMensaje'];
		$sql = mysqli_query($con, "SELECT * FROM mensaje WHERE idmensaje = '$id'");  
		$row = mysqli_fetch_array($sql); 

		echo"			
					<div class='box'>	
						<form method='post' action='bandeja.php'>
							<div class='row uniform 50%'>
								<div class='12u 12u(mobilep)'>
									<label for='nombre'><b>ENVIADO  POR: </b> $row[1]  " .usuario($row[1], $con)."</label>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
									<label for='nombre'><b>PARA: </b> $row[3] ".usuario($row[3], $con)."</label>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
									<label for='nombre'><b>ASUNTO: </b><i> $row[5]</i></label>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
									<label for='nombre'><b>Mensaje:  </b> </label>
									<p>$row[2]</p>
								</div>
							</div>
							<div class='row uniform'>
								<div class='12u'>
									<ul class='actions align-center'>
										<li><input type='submit' value='Bandeja de Entrada' /></li>
										<li><a href='responder.php?idMensaje=$id' class='button special'>Responder</a></li>
									</ul>
								</div>
							</div>
						</form>
";
  	}
?>
								
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>





<html>
<title>
	Bandeja de Entrada - SAEEB
</title>
<body>
	<br>

</body>
</html>
