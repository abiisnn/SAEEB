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
INSERT INTO `alumno` VALUES (280000,1,'ENRIQUE RAMOS AGUILAR',2,'MATUTINO',9,'55-55-55-55-55'),(280001,1,'SALOMON DIAZ HERNANDEZ',2,'MATUTINO',0,'55-89-12-11-00'),(280002,3,'BARBARA SAYAGO GONZALEZ',2,'MATUTINO',0,'55-22-11-11-00'),(280003,3,'VICTOR NICOLAS LOPEZ',2,'MATUTINO',0,'55-45-15-21-00'),(280004,3,'MARIBEL SAYAGO GONZALEZ',2,'MATUTINO',0,'55-35-42-31-00'),(280006,3,'JULIO PEREZ GOMEZ',2,'MATUTINO',0,'55-89-13-11-99'),(280007,4,'MARIA SOSA VAZQUEZ',1,'MATUTINO',0,'55-33-11-11-33'),(280008,1,'DOUNG XANG OH',1,'MATUTINO',0.7143,'44-44-44-44-44'),(280009,4,'RAUL VILLALOBOS ZARATE',3,'MATUTINO',0,'55-99-19-81-55'),(280100,6,'ENRIQUE RAMOS AGUILAR',3,'MATUTINO',0,'55-55-55-55-55');
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
INSERT INTO `am` VALUES (280000,580000,5),(280000,580001,9),(280000,580003,0),(280000,580004,0),(280000,580005,0),(280000,580006,0),(280001,580000,5),(280001,580001,0),(280001,580002,8),(280001,580003,0),(280001,580004,0),(280001,580005,0),(280001,580006,0),(280002,580000,5),(280002,580001,0),(280002,580002,0),(280002,580003,0),(280002,580004,0),(280002,580005,0),(280002,580006,0),(280003,580000,5),(280003,580001,0),(280003,580002,0),(280003,580003,0),(280003,580004,0),(280003,580005,0),(280003,580006,0),(280004,580000,5),(280004,580001,0),(280004,580002,0),(280004,580006,0),(280006,580000,0),(280006,580001,0),(280006,580002,0),(280006,580003,0),(280006,580004,0),(280006,580005,0),(280006,580006,0),(280007,580000,0),(280007,580001,0),(280007,580002,0),(280007,580003,0),(280007,580004,0),(280007,580005,0),(280007,580006,0),(280008,580000,5),(280008,580001,0),(280008,580002,0),(280008,580003,0),(280008,580004,0),(280008,580005,0),(280008,580006,0),(280009,580000,0),(280009,580001,0),(280009,580002,0),(280009,580003,0),(280009,580004,0),(280009,580005,0),(280009,580006,0),(280100,580000,0),(280100,580001,0),(280100,580002,0),(280100,580003,5),(280100,580004,0),(280100,580005,0),(280100,580006,0);
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
  `Lugar` varchar(60) NOT NULL,
  `Fecha` date NOT NULL,
  `HoraCita` varchar(10) NOT NULL,
  `Motivo` varchar(60) NOT NULL,
  `Remitente` int(11) NOT NULL,
  `Confirmada` tinyint(4) NOT NULL,
  PRIMARY KEY (`idCita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita`
--

LOCK TABLES `cita` WRITE;
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` VALUES (21321,'OFICINA DE DIRECCION','2018-05-29','11:00','No ha respondido a los Reportes de Conducta',380001,0),(21325,'SALON 1011','2018-06-01','8:00','Entrega de calificaciones 3er Parcial',380001,1),(21328,'SALA SIGLO XXI','2018-05-29','9:30','Nada impide tanto el ser natural como el afán.',380002,0);
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
INSERT INTO `cu` VALUES (280001,21321),(280001,21325),(280001,21328);
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
INSERT INTO `escuela` VALUES (150003,'ESCUELA SECUNDARIA TECNICA NUM. 3','CALLE ISLA DE GUADALUPE E ISLA CLARION',4,'PRADO VALLEJO','TLALNEPANTLA DE BAZ','EDOMEX','TECNICA','2018-2','TERESA VALENCIA DE LA MORA'),(150021,'ADOLFO LOPEZ MATEOS','CALLE SALVADOR NOVO',8,'SAN ANTONIO ZOMEYUCAN','NAUCALPAN DE JUAREZ','EDOMEX','TELESECUNDARIA','2018-2','CONSTANTINO RIVERA MORALES'),(150070,'JAIME TORRES BODET','AVENIDA FRANCISCO BARRERA',12,'PROFESOR CRISTOBAL HIGUERA','ATIZAPAN DE ZARAGOZA','EDOMEX','TECNICA','2018-2','MARIO CUADRILLA RAMIREZ'),(150160,'ESCUELA SECUNDARIA TECNICA NUM. 150','CALLE ARGELIA',11,'MEXICO 86','ATIZAPAN DE ZARAGOZA','EDOMEX','TECNICA','2018-2','RAUL AGUSTIN JAIMES SANTANA'),(151386,'COLEGIO LAS AMERICAS','AVENIDA JORGE JIMÉNEZ CANTU',17,'VILLA DE GUADALUPE XALOSTOC','ECATEPEC DE MORELOS','EDOMEX','TECNICA','2018-2','');
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
INSERT INTO `grupo` VALUES (1,'1CM1',380001,150003),(3,'A',380002,150003),(4,'B',380003,150003),(5,'C',380004,150003),(6,'4CM3',380006,150003);
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
INSERT INTO `materia` VALUES (580000,'MATEMATICAS I'),(580001,'FORMACION CIVICA Y ÉTICA II'),(580002,'HISTORIA I'),(580003,'ESPAÑOL III'),(580004,'EDUCACION FISICA'),(580005,'GEOGRAFIA DE MEXICO'),(580006,'COMPUTACION I');
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
  `Mensaje` varchar(1000) NOT NULL,
  `Destinatario` int(11) NOT NULL,
  `HoraMensaje` varchar(30) NOT NULL,
  `Asunto` varchar(60) NOT NULL,
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
INSERT INTO `mensaje` VALUES (1,280000,'Este es un mensaje enviado de prueba',380001,'2018-06-06 18:57:43','Asunto 1'),(5,280001,'Ultra instinto',380001,'2018-06-06 18:57:44','Asunto 1'),(6,380001,'Nunca más',280001,'2018-06-06 18:57:44','Asunto 1'),(10,280000,'Asunto 50 caracteres',380002,'2018-06-06 18:57:44','Nada impide tanto él'),(29700,480011,'Un mensaje de prueba para bandeja de entrada',280002,'2018-06-07 16:06:02','Mensaje de prueba 3'),(40840,280000,'Este es un mensaje de prueba enviado desde SAEEB.',380001,'2018-06-07 18:47:12','Mensaje de prueba'),(69285,280000,'BUENA NOCHE.\r\nLE COMUNICO QUE AL DIA DE HOY HE NOTADO COMEZON FRECUENTE EN MI HIJO.\r\nPODRIAN HACER ALGO AL RESPECTO??',480011,'2018-06-07 21:06:35','EPIDEMIA');
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
INSERT INTO `orientador` VALUES (380001,'LIC. EN CIENCIAS SOCIALES'),(380002,'LIC. EN CIENCIAS SOCIALES'),(380003,'ING. EN SISTEMAS COMPUTACIONALES'),(380004,'LIC. EN CIENCIAS DE LA EDUCACION'),(380006,'LIC. EN DERECHO');
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
INSERT INTO `pg` VALUES (1,480001),(4,480001),(6,480001),(4,480002),(5,480002),(6,480002),(5,480004),(3,480005),(1,480011),(3,480011);
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
  `idMateria` int(11) NOT NULL,
  PRIMARY KEY (`idProfesor`,`idMateria`),
  KEY `idMateria_idx` (`idMateria`),
  CONSTRAINT `idMateria` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idProfesor_Profesor` FOREIGN KEY (`idProfesor`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
INSERT INTO `profesor` VALUES (480001,'ING. EN SISTEMAS',580003),(480002,'FISICO-QUIMICO ORGANICO',580004),(480004,'LIC. EN TURISMO',580005),(480005,'ING. EN TELECOMUNICACIONES',580006),(480011,'LIC. EN CONTABILIDAD',580000);
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
INSERT INTO `usuario` VALUES (280000,150003,'ERICK','RAMOS','TELLEZ','RATE040125HMCMLRA8','enriquebroly@hotmail.com','ultra',13,'MASCULINO','CALLE AQUILES SERDAN',31,'EL GALLITO STA CLARA','ECATEPEC DE MORELOS','EDOMEX','ALUMNO','7:00','13:00'),(280001,150003,'LEONARDO','DIAZ','MIRANDA','DIML040906HMCIIN08','enriquebroly@gmail.com','instinto',13,'MASCULINO','CALLE TOLUCA',109,'LOMAS DE SAN ANDRES ATENCO','TLALNEPANTLA DE BAZ','EDOMEX','ALUMNO','8:00','15:00'),(280002,150003,'ABIGAIL','NICOLAS','SAYAGO','NISA980722MMCIIN08','abigail.nic.say@hotmail.com','123',13,'FEMENINO','CALLE DULCE',109,'SAN LORENZO','CHIMALHUACAN','EDOMEX','ALUMNO','8:00','15:00'),(280003,150003,'LILIANA','NICOLAS','SAYAGO','NISL001004MMCIIN08','abigail.nic.say@hotmail.com','123',13,'FEMENINO','CALLE DULCE',109,'SAN LORENZO','CHIMALHUACAN','EDOMEX','ALUMNO','8:00','15:00'),(280004,150003,'VICTOR GABRIEL','NICOLAS','SAYAGO','NISV050616hMCIIN08','enriquebroly@gmail.com','123',13,'MASCULINO','CALLE DULCE',109,'SAN LORENZO','CHIMALHUACAN','EDOMEX','ALUMNO','8:00','15:00'),(280006,150003,'PEDRO','PEREZ','PEREZ','PEPP040916HASRRD02','peterpp@gmail.com','123',14,'MASCULINO','CALLE FABELA',99,'BRUSELAS','AZCAPOTZALCO','CDMX','ALUMNO','7:00','13:30'),(280007,150003,'CARMEN','DEL VALLE','SOSA','VASC0403194S8','delvalle@gmail.com','123',14,'FEMENINO','CALLE GARGOLA',555,'FABRICIO NEYRA','IZTAPALAPA','CDMX','ALUMNO','7:00','13:30'),(280008,150003,'MEI','YIANG','ZHU','YIZM040319CW5','yzhu@hotmail.com','123',14,'FEMENINO','CALLE ASIA',204,'LOMAS DEL VALLE','TLALPAN','CDMX','ALUMNO','7:00','13:30'),(280009,150003,'RUBEN','VILLALOBOS','ALCALA','VIAR970919469','rubencio@hotmail.com','123',15,'MASCULINO','CALLE CEDRO',28,'VALLE DE LOS PINOS 1ERA SECCION','TLALNEPANTLA DE BAZ','EDOMEX','ALUMNO','7:00','13:30'),(280100,150003,'ENRIQUE','RAMOS','DIAZ','RADE980707HMCMZN03','enriquebroly@hotmail.com','123',13,'MASCULINO','CALLE BAJA CALIFORNIA',313,'LOMAS DE SAN LORENZO','TLALNEPANTLA DE BAZ','EDOMEX','ALUMNO','7:00','13:30'),(380001,150003,'JAIME','DAVALOS','PEREZ','DAPJ040916HMCYYN11','jaime@gmail.com','123',33,'MASCULINO','CALLE ESMERALDA',9,'ACAPULCO','TLALNEPANTLA DE BAZ','EDOMEX','ORIENTADOR','8:00','15:00'),(380002,150003,'JOAQUIN','DOMINGUEZ','MORAN','DMJOJ040916HMCYYN11','joaks.ipn@gmail.com','123',33,'MASCULINO','CALLE ROJA',9,'REAL','IZTAPALAPA','EDOMEX','ORIENTADOR','8:00','15:00'),(380003,150003,'SERGIO GABRIEL','SANCHEZ','VALENCIA','SAVS970613HMCYYN11','searleser@gmail.com','123',33,'MASCULINO','CALLE JAIME TORRES',10,'TLALPAN','TLALPAN DE BAZ','EDOMEX','ORIENTADOR','8:00','15:00'),(380004,150003,'CARLOS','FERNANDEZ','CORRIJA','FACP040916HMCYYN11','c_fernandez@gmail.com','123',28,'MASCULINO','CALLE NUECES',3,'TULUM','ATIZAPAN DE ZARAGOZA','EDOMEX','ORIENTADOR','8:00','15:00'),(380006,150003,'GUILLERMO','OCHOA','VAZQUEZ','OVGU040916HMCYYN11','memo_ochoa@gmail.com','123',31,'MASCULINO','CALLE RUSIA',2018,'LAS PALMAS','CUAUHTEMOC','CDMX','ORIENTADOR','8:00','15:00'),(480001,150003,'EDUARDO','ALVAREZ','ALVAREZ','AAED040920HMCXDYN11','lalo@gmail.com','123',33,'MASCULINO','CALLE VAINILLA',468,'GRANJAS MEXICO','IZTACALCO','CDMX','PROFESOR','8:00','15:00'),(480002,150003,'JESUS','CORONA','SANCHEZ','CSAJ040920HMCXDYN11','chuycorona@gmail.com','123',29,'MASCULINO','CALLE AZUL',468,'CONEJO BLANCO','MIGUEL HIDALGO','CDMX','PROFESOR','8:00','15:00'),(480004,150003,'DEYANIRA','CRISTOBAL','RAMIREZ','CRAD040920HMCXDYN11','deya@gmail.com','123',25,'FEMENINO','CALLE REAL DE CALACOAYA',221,'CALACOAYA','ATIZAPAN DE ZARAGOZA','EDOMEX','PROFESOR','8:00','15:00'),(480005,150003,'TERESA','VAZQUEZ','RUIZ','VRUT040920HMCXDYN11','tere@gmail.com','123',40,'FEMENINO','CALLE JALISCO',701,'5 DE MAYO','AZCAPOTZALCO','CDMX','PROFESOR','13:00','21:00'),(480011,150003,'LEONEL','QUINTERO','LOPEZ','QULL040920HMCXDYN11','leonel@gmail.com','123',46,'MASCULINO','CALLE FORTUNA',187,'GUERRERO','NAUCALPAN DE JUAREZ','EDOMEX','PROFESOR','8:00','15:00');
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

-- Dump completed on 2018-06-08 19:39:58
