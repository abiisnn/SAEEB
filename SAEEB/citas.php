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
  		$idusuario=$_SESSION['username'];


  		if (isset($_GET['id_Cita'])) {
  			$ic=$_GET['id_Cita'];
  			$up = "UPDATE cita c, cu cu set c.confirmada=1 WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario and c.idcita=$ic";

  			if (!mysqli_query($con, $up)){ 
  				echo "<script type=\"text/javascript\">alert(\"Ha ocurrido un error. Intente de nuevo: ".mysqli_error($con)."\");</script>"; 
  				$link="#";
  			}

  		}



			
			echo "Citas recibidas. <br>Usuario: $idusuario - ".usuario($idusuario, $con);
			echo "<br><br><br><br>"; 

			echo "<div class='col-xs-6 col-sm-6'>
			<label for='inputBirthday' class='control-label'>Fecha de Cita </label>
			<form method='get' action='buscarcitas.php'>
				<input name='fecha' type='date' class='form-control' value=".date('Y-m-d',strtotime('now'))." required>
				<input type='submit' name='buscar' value='Buscar citas por fecha'> </form> <a href='citas.php'><button>Ver todas las citas</button></a><br><br>
			";

			$citas=mysqli_query($con, "SELECT c.*, cu.idusuario FROM cita c, cu cu WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario ORDER BY 1 DESC"); 

			if (mysqli_num_rows($citas)) { 
				while ($rowCitas = mysqli_fetch_array($citas)) { 
					if($rowCitas[6]==1){
						$edo="Confirmada";
						$link="#";
					}
					else{
						$edo="Pendiente...";
						$link="citas.php?id_Cita=$rowCitas[0]";
					}




					echo "$rowCitas[0] $rowCitas[5] ".usuario($rowCitas[5], $con)." $rowCitas[4] $rowCitas[1] $rowCitas[2] $rowCitas[3]"; 
					echo "	
								<a href='$link'><button>$edo</button></a>
							<br><hr>"; 
				}

			}
			else{ 
				echo "Todavia no ha recibido citas.<br><br><br><br>";
			}
		}
	
	?>

	</body>
</html>