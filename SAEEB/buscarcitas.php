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
		<title>CITAS</title>
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
					<h2>".$_SESSION['username']."</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>CITAS</h3>
					</header>				
";
		include("conexion.php");
		include("obtenerUsuario.php");
		$con=conectar();
		if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  		else
  		{
  			$idusuario=$_SESSION['username'];
  			if (isset($_POST['buscar'])) 
  			{ 
		  		$fecha=$_POST['fecha'];
		  	}
		  	if (isset($_GET['id_Cita']) && isset($_GET['fechaBusq'])) 
		  	{
	  			$ic=$_GET['id_Cita'];
	  			$fecha=$_GET['fechaBusq'];
	  			$up = "UPDATE cita c, cu cu set c.confirmada=1 WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario and c.idcita=$ic";
	  			if (!mysqli_query($con, $up))
	  			{ 
	  				echo "<script type=\"text/javascript\">alert(\"Ha ocurrido un error. Intente de nuevo: ".mysqli_error($con)."\");</script>"; 
		  				$link="#";
		  		}
		  	}
  			if (tipoUsuario($idusuario,$con)=='ALUMNO')
				$tipoCitas='recibidas';
			else if (tipoUsuario($idusuario,$con)=='ORIENTADOR')
				$tipoCitas='enviadas';

			echo "	<div class='box'>
						<div class='row uniform 50%'>
							<div class='3u 12u(mobilep)'>		
								<form method='post' action='citas.php'>
									<input type='submit' name='buscar' value='Ver todas las citas'>
								</form>	
							</div>
							<div class='3u 12u(mobilep)'>		
								<label for='inputBirthday' class='control-label'>Fecha de Cita: $fecha </label>
							</div>
						</div>		<br><br>		
							
				";
			if (tipoUsuario($idusuario,$con)=='ORIENTADOR')
				{
					echo " 
						<div class='row uniform 50%'>
							<div class='6u 12u(mobilep)'>		
								<h3><center>CITAS RECIBIDAS</center></h3>				
							</div>
							<div class='6u 12u(mobilep)'>		
								<ul class='actions align-center'>
									<li><a href='nuevaCita.php' class='button special'>Generar Nueva Cita</a></li>
								</ul>
							</div>
						</div>
							<br><br>
					";
				}
				else
					echo "<br><h3><center>CITAS RECIBIDAS</center></h3>";
				// INICIO DE LA TABLA
				echo "
						<div class='table-wrapper'>
							<table>
								<thead>
									<tr>
										<th><center>ESTADO</center></th>
										<th><center>ID CITA</center></th>
										<th><center>ID</center></th>
										<th><center>USUARIO</center></th>
										<th><center>MOTIVO</center></th>
										<th><center>LUGAR</center></th>
										<th><center>FECHA</center></th>
										<th><center>HORA</center></th>
									</tr>
								</thead>
								<tbody>
			";		
			$citasOri=mysqli_query($con, "SELECT c.*, cu.idusuario FROM cita c, cu cu WHERE c.idcita=cu.idcita and c.remitente=$idusuario and fecha='$fecha' ORDER BY 3 desc, 4 asc");
			$citasAlu=mysqli_query($con, "SELECT c.*, cu.idusuario FROM cita c, cu cu WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario and fecha='$fecha' ORDER BY 3 desc, 4 asc");

			if(tipoUsuario($idusuario,$con)=='ALUMNO')
			{
				echo "<br><br>";
				if (mysqli_num_rows($citasAlu)) 
				{ 
					while ($rowCitasAlu = mysqli_fetch_array($citasAlu)) 
					{ 
						if($rowCitasAlu[6]==1)
						{
							$edo="Confirmada";
							$link="#";
						}
						else
						{
							$edo="Pendiente...";
							$link="buscarcitas.php?id_Cita=$rowCitasAlu[0]&fechaBusq=$fecha";
						}
						echo "							<td>
														<ul class='actions'>
														<li><a href='$link' class='button special small'>$edo</a></li>
													</ul>
													</td>
													<td>$rowCitasAlu[0]</td> 
													<td>$rowCitasAlu[5]</td> 
													<td>".usuario($rowCitasAlu[5], $con)."</td> 
													<td>$rowCitasAlu[4]</td> 
													<td>$rowCitasAlu[1]</td> 
													<td>$rowCitasAlu[2]</td>
													<td>$rowCitasAlu[3]</td> 									 			
												</tr>
				";
					}
				}
				else
				{ 
					echo "<td>Todavia no ha recibido mensajes.</td>
								</tr>";
				}
			}
			else if(tipoUsuario($idusuario,$con)=='ORIENTADOR')
			{
				if (mysqli_num_rows($citasOri)) 
				{ 
					while ($rowCitasOri = mysqli_fetch_array($citasOri) ) 
					{ 
						if($rowCitasOri[6]==1)
						{
							$edo="Confirmada";
							$link="#";
						}
						else
						{
							$edo="Pendiente...";
							$link="citas.php?id_Cita=$rowCitasOri[0]&fechaBusq=$fecha";
						}
						echo "						<td>
														<ul class='actions'>
														<li><a href='$link' class='button special small'>$edo</a></li>
													</ul>
													</td>
													<td>$rowCitasOri[0]</td>
													<td>$rowCitasOri[7]</td>
													<td>".usuario($rowCitasOri[7], $con)." </td>
													<td>$rowCitasOri[4]</td>
													<td> $rowCitasOri[1]</td>
													<td>$rowCitasOri[2]</td>
													<td>$rowCitasOri[3]</td>
												</tr>
				"; 
					}
				}
				else
				{ 
					echo "<td>Todavia no ha recibido mensajes.</td>
								</tr>";
				}
			}
		}
	?>
</tbody>
													<tfoot>
													</tfoot>
												</table>
											</div>
										</section>
								</div>
							</div>						
					</div>
				</section>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>