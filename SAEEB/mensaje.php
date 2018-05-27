<html>
<title>
	Bandeja de Entrada - SAEEB
</title>
<body>
	<br>
<?php
	include("conexion.php");
	include("obtenerUsuario.php");

	$con=conectar();

	if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  	else{
  		$id = $_GET['idMensaje'];



		$sql = mysqli_query($con, "SELECT * FROM mensaje WHERE idmensaje = '$id'");  

		$row = mysqli_fetch_array($sql); 


		echo "<table>
				<tr>
				<td><b>Enviado por: </b>".usuario($row[1], $con)." >IdUsuario: $row[1]< <br><br>
				<b>Asunto:</b> <i>$row[5]</i>
				<br><br><br>
				<b>Mensaje:</b>
				<br>
				$row[2]</font></td></tr>
				</TABLE>
				<br><br><br>
				"; 

		echo "
		<a href='responder.php?idMensaje=$id'><button>Responder el mensaje</button></a><br><br>
		<a href=bandeja.php><button>Volver a la bandeja de entrada</button></a>";
  	}
?>
</body>
</html>
