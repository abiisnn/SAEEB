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

		$idusuario=280001;

		echo "Bandeja de entrada. <br>Usuario: $idusuario - ".usuario($idusuario, $con);
		echo "<br><br><br><br>"; 

		echo "<a href='bandeja.php?idRemitente=$idusuario'><button>Recibidos</button></a>";

		echo "<a href='enviados.php?idRemitente=$idusuario'><button>Enviados</button></a>";

		echo "<a href='nuevoMensaje.php?idRemitente=$idusuario'><button>Redactar</button></a>";
		echo "<br><br>";

		$mensaje=mysqli_query($con, "SELECT idusuario, idmensaje, asunto, horamensaje FROM mensaje WHERE destinatario=$idusuario ORDER BY 4 DESC"); 

		if (mysqli_num_rows($mensaje)) { 
			while ($rowMensaje = mysqli_fetch_array($mensaje)) { 

				echo "<a href='mensaje.php?idMensaje=$rowMensaje[1]'>$rowMensaje[0] ".usuario($rowMensaje[0], $con)." $rowMensaje[2] $rowMensaje[3]</a>"; 
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