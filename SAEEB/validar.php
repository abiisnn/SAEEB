<?php
session_start();
?>
<?php
	$usuario = $_POST['nnombre'];
	$pass = $_POST['npassword'];

	// Cuando no se han ingresado datos
	if(empty($usuario) || empty($pass))
	{
		header("Location: login.html");
		exit();
	}
	include ("conexion.php");
	// Probamos la conexion
	$conexion = conectar();
	if($conexion)
	{
		$result = mysqli_query($conexion,"SELECT*FROM usuario where idUsuario='" . $usuario . "'");
		$extraido=$result->fetch_array();
		// Valida que el usuario y contraseña sean validos
		if($extraido['idUsuario'] ==  $usuario && $extraido['Contrasena'] ==  $pass)
		{
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $usuario;
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (20*60);
			$Tipo = "ALUMNO";
			$Tipo2 = "PROFESOR";
			header("Location: Principal.php");
			/*if($extraido['Tipo'] == $Tipo) // Tipo ALUMNO
			{
				header("Location: Principal_Alumno.php");	
			}
			else
			{
				if($extraido['Tipo'] == $Tipo2) // Tipo PROFESOR
				{
					header("Location: Principal_Profesor.php");		
				}
				else // Tipo Orientador 
				{
					header("Location: Principal_Orientador.php");
				}
			}*/
		}
		else
		{
			header("Location: index.html");
			exit();
		}
	}
	mysqli_close($conexion);
?>