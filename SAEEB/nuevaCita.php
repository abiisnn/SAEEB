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
		<title>AGENDAR CITA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body  class="landing">
		<div id="page-wrapper">
			<!-- Header -->
				<header id="header" class="alt">
					<nav id="nav">
						<ul>
							<li><a href="CerrarSesion.php">Cerrar Sesion</a></li>
						</ul>
					</nav>
				</header>
	<?php
		$idusuario=$_SESSION['username'];
	echo"			<section id='cta'>
					<h2>".$idusuario."</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>AGENDAR CITA</h3>
					</header>				
";
	include("conexion.php");
	include("obtenerUsuario.php");

	$con=conectar();

	if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  	else{
  		if (isset($_POST['nuevaC'])) { 
  			
  			$nuevoid=$_POST['idCita'];
  			$Remitente=$_POST['remitente'];
  			$Destinatario=$_POST['destino'];
  			$nuevoAsunto=$_POST['asunto'];
  			$lugar=$_POST['lugar'];
  			$hora=$_POST['hora'];
  			$fecha=$_POST['fecha'];

			$sql1 = "insert into cita values ($nuevoid, '$lugar', '$fecha', '$hora', '$nuevoAsunto', $Remitente, 0)";
			$sql2 = "insert into cu values ($Destinatario, $nuevoid)";

			if (mysqli_query($con, $sql1) && mysqli_query($con, $sql2)){ 

				echo " <center>La cita se ha agendado correctamente.</center><br><br>
						<ul class='actions align-center'>
										<li><a href='citas.php' class='button'>Regresar a Citas</a></li>
									</ul>
					</section>
				";

			} 
			else { 

			echo "<center>Hubo un error al agendar la cita. Tal vez el identificador de cita ya existia: ".mysqli_error($con).". Intente de nuevo.</center><br><br>
						<ul class='actions align-center'>
										<li><a href='citas.php' class='button'>Regresar a Citas</a></li>
									</ul>
					</section>
				";
			}
		
		} 
		else{


	  		$desti=DestiOri($idusuario, $con);



				echo"
					<div class='box'>
						<form method='post' action='nuevaCita.php'>
							<div class='row uniform 20%''>
								<div class='2u'>
									<label for='idcita'><b>Id Cita:</b></label>
									<input type='text' name='idCita' value='".rand(9999,90000)."' maxlength='11'/>
								</div>
								<div class='6u 12u(mobilep)'>
									<label for='fecha'><b>Fecha:</b></label>
									<input name='fecha' type='date' value=".date('Y-m-d',strtotime('now'))." required>

								</div>
							</div>


							<div class='row uniform 50%'>
								<div class='6u 12u(mobilep)''>
									<label for='nombre'><b>De:</b></label>
									<input type='text' name='remitente' value='$idusuario - ".usuario($idusuario, $con)."'/>
								</div>
								<div class='6u 12u(mobilep)'>
									<label for='nombre'><b>Para:</b></label>
									<select name='destino'>";
								
					if (mysqli_num_rows($desti)) { 
						while ($row = mysqli_fetch_array($desti)) { 
							echo "<option value='$row[0]'> $row[0] - $row[1]</option>";
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
								<div class='6u'>
									<label for='nombre'><b>Lugar:</b></label>
									<input type='text' name='lugar'  value=''/>
								</div>

								<div class='6u'>
									<label for='nombre'><b>Hora:</b></label>
									<input type='time' name='hora'  value='12:00'/>
								</div>
							</div>


							<div class='row uniform'>
								<div class='12u'>
									<ul class='actions align-center'>
										<input type='hidden' value='$idusuario' name='remitente'>
										<li><input type='submit' name='nuevaC' value='Agendar Cita'></li>
										<li><a href='citas.php' class='button special'>Cancelar y Regresar</a></li>
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
