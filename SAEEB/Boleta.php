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
<?php
	$idAlumno=$_GET['idAlumno'];
	$idGrupo=$_GET['idGrupo'];
	require 'Fpdf/fpdf.php';
	include ("conexion.php");
	include ("obtenerUsuario.php");
	$con= conectar();
	$pdf=new FPDF();
	if($con){

			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->Image('Imagenpdf/Sep.png',10,10,50,20,'PNG');
			$pdf->Cell(50,10,'',0);
			$pdf->Cell(100,10,'Secretario de Educacion Publica',0,0,'C');
			$pdf->Cell(50,10,''.date('d-m-Y').'',0);
			$pdf->ln(4);
			$pdf->Cell(50,10,'',0);
			$pdf->Cell(100,10,'SAEEB',0,0,'C');
			$pdf->ln(4);
			$pdf->Cell(50,10,'',0);
			$pdf->Cell(120,10,'Sistema Administrativo y Escolar de Educacion Basica',0,0);
			$pdf->ln(20);
			$pdf->Cell(70,10,'',0);
			$pdf->SetFont('Arial','B',14);
			$pdf->Cell(50,10,'Boleta de Calificaciones',0);
			$pdf->ln(10);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(50,5,'Nombre:',0);
			$pdf->Cell(50,5,'Apellido Paterno:',0);
			$pdf->Cell(50,5,'Apellido Materno:',0);
			$pdf->Cell(20,5,'Grupo:',0);
			$pdf->ln(5);
			$pdf->SetFont('Arial','B',11);
			$result = mysqli_query($con,"SELECT nombre,appaterno,apmaterno,curp FROM usuario where idUsuario='$idAlumno'");
			$Nombre = mysqli_fetch_array($result);
			$pdf->Cell(50,5,$Nombre[0],0);
			$pdf->Cell(50,5,$Nombre[1],0);
			$pdf->Cell(50,5,$Nombre[2],0);
			$res = mysqli_query($con,"SELECT nombre FROM grupo where idGrupo='$idGrupo'");
			$Grupo = mysqli_fetch_array($res);
			$pdf->Cell(20,5,$Grupo[0],0);
			$pdf->ln(10);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(90,5,'CURP:',0);
			$pdf->Cell(50,5,'Turno:',0);
			$pdf->ln(5);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(90,5,$Nombre[3],0);
			$res1 = mysqli_query($con,"SELECT * FROM alumno where idAlumno='$idAlumno'");
			$IformacionAlumno= mysqli_fetch_array($res1);
			$pdf->Cell(50,5,$IformacionAlumno[4],0);
			$pdf->ln(10);
			$pdf->SetFont('Arial','',11);
			$pdf->Cell(90,5,'Tutor:',0);
			$pdf->ln(5);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(90,5,$IformacionAlumno[2],0);
			$pdf->ln(10);
			$pdf->SetX(20);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50,5,'idMateria',0);
			$pdf->Cell(70,5,'Nombre',0);
			$pdf->Cell(50,5,'Calificacion',0,0,'C');
			$pdf->SetFont('Arial','',10);
			$pdf->ln(5);
			$res2 = mysqli_query($con,"SELECT m.idMateria,m.Nombre,x.Calificacion from 	Materia m,am x where m.idmateria=x.idmateria and idAlumno='$idAlumno'");
			if (mysqli_num_rows($res2)){
				while ($row = mysqli_fetch_array($res2)) 
				{
					$pdf->SetX(20);
					$pdf->Cell(50,5,$row[0],0);
					$pdf->Cell(70,5,$row[1],0);
					$pdf->Cell(50,5,$row[2],0,0,'C');
					$pdf->ln(5);
				}
			}
			$pdf->ln(20);
			$res3 = mysqli_query($con,"SELECT AVG(calificacion) from am where idAlumno='$idAlumno'");
			$promedio = mysqli_fetch_array($res3);
			$pdf->Cell(100,10,"",0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50,10,"Promedio:",0);
			$pdf->Cell(50,10,$promedio[0],0);
			$pdf->ln(50);
			$pdf->Cell(60,10,"____________________________",0);
			$pdf->Cell(60,10,"",0);
			$pdf->Cell(60,10,"____________________________",0);
			$pdf->ln(5);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(60,10,"Firma del Padre o Tutor",0,0,'C');
			$pdf->Cell(60,10,"",0,0,'C');
			$pdf->Cell(60,10,"Firma del Orientador",0,0,'C');
			
			$pdf->Output();

	}
	else{

	}
	
?>