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
	  		$idRemitente = $_GET['idRemitente'];

	  		$rowsDestinatarios=consultaDesti($idRemitente, $con);


	  			



			echo "<form action='responder.php' method='POST'>
			<table>
			<tr>
			De: <input type='text' value='".usuario($idRemitente, $con)."' size=40>
			<br><br>
			Para: <input type='text' size=40 name='destino'>
			<br><br>
			Asunto: <input type='text' name='asunto' name='asunto' size=50>
			<br><br>
			Mensaje: <textarea name='mensaje' cols=50 rows=10></textarea>
			<br></td>
			</tr>
			</table><br>
			<input type='hidden' value='$idRemitente' name='remitente'>
			<input type='submit' name='enviar' value='Enviar mensaje'>
			</form>"
			;

			echo "<a href=bandeja.php><button>Volver a la bandeja de entrada</button></a>";
	  	}
	  
	}
?>
</body>
</html>