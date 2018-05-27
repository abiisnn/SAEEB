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
					<h1><a href='index.html'>Alpha</a> by HTML5 UP</h1>
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
				
<?php
				session_start();
				$_SESSION['idUsuario'];

echo "			<section id='main' class='container 95%'>
					<header>
						<h2>Contact Us</h2>
						<p>Tell us what you think about our little operation.</p>
					</header>
					<div class='box'>
						<form method='post' action='#'>
							<div class='row uniform 50%'>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'>Nombre(s):</label>
									<p>".extraido[2]."</p>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'>Apellido Paterno:</label>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'>Apellido Materno:</label>
								</div>
								<div class='3u 12u(mobilep)'>
									<label for='nombre'>Edad:</label>
								</div>
							</div>

							<div class='row uniform'>
								<div class='12u'>
									<ul class='actions align-center'>
										<li><a href='Principal_Alumno.html' class='button special'>Regresar</a></li>
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

					<h2>Sign up for beta access</h2>
					<p>Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc.</p>

					<form>
						<div class="row uniform 50%">
							<div class="8u 12u(mobilep)">
								<input type="email" name="email" id="email" placeholder="Email Address" />
							</div>
							<div class="4u 12u(mobilep)">
								<input type="submit" value="Sign Up" class="fit" />
							</div>
						</div>
					</form>

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