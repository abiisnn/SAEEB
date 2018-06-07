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
		<title>ENVIADOS</title>
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
echo"			<section id='cta'>
					<h2>".$_SESSION['username']."</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>BANDEJA DE ENTRADA</h3>
					</header>				
";
		include("conexion.php");
		include("obtenerUsuario.php");
		$con=conectar();
		if (!$con)
	  			die ("Error al conectar a la BD: ". mysqli_connect_error());
	  	else{

			$idusuario=$_SESSION['username'];
			echo "				<center>
									<ul class='actions'>
										<li><a href='Principal.php' class='button'>Inicio</a></li>
										<li><a href='bandeja.php' class='button'>Recibidos</a></li>
										<li><a href='enviados.php' class='button'>Enviados</a></li>
										<li><a href='nuevoMensaje.php?idRemitente=$idusuario' class='button'>Redactar</a></li>
									</ul>
								</center>
			";

			$mensaje=mysqli_query($con, "SELECT destinatario, idmensaje, asunto, horamensaje FROM mensaje WHERE idusuario=$idusuario ORDER BY 4 DESC"); 
			echo" <div class='row'>
						<div class='12u'>
							<!-- Table -->
								<section class='box'>
									<h3><center>MENSAJES ENVIADOS</center></h3>
									<div class='table-wrapper'>
										<table>
											<thead>
												<tr>
													<th><center></center></th>
													<th><center>USUARIO</center></th>
													<th><center>NOMBRE</center></th>
													<th><center>CARGO</center></th>
													<th><center>ASUNTO</center></th>
													<th><center>FECHA</center></th>
												</tr>
											</thead>
											<tbody>
												<tr>
				";
				if (mysqli_num_rows($mensaje)) { 
					while ($rowMensaje = mysqli_fetch_array($mensaje)) {
						$Tipo = tipoUsuario($rowMensaje[0], $con);
					echo "							<td>
														<ul class='actions'>
															<li><a href='mensaje.php?idMensaje=$rowMensaje[1]' class='button special small'>VER</a></li>
														</ul>
													</td>
													<td>$rowMensaje[0]</td> 
													<td>".usuario($rowMensaje[0], $con)."</td>
													<td> ".$Tipo." </td>
													<td> $rowMensaje[2] </td>
													<td> $rowMensaje[3]</td> 			
												</tr>
				";}
			}
			else{ 
						echo "<td>Todavia no ha recibido mensajes.</td>
								</tr>";
					}
				echo "						</tbody>
											<tfoot>
											</tfoot>
										</table>
									</div>
								</section>
						</div>
					</div>
			";
		}
?>
				</section>
			<!-- CTA -->
				<section id="cta">
				</section>
		</div>
	</body>
</html>