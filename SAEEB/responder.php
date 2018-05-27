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
  		if (isset($_POST['enviar'])) { 

  			$nuevoid=rand($_POST['idMensaje']+23, $_POST['idMensaje']+100);
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
	  		$id = $_GET['idMensaje'];



			$sql = mysqli_query($con, "SELECT * FROM mensaje WHERE idmensaje = '$id'");  

			$row = mysqli_fetch_array($sql); 


			echo "<table>
					<tr>
					<td><b>Enviado por: </b> $row[1] - ".usuario($row[1], $con)."<br><br>
					<b>Asunto:</b> <i>$row[5]</i>
					<br><br><br>
					<b>Mensaje:</b>
					<br>
					$row[2]</font></td></tr>
					</TABLE>
					<br><br><br>
					"; 

			echo "<form action='responder.php' method='POST'>
			<table>
			<tr>
			De: <input type='text' value='$row[3] - ".usuario($row[3], $con)."' size=40>
			<br><br>
			Para: <input type='text' value='$row[1] - ".usuario($row[1], $con)."' size=40>
			<br><br>
			Asunto: <input type='text' name='asunto' value='Re: $row[5]' size=50>
			<br><br>
			Mensaje: <textarea name='mensaje' cols=50 rows=10></textarea>
			<br></td>
			</tr>
			</table><br>
			<input type='hidden' value='$id' name='idMensaje'>
			<input type='hidden' value='$row[3]' name='remitente'>
			<input type='hidden' value='$row[1]' name='destino'>
			<input type='submit' name='enviar' value='Enviar mensaje'>
			</form>"
			;

			echo "<a href=bandeja.php><button>Volver a la bandeja de entrada</button></a>";
	  	}
	  }
?>
</body>
</html>
