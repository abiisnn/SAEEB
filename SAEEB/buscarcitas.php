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
  			if (isset($_POST['buscar'])) { 
		  		$idusuario=$_SESSION['username'];
		  		$fecha=$_POST['fecha'];



		  		if (isset($_GET['id_Cita'])) {
		  			$ic=$_GET['id_Cita'];
		  			$up = "UPDATE cita c, cu cu set c.confirmada=1 WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario and c.idcita=$ic";

		  			if (!mysqli_query($con, $up)){ 
		  				echo "<script type=\"text/javascript\">alert(\"Ha ocurrido un error. Intente de nuevo: ".mysqli_error($con)."\");</script>"; 
		  				$link="#";
		  			}

		  		}


		  			if (tipoUsuario($idusuario,$con)=='ALUMNO')
  						$tipoCitas='recibidas';
  					else if (tipoUsuario($idusuario,$con)=='ORIENTADOR')
  						$tipoCitas='enviadas';

					
					echo "Citas $tipoCitas. <br>Usuario: $idusuario - ".usuario($idusuario, $con);
					echo "<br><br><br><br>"; 

					echo "<div class='col-xs-6 col-sm-6'>
					<label for='inputBirthday' class='control-label'>Fecha de Cita: $fecha </label>
						<br><br><a href='citas.php'><button>Ver todas las citas</button></a>
					";

					$citasOri=mysqli_query($con, "SELECT c.*, cu.idusuario FROM cita c, cu cu WHERE c.idcita=cu.idcita and c.remitente=$idusuario and fecha='$fecha' ORDER BY 3 desc, 4 asc");
					$citasAlu=mysqli_query($con, "SELECT c.*, cu.idusuario FROM cita c, cu cu WHERE c.idcita=cu.idcita and cu.idusuario=$idusuario and fecha='$fecha' ORDER BY 3 desc, 4 asc"); 


			if(tipoUsuario($idusuario,$con)=='ALUMNO'){
				echo "<br><br>";
				if (mysqli_num_rows($citasAlu)) { 
					while ($rowCitasAlu = mysqli_fetch_array($citasAlu)) { 
						if($rowCitasAlu[6]==1){
							$edo="Confirmada";
							$link="#";
						}
						else{
							$edo="Pendiente...";
							$link="citas.php?id_Cita=$rowCitasAlu[0]";
						}




						echo "$rowCitasAlu[0] $rowCitasAlu[5] ".usuario($rowCitasAlu[5], $con)." $rowCitasAlu[4] $rowCitasAlu[1] $rowCitasAlu[2] $rowCitasAlu[3]"; 
						echo "	
									<a href='$link'><button>$edo</button></a>
								<br><hr>"; 
					}

				}
				else{ 
					echo "Todavia no ha recibido citas.<br><br><br><br>";
				}

			}
			else if(tipoUsuario($idusuario,$con)=='ORIENTADOR'){

				echo "<a href='nuevaCita.php'><button>Generar Nueva Cita</button></a><br><br>";
				if (mysqli_num_rows($citasOri)) { 
					while ($rowCitasOri = mysqli_fetch_array($citasOri) ) { 
						if($rowCitasOri[6]==1){
							$edo="Confirmada";
							$link="#";
						}
						else{
							$edo="Pendiente...";
							$link="citas.php?id_Cita=$rowCitasOri[0]";
						}




						echo "$rowCitasOri[0] $rowCitasOri[7] ".usuario($rowCitasOri[7], $con)." $rowCitasOri[4] $rowCitasOri[1] $rowCitasOri[2] $rowCitasOri[3]"; 
						echo "	
									<button>$edo</button>
								<br><hr>"; 
					}

				}
				else{ 
					echo "Todavia no ha recibido citas.<br><br><br><br>";
				}
			}
		}
			
		}
	
	?>

	</body>
</html>