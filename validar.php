<?php

	$usuario = $_POST['nnombre'];
	$pass = $_POST['npassword'];

	// Cuando no hay datos
	if(empty($usuario) || empty($pass))
	{
		header("Location: index.html");
		exit();
	}
	// Probamos la conexion
	$conexion = conectar();
	if($conexion)
	{
		$result = mysqli_query($conexion,"SELECT*FROM usuario where idUsuario='" . $usuario . "'");
		$extraido=$result->fetch_array();
		if($extraido['idUsuario'] ==  $usuario && $extraido['Contrasena'] ==  $pass)
		{
			session_start();
			$_SESSION['usuario'] = $usuario;
			header("Location: contenido.php");
		}
		else
		{
			header("Location: index.html");
			exit();
		}
		
	}

	// Método que permite conectar con la BD
	function conectar()
	{
		$user = "root";
		$pass = "root";
		$server = "localhost";
		$db = "saeeb";
		$con = mysqli_connect($server, $user, $pass,$db);
		if (mysqli_connect_errno())
		{
  			echo "Error al conectar a la BD: " . mysqli_connect_error();
  		}
		return $con;
	}
?>
