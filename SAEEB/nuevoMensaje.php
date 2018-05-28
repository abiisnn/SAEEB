<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Contact - Alpha by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<nav id="nav">
						<ul>
							<li><a href="index.html">Inicio</a></li>
							<li><a href="index.html">Cerrar Sesion</a></li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container 75%">
					<header>
						<h2>Envio Emails</h2>
					</header>
	<?php
		include("conexion.php");
	include("obtenerUsuario.php");

	$con=conectar();

	if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  	else{
  		if (isset($_POST['nuevoM'])) { 

  			$nuevoid=rand(23,2000);
  			$Remitente=$_POST['remitente'];
  			$Destinatario=$_POST['destino'];
  			$nuevoAsunto=$_POST['asunto'];
  			$nuevoMensaje=$_POST['mensaje'];
  			$hora='CURRENT_TIMESTAMP';

			$sql = "insert into mensaje values ($nuevoid, $Remitente, '$nuevoMensaje', $Destinatario, $hora, '$nuevoAsunto')";

			if (mysqli_query($con, $sql)){ 

				echo "El mensaje se ha enviado correctamente.<br><br><a href=bandeja.php><font color=black><button>Volver a la bandeja de entrada.</button></font></a>";

			} 
			else { 

			echo "Hubo un error al agregar el mensaje".mysqli_error($con)."<br><br><a href=bandeja.php><font color=black><button>Intentar de nuevo</button></font></a>";
			}

		} 
		else{
	  		$idRemitente = $_GET['idRemitente'];

	  		if(tipoUsuario($idRemitente, $con)=='ORIENTADOR'){
	  			$desti=DestiOri($idRemitente, $con);


	  		}
	  		else if(tipoUsuario($idRemitente, $con)=='ALUMNO'){
	  			$desti=DestiAlumno($idRemitente, $con);

	  		}
	  		else if(tipoUsuario($idRemitente, $con)=='PROFESOR'){
	  			$desti=DestiProf($idRemitente, $con);

	  		} 
				echo"
					<div class='box'>
						<form method='post' action='nuevoMensaje.php'>
							<div class='row uniform 50%'>
								<div class='6u 12u(mobilep)''>
									<label for='nombre'><b>De:</b></label>
									<input type='text' name='remitente' value='$idRemitente - ".usuario($idRemitente, $con)."'/>
								</div>
								<div class='6u 12u(mobilep)'>
									<label for='nombre'><b>Para:</b></label>
									<select name='destino'>";
								
				if(tipoUsuario($idRemitente, $con)=='ALUMNO'){
					if (mysqli_num_rows($desti)) { 
								while ($row = mysqli_fetch_array($desti)) { 
									echo "<option value='$row[0]'> $row[0] - $row[1] $row[2] $row[3]</option>";
									}
								}
					}
					else{
						if (mysqli_num_rows($desti)) { 
								while ($row = mysqli_fetch_array($desti)) { 
									echo "<option value='$row[0]'> $row[0] - $row[1]</option>";
									}
								}
				}
				echo " 
							</select>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
								<label for='nombre'><b>Asunto:</b></label>
									<input type='text' name='asunto'  value=''/>
								</div>
							</div>
							<div class='row uniform 50%''>
								<div class='12u'>
									<label for='nombre'><b>Mensaje:</b></label>
									<textarea name='mensaje' rows='6'></textarea>
								</div>
							</div>
							<div class='row uniform'>
								<div class='12u'>
									<ul class='actions align-center'>
										<input type='hidden' value='$idRemitente' name='remitente'>
										<li><input type='submit' name='nuevoM' value='Enviar mensaje'></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
				</section>
		</div>


				<!-- Scripts -->
					<script src='assets/js/jquery.min.js'></script>
					<script src='assets/js/jquery.dropotron.min.js'></script>
					<script src='assets/js/jquery.scrollgress.min.js'></script>
					<script src='assets/js/skel.min.js'></script>
					<script src='assets/js/util.js'></script>
					<!--[if lte IE 8]><script src='assets/js/ie/respond.min.js'></script><![endif]-->
					<script src='assets/js/main.js'></script>";
			}
		}
			
	?>
	</body>
</html>
