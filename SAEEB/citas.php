<html>
<title>
	Citas - SAEEB
</title>
	<body>
		<?php
		include("conexion.php");
		include("obtenerUsuario.php");
		$con=conectar();
	if (!$con)
  			die ("Error al conectar a la BD: ". mysqli_connect_error());
  	else{
		$idusuario=280001;
		echo "Citas recibidas. <br>Usuario: $idusuario - ".usuario($idusuario, $con);
		echo "<br><br><br><br>"; 

		echo "<div class='col-xs-6 col-sm-6'>
		<label for='inputBirthday' class='control-label'>Fecha de Cita </label>
		<input name='fecha' type='date' class='form-control' id='fecha' value=".date('Y-m-d',strtotime('now'))." required><br><br>";

		$citas=mysqli_query($con, "SELECT c.*, cu.idusuario FROM cita c, cu cu WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario ORDER BY 1 DESC"); 

		if (mysqli_num_rows($citas)) { 
			while ($rowCitas = mysqli_fetch_array($citas)) { 

				echo "$rowCitas[5] ".usuario($rowCitas[5], $con)." $rowCitas[4] $rowCitas[1] $rowCitas[2] $rowCitas[3]"; 
				echo "<br><hr>"; 
		}

		}
		else{ 
			echo "Todavia no ha recibido citas.<br><br><br><br>";
		}
	}
	?>

	</body>
</html>