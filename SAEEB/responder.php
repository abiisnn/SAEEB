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
		<title>RESPONDER</title>
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
							<li>
								<a href="CerrarSesion.php">Cerrar Sesión</a>
							</li>
						</ul>
					</nav>
				</header>
<?php
	echo"			<section id='cta'>
					<h2>".$_SESSION['username']."</h2>
				</section>
				<section id='main' class='container 200%'>
					<header>
						<h3>REDACTAR MENSAJE</h3>
					</header>	
					
					<div class='box'>
						<section class='box special features'>		
							<div class='features-row'>
								<section>
									<span class='icon major fa fa-envelope accent4'></span>
									<h3>MENSAJE</h3>
	";
	include("conexion.php");
	include("obtenerUsuario.php");
	$con=conectar();

	if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  	else
  	{
  		if (isset($_POST['enviar'])) 
  		{ 

  			$nuevoid=rand($_POST['idMensaje']+23, $_POST['idMensaje']+100);
  			$Remitente=$_POST['remitente'];
  			$Destinatario=$_POST['destino'];
  			$nuevoAsunto=$_POST['asunto'];
  			$nuevoMensaje=$_POST['mensaje'];
  			$hora='CURRENT_TIMESTAMP';

			$sql = "insert into mensaje values ($nuevoid, $Remitente, '$nuevoMensaje', $Destinatario, $hora, '$nuevoAsunto')";

			if (mysqli_query($con, $sql))
			{ 
				echo "
						<ul class='actions align-center'>
										<li><a href='bandeja.php' class='button special'>Regresar a la Bandeja</a></li>
									</ul>
					</section>
				";
			} 
			else { 

			echo "Hubo un error al agregar el mensaje".mysqli_error($con)."<br><br><a href=bandeja.php><font color=black><button>Intentar de nuevo</button></font></a>";
			}
		} 
		else
		{
	  		$id = $_GET['idMensaje'];
			$sql = mysqli_query($con, "SELECT * FROM mensaje WHERE idmensaje = '$id'");  
			$row = mysqli_fetch_array($sql); 


				if($row[3]==$_SESSION['username']){
					echo "Recibido<br><br>";
					$remi=$row[3];
					$desti=$row[1];
				}

				else{
					echo "Enviado<br><br>";
					$remi=$row[1];
					$desti=$row[3];
				}


			echo "		<form method='post' action='bandeja.php'>
							<div class='row uniform 50%'>
								<div class='12u 12u(mobilep)'>
									<label for='nombre'><b>ENVIADO  POR: </b> $row[1] ".usuario($row[1], $con)."</label>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
									<label for='nombre'><b>PARA: </b> $row[3] ".usuario($row[3], $con)."</label>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
									<label for='nombre'><b>ASUNTO: </b><i>  $row[5]</i></label>
								</div>
							</div>
							<div class='row uniform 50%'>
								<div class='12u'>
									<label for='nombre'><b>Mensaje:  </b> </label>
									<p>$row[2]</p>
								</div>
							</div>
						</form>
					</section>
			";
			echo "								
								<section>
									<span class='icon major fa fa-edit accent4'></span>
									<h3>RESPUESTA</h3>

								<form action='responder.php' method='POST'>
								<table>
								<tr>
								De: <input type='text' value='$remi - ".usuario($remi, $con)."' size=40>
								Para: <input type='text' value='$desti - ".usuario($desti, $con)."' size=40>
								Asunto: <input type='text' name='asunto' value='Re: $row[5]' size=50>
								Mensaje: <textarea name='mensaje' cols=20 rows=4></textarea>
								</td>
								</tr>
								</table><br>
								<input type='hidden' value='$id' name='idMensaje'>
								<input type='hidden' value='$remi' name='remitente'>
								<input type='hidden' value='$desti' name='destino'>
								<input type='submit' name='enviar' value='Enviar mensaje'>
								</form>
								</section>
							</div>

						</section>
					</div>
					<div class='row uniform'>
								<div class='12u'>
									<ul class='actions align-center'>
										<li><a href='bandeja.php' class='button special'>Regresar</a></li>
									</ul>
								</div>
							</div>
				</section>
";
	  	}
	  }

	
?>
			<!-- Main -->
				
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