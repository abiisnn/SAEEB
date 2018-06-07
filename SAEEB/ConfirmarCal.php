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
		<title>CONFIRMACIÓN</title>
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
					<h2>SAEEB</h2>
				</section>
				<section id='main' class='container 95%'>
					<header>
						<h3>Boleta de Calificaciones</h3>
					</header>				
";
	include ("conexion.php");
	include ("obtenerUsuario.php");

	// Probamos la conexion
	$con= conectar();
	if($con)
	{
		$idUsuario=$_SESSION['username'];
		$limite = $_POST["var"];
		$grupo = $_POST["grupo"];
		echo" <div class='row'>
					<div class='12u'>";
		for ($i=0; $i<$limite; $i++)
		{
			$Calificacion[$i] = $_POST["cal_".$i.""];
			//echo "<br>".$Calificacion[$i]." ";
		}
		echo" </div>
			</div>";

		$idusuario = $idUsuario;
		$materia =  ObtenerMateria($idusuario, $con); 
		

			//insert into am values (280002, 580000, 0); IDALUMNO, IDMATERIA, Calificacion
		$alumno = mysqli_query($con, "SELECT a.idAlumno, a.idGrupo FROM usuario u, Alumno a, grupo g WHERE u.idUsuario=a.idAlumno AND a.idGrupo=g.idGrupo AND g.idGrupo='$grupo' ORDER BY 1 ASC;"); 
		$j = 0;
		//mysqli_query($con, "INSERT INTO am VALUES ($rowAlumno[0], $materia, $Calificacion[$j]);");
		if (mysqli_num_rows($alumno)) 
		{ 
			while ($rowAlumno = mysqli_fetch_array($alumno)) 
			{
			    mysqli_query($con, "INSERT INTO am VALUES ($rowAlumno[0], $materia, $Calificacion[$j]);");
			    $j++;
			}
		}
	} // FIN CONEXION
	
?>
			<!-- CTA -->
				<section id="cta">
				</section>

		</div>
	</body>
</html>