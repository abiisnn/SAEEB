-- MySQL dump 10.13  Distrib 5.7.21, for Win64 (x86_64)
--
-- Host: localhost    Database: saeeb
-- ------------------------------------------------------
-- Server version	5.7.21-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `Tutor` varchar(45) NOT NULL,
  `Grado` int(11) NOT NULL,
  `Turno` varchar(45) NOT NULL,
  `Promedio` double NOT NULL,
  `Tel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idAlumno`,`idGrupo`),
  KEY `idGrupo_idx` (`idGrupo`),
  CONSTRAINT `idAlumno_Alumno` FOREIGN KEY (`idAlumno`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idGrupo_Alumno` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES (280000,1,'ENRIQUE RAMOS AGUILAR',2,'MATUTINO',0,'55-55-55-55-55'),(280001,1,'SALOMON DIAZ HERNANDEZ',2,'MATUTINO',0,'55-89-12-11-00'),(280002,2,'PEREZ JUAREZ ARIEL',1,'MATUTINO',0,'55-26-20-50-26'),(280003,2,'BALCAZAR TORRES MARIA DE LOURDES',1,'MATUTINO',0,'55-26-50-45-89'),(280004,2,'CORDERO SOSA RAFAEL',1,'MATUTINO',0,'55-26-50-26-52'),(280005,2,'CAMPOS RAMIREZ LEONARDO',1,'MATUTINO',0,'55-58-10-40-83');
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am`
--

DROP TABLE IF EXISTS `am`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am` (
  `idAlumno` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `Calificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlumno`,`idMateria`),
  KEY `idMateria_idx` (`idMateria`),
  CONSTRAINT `idAlumno_AM` FOREIGN KEY (`idAlumno`) REFERENCES `alumno` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idMateria_AM` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am`
--

LOCK TABLES `am` WRITE;
/*!40000 ALTER TABLE `am` DISABLE KEYS */;
INSERT INTO `am` VALUES (280000,580000,10),(280000,580001,9),(280001,580002,8),(280002,580000,8),(280002,580001,7),(280002,580002,8),(280003,580000,10),(280003,580001,8),(280003,580002,9),(280004,580000,8),(280004,580001,10),(280005,580000,10),(280005,580001,8),(280005,580002,7);
/*!40000 ALTER TABLE `am` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita`
--

DROP TABLE IF EXISTS `cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita` (
  `idCita` int(11) NOT NULL,
  `Lugar` varchar(45) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `HoraCita` varchar(10) NOT NULL,
  `Motivo` varchar(50) NOT NULL,
  `Remitente` varchar(45) NOT NULL,
  `Confirmada` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idCita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (21321,'OFICINA DE DIRECCION','2018-05-29','11:00','No ha respondido a los Reportes de Conducta','380001',0),(21325,'SALON 1011','2018-06-01','8:00','Entrega de calificaciones 3er Parcial','380001',0);
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cu`
--

DROP TABLE IF EXISTS `cu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cu` (
  `idUsuario` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idCita`),
  KEY `idCita_idx` (`idCita`),
  CONSTRAINT `idCita_CU` FOREIGN KEY (`idCita`) REFERENCES `cita` (`idCita`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idUsuario_CU` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cu`
--

LOCK TABLES `cu` WRITE;
/*!40000 ALTER TABLE `cu` DISABLE KEYS */;
/*!40000 ALTER TABLE `cu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escuela`
--

DROP TABLE IF EXISTS `escuela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escuela` (
  `ClaveEscuela` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Calle` varchar(45) NOT NULL,
  `No` int(11) NOT NULL,
  `Colonia` varchar(45) NOT NULL,
  `Municipio` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `TipoE` varchar(45) NOT NULL,
  `PeriodoActual` varchar(15) NOT NULL,
  `Director` varchar(45) NOT NULL,
  PRIMARY KEY (`ClaveEscuela`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escuela`
--

LOCK TABLES `escuela` WRITE;
/*!40000 ALTER TABLE `escuela` DISABLE KEYS */;
INSERT INTO `escuela` VALUES (150003,'ESCUELA SECUNDARIA TECNICA NUM. 3','CALLE ISLA DE GUADALUPE E ISLA CLARION',4,'PRADO VALLEJO','TLALNEPANTLA DE BAZ','EDOMEX','TECNICA','2018-2','TERESA VALENCIA DE LA MORA'),(150021,'ADOLFO LOPEZ MATEOS','CALLE SALVADOR NOVO',8,'SAN ANTONIO ZOMEYUCAN','NAUCALPAN DE JUAREZ','EDOMEX','TELESECUNDARIA','2018-2','CONSTANTINO RIVERA MORALES'),(150034,'ESCUELA SECUNDARIA TÉCNICA NUM.72','CALLE PARSELA',15,'LOMAS DE SAN BERNABE','MAGDALENA CONTRERAS','CDMX','TECNICA','2018-2','HERNANDEZ JUAREZ GABRIEL'),(150070,'JAIME TORRES BODET','AVENIDA FRANCISCO BARRERA',12,'PROFESOR CRISTOBAL HIGUERA','ATIZAPAN DE ZARAGOZA','EDOMEX','TECNICA','2018-2','MARIO CUADRILLA RAMIREZ'),(150160,'ESCUELA SECUNDARIA TECNICA NUM. 150','CALLE ARGELIA',11,'MEXICO 86','ATIZAPAN DE ZARAGOZA','EDOMEX','TECNICA','2018-2','RAUL AGUSTIN JAIMES SANTANA'),(151386,'COLEGIO LAS AMERICAS','AVENIDA JORGE JIMÉNEZ CANTU',17,'VILLA DE GUADALUPE XALOSTOC','ECATEPEC DE MORELOS','EDOMEX','TECNICA','2018-2','');
/*!40000 ALTER TABLE `escuela` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `idOrientador` int(11) NOT NULL,
  `ClaveEscuela` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`,`idOrientador`,`ClaveEscuela`),
  KEY `idOrientador_idx` (`idOrientador`),
  KEY `ClaveEscuela_Grupo_idx` (`ClaveEscuela`),
  CONSTRAINT `ClaveEscuela_Grupo` FOREIGN KEY (`ClaveEscuela`) REFERENCES `escuela` (`ClaveEscuela`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idOrientador_Grupo` FOREIGN KEY (`idOrientador`) REFERENCES `orientador` (`idOrientador`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (1,'1CM1',380001,150021),(2,'1SM1',380002,150034);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `idMateria` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (580000,'MATEMATICAS I'),(580001,'FORMACION CIVICA Y ÉTICA II'),(580002,'HISTORIA I'),(580003,'GEOGRAFIA DE MÉXICO Y DEL MUNDO'),(580004,'EDUCACIÓN FISICA');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `idMensaje` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Mensaje` varchar(150) NOT NULL,
  `Destinatario` int(11) NOT NULL,
  `HoraMensaje` varchar(30) DEFAULT NULL,
  `Asunto` varchar(20) NOT NULL,
  PRIMARY KEY (`idMensaje`,`idUsuario`),
  KEY `idUsuario_idx` (`idUsuario`),
  CONSTRAINT `idUsuario_Mensaje` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` VALUES (1,280000,'Este es un mensaje enviado de prueba',380001,'2018-05-27 18:45:14','Asunto 1'),(2,280001,'Otro mensaje de prueba',280000,'2018-05-27 18:45:14','Asunto 1'),(3,380001,'El ultimo xD',380001,'2018-05-27 18:45:14','Asunto 1'),(4,280000,'Quince años de malicia',280001,'2018-05-27 18:45:14','Asunto 1'),(5,280001,'Ultra instinto',380001,'2018-05-27 18:45:14','Asunto 1'),(6,380001,'Nunca más',280001,'2018-05-27 18:45:15','Asunto 1'),(380,480011,'agaga',280000,'2018-05-28 15:10:42','aLO XD'),(422,280000,'Vientos xd',480011,'2018-05-28 22:27:14','Re: aLO XD'),(447,280000,'muy bien xD',480011,'2018-05-28 15:11:11','Re: aLO XD'),(612,280000,'adgagaga ff',380001,'2018-05-28 15:01:13','Prueba xd');
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orientador`
--

DROP TABLE IF EXISTS `orientador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orientador` (
  `idOrientador` int(11) NOT NULL,
  `Licenciatura` varchar(45) NOT NULL,
  PRIMARY KEY (`idOrientador`),
  CONSTRAINT `idOrientador_Orientador` FOREIGN KEY (`idOrientador`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orientador`
--

LOCK TABLES `orientador` WRITE;
/*!40000 ALTER TABLE `orientador` DISABLE KEYS */;
INSERT INTO `orientador` VALUES (380001,'LIC. EN CIENCIAS SOCIALES'),(380002,'LIC. EN EDUCACIÓN');
/*!40000 ALTER TABLE `orientador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pg`
--

DROP TABLE IF EXISTS `pg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pg` (
  `idGrupo` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`,`idProfesor`),
  KEY `idProfesor_idx` (`idProfesor`),
  CONSTRAINT `idGrupoPG` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idProfesorPG` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pg`
--

LOCK TABLES `pg` WRITE;
/*!40000 ALTER TABLE `pg` DISABLE KEYS */;
INSERT INTO `pg` VALUES (1,480011);
/*!40000 ALTER TABLE `pg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesor` (
  `idProfesor` int(11) NOT NULL,
  `Area` varchar(45) NOT NULL,
  PRIMARY KEY (`idProfesor`),
  CONSTRAINT `idProfesor_Profesor` FOREIGN KEY (`idProfesor`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (480011,'LIC. EN CONTABILIDAD');
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `ClaveEscuela` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `ApPaterno` varchar(20) NOT NULL,
  `ApMaterno` varchar(20) NOT NULL,
  `CURP` varchar(20) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Contrasena` varchar(10) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `Calle` varchar(25) NOT NULL,
  `NoCasa` int(11) NOT NULL,
  `Colonia` varchar(45) NOT NULL,
  `Municipio` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Tipo` varchar(45) NOT NULL,
  `HoraEntrada` varchar(10) NOT NULL,
  `HoraSalida` varchar(10) NOT NULL,
  PRIMARY KEY (`idUsuario`,`ClaveEscuela`),
  KEY `ClaveEscuela_idx` (`ClaveEscuela`),
  CONSTRAINT `ClaveEscuela_Usuario` FOREIGN KEY (`ClaveEscuela`) REFERENCES `escuela` (`ClaveEscuela`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (280000,150003,'ERICK','RAMOS','TELLEZ','RATE040125HMCMLRA8','enriquebroly@hotmail.com','ultra',13,'MASCULINO','CALLE AQUILES SERDAN',31,'EL GALLITO STA CLARA','ECATEPEC DE MORELOS','EDOMEX','ALUMNO','7:00','13:00'),(280001,150021,'LEONARDO','DIAZ','MIRANDA','DIML040906HMCIIN08','enriquebroly@gmail.com','instinto',13,'MASCULINO','CALLE TOLUCA',109,'LOMAS DE SAN ANDRES ATENCO','TLALNEPANTLA DE BAZ','EDOMEX','ALUMNO','8:00','15:00'),(280002,150034,'DANIEL','PEREZ','CARRILLO','PECD040818HDFRRN02','daniel_980818@gmail.com','yirz24',13,'MASCULINO','TULIPANES',16,'LOMAS DE LOS CEDROS','ALVARO OBREGON','CDMX','ALUMNO','7:00','13:00'),(280003,150034,'EDUARDO YAIR','CARRILLO','BALCAZAR','CABE041013HDFRLD02','yirz.carrillo@gmail.com','yirz24',13,'MASCULINO','TULIPANES',16,'LOMAS DE LOS CEDROS','ALVARO OBREGON','CDMX','ALUMNO','7:00','13:00'),(280004,150034,'DIEGO','CORDERO','BENITEZ','COBD040205HDFRLDA9','diego.benitez2004@gmail.com','diegoben',13,'MASCULINO','HORQUIDIA',1606,'LOMAS DE SAN BERNABE','MAGDALENA CONTRERAS','CDMX','ALUMNO','7:00','13:00'),(280005,150034,'JUAN MANUEL','CAMPOS','LEAÑOS','CALJ040598HDFMÑNA6','juan.panque@hotmail.com','juanpanque',13,'MASCULINO','CRUCES',81,'LOMAS DE LA ERA','ALVARO OBREGON','CDMX','ALUMNO','7:00','13:00'),(380001,150021,'JAIME','DAVALOS','PEREZ','DAPJ040916HMCYYN11','jaime@gmail.com','123',33,'MASCULINO','CALLE ESMERALDA',9,'ACAPULCO','TLALNEPANTLA DE BAZ','EDOMEX','ORIENTADOR','8:00','15:00'),(380002,150034,'IVAN ','CASTRO','TINOCO','CATI920504HDFCTI07','ivan92005@gamil.com','ivan781',26,'MASCULINO','CALLE LUIZA',1602,'LOMAS DE SAN BERNABE','MAGDALENA CONTRERAS','CDMX','ORIENTADOR','7:00','15:00'),(480011,150070,'LEONEL','QUINTERO','LOPEZ','QULL040920HMCXDYN11','leonel@gmail.com','123',46,'MASCULINO','CALLE FORTUNA',187,'GUERRERO','NAUCALPAN DE JUAREZ','EDOMEX','PROFESOR','8:00','15:00');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-29 15:47:30
