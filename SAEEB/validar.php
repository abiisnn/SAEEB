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
			$Tipo = "ALUMNO";
			$Tipo2 = "PROFESOR";
			if($extraido['Tipo'] == $Tipo) // Tipo ALUMNO
			{
				session_start();
				$_SESSION['usuario'] = $usuario;
				//header("Location: contenido.php");
				header("Location: Principal/Principal_Alumno.html");	
			}
			else
			{
				if($extraido['Tipo'] == $Tipo2) // Tipo PROFESOR
				{
					session_start();
					$_SESSION['usuario'] = $usuario;
					//header("Location: contenido.php");
					header("Location: Principal/Principal_Profesor.html");		
				}
				else // Tipo Orientador 
				{
					session_start();
					$_SESSION['usuario'] = $usuario;
					//header("Location: contenido.php");
					header("Location: Principal/Principal_Orientador.html");
				}
			}
		}
		else
		{
			header("Location: login.html");
			exit();
		}
		
	}
?>