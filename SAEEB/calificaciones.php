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

<!DOCTYPE html>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Calificaciones</title>
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
						<h3>CALIFICACIONES</h3>
					</header>				
";
	include("conexion.php");
	include("obtenerUsuario.php");
	$con = conectar();
	if($con)
	{
		$usuario = $_SESSION['username'];
		$Tipo = tipoUsuario($usuario, $con);

		/* Para el tipo de Usuario: ALUMNO, unicamente permite visualizar sus calificaciones hasta ese momento. 
		*/
		if($Tipo == "ALUMNO")
		{
			$res2 = mysqli_query($con,"SELECT m.idMateria,m.Nombre,x.Calificacion from 	Materia m,am x where m.idmateria=x.idmateria and idAlumno='$usuario'");
			echo" <div class='row'>
						<div class='12u'>
							<!-- Table -->
								<section class='box'>
									<h3><center>PERIODO ACTUAL</center></h3>
									<div class='table-wrapper'>
										<table>
											<thead>
												<tr>
													<th><center>ID</center></th>
													<th><center>MATERIA</center></th>
													<th><center>CALIFICACIÓN</center></th>
												</tr>
											</thead>
											<tbody>
												<tr>
				";
  			if (mysqli_num_rows($res2))
  			{
				while ($row = mysqli_fetch_array($res2)) 
				{
					echo "							
													<td><center>$row[0]</center></td> 
													<td>$row[1]</td>
													<td><center>$row[2]</center></td>  		
												</tr>
				";
				}
			}
		}
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
?>

</section>
			<!-- CTA -->
				<section id="cta">
				</section>
		</div>
	</body>
</html>