<?php

	$usuario = $_POST['nnombre'];
	$pass = $_POST['npassword'];

	// Cuando no se han ingresado datos
	if(empty($usuario) || empty($pass))
	{
		header("Location: index.html");
		exit();
	}
	include ("conectar.php");
	// Probamos la conexion
	$conexion = conectar();
	if($conexion)
	{
		$result = mysqli_query($conexion,"SELECT*FROM usuario where idUsuario='" . $usuario . "'");
		$extraido=$result->fetch_array();
		// Valida que el usuario y contraseña sean validos
		if($extraido['idUsuario'] ==  $usuario && $extraido['Contrasena'] ==  $pass)
		{
			//session_start();
			//$_SESSION['usuario'] = $usuario;
			//header("Location: contenido.php");
			header("Location: Principal_Alum.html");
		}
		else
		{
			header("Location: index.html");
			exit();
		}
		
	}
?>