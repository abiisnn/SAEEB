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
		<title>RESULTADO BUSQUEDA</title>
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
	include ("conexion.php");
	include ("obtenerUsuario.php");
	// Probamos la conexion
	$con= conectar();
	if($con)
	{
		$idUsuario=$_SESSION['username'];
		$select=$_POST['consulta'];

			echo"		<section id='cta'>
						<h2>".$_SESSION['username']."</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>RESULTADOS COINCIDENTES CON : ".$select."</h3>
					</header>				
			";
			
			echo "				<center>
									<ul class='actions'>
										<li><a href='Principal.php' class='button'>Inicio</a></li>
										<li><a href='buscador.php' class='button'>Nueva Búsqueda</a></li>
									</ul>
								</center>
			";

			
			
			if(isset($_POST['Nombre'])){
				if(tipoUsuario($idUsuario, $con)=='ALUMNO'){
					$busqueda=mysqli_query($con, "SELECT u.idusuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.tipo, e.nombre, u.curp, u.email FROM usuario u, escuela e WHERE u.claveescuela=e.claveescuela AND (u.tipo like 'PROFESOR' or u.tipo like 'ORIENTADOR') AND (u.nombre like '%$select%' or u.ApPaterno like '%$select%' or u.ApMaterno like '%$select%') ORDER BY u.ApPaterno, u.ApMaterno, u.nombre ASC;"); 
				}
				else{
					$busqueda=mysqli_query($con, "SELECT u.idusuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.tipo, e.nombre, u.curp, u.email FROM usuario u, escuela e WHERE u.claveescuela=e.claveescuela AND (u.nombre like '%$select%' or u.ApPaterno like '%$select%' or u.ApMaterno like '%$select%') ORDER BY u.ApPaterno, u.ApMaterno, u.nombre ASC;"); 
				}
				

			}
			else if(isset($_POST['ID'])){
				if(tipoUsuario($idUsuario, $con)=='ALUMNO')
				{
					$busqueda=mysqli_query($con, "SELECT u.idusuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.tipo, e.nombre, u.curp, u.email FROM usuario u, escuela e WHERE u.claveescuela=e.claveescuela AND (u.tipo like 'PROFESOR' or u.tipo like 'ORIENTADOR') AND u.idusuario=$select ORDER BY u.ApPaterno, u.ApMaterno, u.nombre ASC;"); 
				}
				else{
					$busqueda=mysqli_query($con, "SELECT u.idusuario, u.Nombre, u.ApPaterno, u.ApMaterno, u.tipo, e.nombre, u.curp, u.email FROM usuario u, escuela e WHERE u.claveescuela=e.claveescuela AND u.idusuario=$select ORDER BY u.ApPaterno, u.ApMaterno, u.nombre ASC;"); 
				}
				
				
			}

			
			echo" 	<div class='row'>
						<div class='30u'>
							<!-- Table -->

								<section class='box'>
									<div class='table-wrapper'>
										<table>
											<thead>
												<tr>
													<th><center>ID </center></th>
													<th><center>NOMBRE </center></th>
													<th><center>CARGO</center></th>
													<th><center>ESCUELA</center></th>
													<th><center>CURP</center></th>
													<th><center>EMAIL</center></th>
													<th><center>MATERIA</center></th>

												</tr>
											</thead>
											<tbody>

												<tr>
				";

				if(!$select && isset($_POST['ID'])){
					echo "<td>Debe de especificar un ID válido de usuario. Intente de nuevo!</td>
								</tr>";
				}
				else{
					if (mysqli_num_rows($busqueda)) 
				{ 
					while (($rowBusqueda = mysqli_fetch_array($busqueda)))
					{
				
					    echo "						<td><center>$rowBusqueda[0]</center></td>
					    							<td><center>$rowBusqueda[2] $rowBusqueda[3] $rowBusqueda[1]</center></td>
					    							<td><center>$rowBusqueda[4]</center></td>
					    							<td><center>$rowBusqueda[5]</center></td>
					    							<td><center>$rowBusqueda[6]</center></td>
					    							<td><center>$rowBusqueda[7]</center></td>";
					    	if($rowBusqueda[4]=='PROFESOR'){
					    	echo "<td><center>".nombreMateria(ObtenerMateria($rowBusqueda[0], $con), $con)."</center></td>";
					    	}
					    							
					    					
						echo "					 		</td>
												
												</tr>
				";
					}//FIN WHILE
				}//FIN IF
				else{
					echo "<td>No se han encontrado resultados para su busqueda. Pruebe de nuevo!</td>
								</tr>";
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
			
		//} // FIN ACEPTAR
		
	} // FIN CONEXION
	
?>
</section>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>