<?php
	function conectar(){
		$user="root";
		$pass="root";
		$server="localhost";
		$db="saeeb";
		$con=mysqli_connect($server, $user, $pass,$db);
		if (mysqli_connect_errno()){
  			echo "Error al conectar a la BD: " . mysqli_connect_error();
  		}
		return $con;
	}
?>