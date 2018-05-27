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

		$idusuario=380001;

		echo "Bandeja de entrada. Usuario: ".usuario($idusuario, $con);
		echo "<br><br><br><br>"; 

		echo "<a href='nuevoMensaje.php?idRemitente=$idusuario'><button>Nuevo Mensaje</button></a>";
		echo "<br><br>";

		$mensaje=mysqli_query($con, "SELECT idusuario, idmensaje, asunto, horamensaje FROM mensaje WHERE destinatario=$idusuario ORDER BY 4 DESC"); 

		if (mysqli_num_rows($mensaje)) { 
			while ($rowMensaje = mysqli_fetch_array($mensaje)) { 

				echo "<a href='mensaje.php?idMensaje=$rowMensaje[1]'>$rowMensaje[0] ".usuario($rowMensaje[0], $con)." $rowMensaje[1] $rowMensaje[2] $rowMensaje[3]</a>"; 
				echo "<br><hr>"; 
		}

		}
		else{ 
			echo "Todavia no ha recibido mensajes.<br><br><br><br>";
		}
	}

?>
</body>
</html>