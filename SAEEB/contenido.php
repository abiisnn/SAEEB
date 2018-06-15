<!DOCTYPE html>
<html>
<head>
	<title>INICIAR</title>
</head>
<body>
	<?php

		session_start();
		echo "Hola " . $_SESSION['usuario'];
		echo "<p style='font-weight: bold;font-size: 2em;'>" . $_SESSION['usuario'] . "</h1>";
		echo "<p style='font-color: grey;'>Teléfono: " . $_SESSION['usuario'] . "<br />Dirección: " . $_SESSION['usuario'] . "</p>";
	?>
</body>
</html>

