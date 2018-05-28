-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2018 a las 02:41:58
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saeeb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `Tutor` varchar(45) NOT NULL,
  `Grado` int(11) NOT NULL,
  `Turno` varchar(45) NOT NULL,
  `Promedio` double NOT NULL,
  `Tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idAlumno`, `idGrupo`, `Tutor`, `Grado`, `Turno`, `Promedio`, `Tel`) VALUES
(280000, 1, 'ENRIQUE RAMOS AGUILAR', 2, 'MATUTINO', 0, '55-55-55-55-55'),
(280001, 1, 'SALOMON DIAZ HERNANDEZ', 2, 'MATUTINO', 0, '55-89-12-11-00'),
(280002, 2, 'PEREZ JUAREZ ARIEL', 1, 'MATUTINO', 0, '55-26-20-50-26'),
(280003, 2, 'BALCAZAR TORRES MARIA DE LOURDES', 1, 'MATUTINO', 0, '55-26-50-45-89'),
(280004, 2, 'CORDERO SOSA RAFAEL', 1, 'MATUTINO', 0, '55-26-50-26-52'),
(280005, 2, 'CAMPOS RAMIREZ LEONARDO', 1, 'MATUTINO', 0, '55-58-10-40-83');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `am`
--

CREATE TABLE `am` (
  `idAlumno` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL,
  `Calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `am`
--

INSERT INTO `am` (`idAlumno`, `idMateria`, `Calificacion`) VALUES
(280000, 580000, 10),
(280000, 580001, 9),
(280001, 580002, 8),
(280002, 580000, 8),
(280002, 580001, 7),
(280002, 580002, 8),
(280003, 580000, 10),
(280003, 580001, 8),
(280003, 580002, 9),
(280004, 580000, 8),
(280004, 580001, 10),
(280005, 580000, 10),
(280005, 580001, 8),
(280005, 580002, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idCita` int(11) NOT NULL,
  `Lugar` varchar(45) NOT NULL,
  `Fecha` datetime NOT NULL,
  `HoraCita` varchar(10) NOT NULL,
  `Motivo` varchar(50) NOT NULL,
  `Remitente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cu`
--

CREATE TABLE `cu` (
  `idUsuario` int(11) NOT NULL,
  `idCita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

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
  `Director` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`ClaveEscuela`, `Nombre`, `Calle`, `No`, `Colonia`, `Municipio`, `Estado`, `TipoE`, `PeriodoActual`, `Director`) VALUES
(150003, 'ESCUELA SECUNDARIA TECNICA NUM. 3', 'CALLE ISLA DE GUADALUPE E ISLA CLARION', 4, 'PRADO VALLEJO', 'TLALNEPANTLA DE BAZ', 'EDOMEX', 'TECNICA', '2018-2', 'TERESA VALENCIA DE LA MORA'),
(150021, 'ADOLFO LOPEZ MATEOS', 'CALLE SALVADOR NOVO', 8, 'SAN ANTONIO ZOMEYUCAN', 'NAUCALPAN DE JUAREZ', 'EDOMEX', 'TELESECUNDARIA', '2018-2', 'CONSTANTINO RIVERA MORALES'),
(150034, 'ESCUELA SECUNDARIA TÉCNICA NUM.72', 'CALLE PARSELA', 15, 'LOMAS DE SAN BERNABE', 'MAGDALENA CONTRERAS', 'CDMX', 'TECNICA', '2018-2', 'HERNANDEZ JUAREZ GABRIEL'),
(150070, 'JAIME TORRES BODET', 'AVENIDA FRANCISCO BARRERA', 12, 'PROFESOR CRISTOBAL HIGUERA', 'ATIZAPAN DE ZARAGOZA', 'EDOMEX', 'TECNICA', '2018-2', 'MARIO CUADRILLA RAMIREZ'),
(150160, 'ESCUELA SECUNDARIA TECNICA NUM. 150', 'CALLE ARGELIA', 11, 'MEXICO 86', 'ATIZAPAN DE ZARAGOZA', 'EDOMEX', 'TECNICA', '2018-2', 'RAUL AGUSTIN JAIMES SANTANA'),
(151386, 'COLEGIO LAS AMERICAS', 'AVENIDA JORGE JIMÉNEZ CANTU', 17, 'VILLA DE GUADALUPE XALOSTOC', 'ECATEPEC DE MORELOS', 'EDOMEX', 'TECNICA', '2018-2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `idOrientador` int(11) NOT NULL,
  `ClaveEscuela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `Nombre`, `idOrientador`, `ClaveEscuela`) VALUES
(1, '1CM1', 380001, 150021),
(2, '1SM1', 380002, 150034);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `idMateria` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`idMateria`, `Nombre`) VALUES
(580000, 'MATEMATICAS I'),
(580001, 'FORMACION CIVICA Y ÉTICA II'),
(580002, 'HISTORIA I'),
(580003, 'GEOGRAFIA DE MÉXICO Y DEL MUNDO'),
(580004, 'EDUCACIÓN FISICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idMensaje` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Mensaje` varchar(150) NOT NULL,
  `Destinatario` int(11) NOT NULL,
  `HoraMensaje` varchar(30) DEFAULT NULL,
  `Asunto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`idMensaje`, `idUsuario`, `Mensaje`, `Destinatario`, `HoraMensaje`, `Asunto`) VALUES
(1, 280000, 'Este es un mensaje enviado de prueba', 380001, '2018-05-27 18:45:14', 'Asunto 1'),
(2, 280001, 'Otro mensaje de prueba', 280000, '2018-05-27 18:45:14', 'Asunto 1'),
(3, 380001, 'El ultimo xD', 380001, '2018-05-27 18:45:14', 'Asunto 1'),
(4, 280000, 'Quince años de malicia', 280001, '2018-05-27 18:45:14', 'Asunto 1'),
(5, 280001, 'Ultra instinto', 380001, '2018-05-27 18:45:14', 'Asunto 1'),
(6, 380001, 'Nunca más', 280001, '2018-05-27 18:45:15', 'Asunto 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orientador`
--

CREATE TABLE `orientador` (
  `idOrientador` int(11) NOT NULL,
  `Licenciatura` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orientador`
--

INSERT INTO `orientador` (`idOrientador`, `Licenciatura`) VALUES
(380001, 'LIC. EN CIENCIAS SOCIALES'),
(380002, 'LIC. EN EDUCACIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pg`
--

CREATE TABLE `pg` (
  `idGrupo` int(11) NOT NULL,
  `idProfesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pg`
--

INSERT INTO `pg` (`idGrupo`, `idProfesor`) VALUES
(1, 480011);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `idProfesor` int(11) NOT NULL,
  `Area` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idProfesor`, `Area`) VALUES
(480011, 'LIC. EN CONTABILIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

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
  `HoraSalida` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `ClaveEscuela`, `Nombre`, `ApPaterno`, `ApMaterno`, `CURP`, `Email`, `Contrasena`, `Edad`, `Sexo`, `Calle`, `NoCasa`, `Colonia`, `Municipio`, `Estado`, `Tipo`, `HoraEntrada`, `HoraSalida`) VALUES
(280000, 150003, 'ERICK', 'RAMOS', 'TELLEZ', 'RATE040125HMCMLRA8', 'enriquebroly@hotmail.com', 'ultra', 13, 'MASCULINO', 'CALLE AQUILES SERDAN', 31, 'EL GALLITO STA CLARA', 'ECATEPEC DE MORELOS', 'EDOMEX', 'ALUMNO', '7:00', '13:00'),
(280001, 150021, 'LEONARDO', 'DIAZ', 'MIRANDA', 'DIML040906HMCIIN08', 'enriquebroly@gmail.com', 'instinto', 13, 'MASCULINO', 'CALLE TOLUCA', 109, 'LOMAS DE SAN ANDRES ATENCO', 'TLALNEPANTLA DE BAZ', 'EDOMEX', 'ALUMNO', '8:00', '15:00'),
(280002, 150034, 'DANIEL', 'PEREZ', 'CARRILLO', 'PECD040818HDFRRN02', 'daniel_980818@gmail.com', 'yirz24', 13, 'MASCULINO', 'TULIPANES', 16, 'LOMAS DE LOS CEDROS', 'ALVARO OBREGON', 'CDMX', 'ALUMNO', '7:00', '13:00'),
(280003, 150034, 'EDUARDO YAIR', 'CARRILLO', 'BALCAZAR', 'CABE041013HDFRLD02', 'yirz.carrillo@gmail.com', 'yirz24', 13, 'MASCULINO', 'TULIPANES', 16, 'LOMAS DE LOS CEDROS', 'ALVARO OBREGON', 'CDMX', 'ALUMNO', '7:00', '13:00'),
(280004, 150034, 'DIEGO', 'CORDERO', 'BENITEZ', 'COBD040205HDFRLDA9', 'diego.benitez2004@gmail.com', 'diegoben', 13, 'MASCULINO', 'HORQUIDIA', 1606, 'LOMAS DE SAN BERNABE', 'MAGDALENA CONTRERAS', 'CDMX', 'ALUMNO', '7:00', '13:00'),
(280005, 150034, 'JUAN MANUEL', 'CAMPOS', 'LEAÑOS', 'CALJ040598HDFMÑNA6', 'juan.panque@hotmail.com', 'juanpanque', 13, 'MASCULINO', 'CRUCES', 81, 'LOMAS DE LA ERA', 'ALVARO OBREGON', 'CDMX', 'ALUMNO', '7:00', '13:00'),
(380001, 150021, 'JAIME', 'DAVALOS', 'PEREZ', 'DAPJ040916HMCYYN11', 'jaime@gmail.com', '123', 33, 'MASCULINO', 'CALLE ESMERALDA', 9, 'ACAPULCO', 'TLALNEPANTLA DE BAZ', 'EDOMEX', 'ORIENTADOR', '8:00', '15:00'),
(380002, 150034, 'IVAN ', 'CASTRO', 'TINOCO', 'CATI920504HDFCTI07', 'ivan92005@gamil.com', 'ivan781', 26, 'MASCULINO', 'CALLE LUIZA', 1602, 'LOMAS DE SAN BERNABE', 'MAGDALENA CONTRERAS', 'CDMX', 'ORIENTADOR', '7:00', '15:00'),
(480011, 150070, 'LEONEL', 'QUINTERO', 'LOPEZ', 'QULL040920HMCXDYN11', 'leonel@gmail.com', '123', 46, 'MASCULINO', 'CALLE FORTUNA', 187, 'GUERRERO', 'NAUCALPAN DE JUAREZ', 'EDOMEX', 'PROFESOR', '8:00', '15:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlumno`,`idGrupo`),
  ADD KEY `idGrupo_idx` (`idGrupo`);

--
-- Indices de la tabla `am`
--
ALTER TABLE `am`
  ADD PRIMARY KEY (`idAlumno`,`idMateria`),
  ADD KEY `idMateria_idx` (`idMateria`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idCita`);

--
-- Indices de la tabla `cu`
--
ALTER TABLE `cu`
  ADD PRIMARY KEY (`idUsuario`,`idCita`),
  ADD KEY `idCita_idx` (`idCita`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`ClaveEscuela`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`,`idOrientador`,`ClaveEscuela`),
  ADD KEY `idOrientador_idx` (`idOrientador`),
  ADD KEY `ClaveEscuela_Grupo_idx` (`ClaveEscuela`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idMateria`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idMensaje`,`idUsuario`),
  ADD KEY `idUsuario_idx` (`idUsuario`);

--
-- Indices de la tabla `orientador`
--
ALTER TABLE `orientador`
  ADD PRIMARY KEY (`idOrientador`);

--
-- Indices de la tabla `pg`
--
ALTER TABLE `pg`
  ADD PRIMARY KEY (`idGrupo`,`idProfesor`),
  ADD KEY `idProfesor_idx` (`idProfesor`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idProfesor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`,`ClaveEscuela`),
  ADD KEY `ClaveEscuela_idx` (`ClaveEscuela`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `idAlumno_Alumno` FOREIGN KEY (`idAlumno`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idGrupo_Alumno` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `am`
--
ALTER TABLE `am`
  ADD CONSTRAINT `idAlumno_AM` FOREIGN KEY (`idAlumno`) REFERENCES `alumno` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idMateria_AM` FOREIGN KEY (`idMateria`) REFERENCES `materia` (`idMateria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cu`
--
ALTER TABLE `cu`
  ADD CONSTRAINT `idCita_CU` FOREIGN KEY (`idCita`) REFERENCES `cita` (`idCita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idUsuario_CU` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `ClaveEscuela_Grupo` FOREIGN KEY (`ClaveEscuela`) REFERENCES `escuela` (`ClaveEscuela`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idOrientador_Grupo` FOREIGN KEY (`idOrientador`) REFERENCES `orientador` (`idOrientador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `idUsuario_Mensaje` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orientador`
--
ALTER TABLE `orientador`
  ADD CONSTRAINT `idOrientador_Orientador` FOREIGN KEY (`idOrientador`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pg`
--
ALTER TABLE `pg`
  ADD CONSTRAINT `idGrupoPG` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProfesorPG` FOREIGN KEY (`idProfesor`) REFERENCES `profesor` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `idProfesor_Profesor` FOREIGN KEY (`idProfesor`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `ClaveEscuela_Usuario` FOREIGN KEY (`ClaveEscuela`) REFERENCES `escuela` (`ClaveEscuela`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
