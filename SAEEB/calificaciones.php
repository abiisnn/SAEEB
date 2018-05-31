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
<html>
<head>
	<title>Calificaciones</title>
</head>
<body>

<?php
	include("conexion.php");
	include("obtenerUsuario.php");
	$con = conectar();
	if($con)
	{
		$usuario = $_SESSION['username'];
		$Tipo = tipoUsuario($usuario, $con);

		if($Tipo == "ALUMNO")
		{

			$sql = "SELECT m.idMateria,m.Nombre,x.Calificacion from 	Materia m,am x where m.idmateria=x.idmateria and idAlumno='$usuario";
			$result = mysqli_query($con, $sql);
			$Cal=$result->fetch_array();
			echo "<p>".$Cal[0]."</p>";


			$res2 = mysqli_query($con,"SELECT m.idMateria,m.Nombre,x.Calificacion from 	Materia m,am x where m.idmateria=x.idmateria and idAlumno='$idAlumno'");
  		if (mysqli_num_rows($res2)){
			while ($row = mysqli_fetch_array($res2)) 
			{
					echo"
						 <tr>
    						<td>$row[0]</td>
   							<td>$row[1]</td> 
    						<td>$row[2]</td>
  						</tr>
					";
			}
		}
		}
		else
		{
			if($Tipo == "PROFESOR")
			{

			}
			else
			{

			}
		}
	}
	 
?>



</body>
</html>