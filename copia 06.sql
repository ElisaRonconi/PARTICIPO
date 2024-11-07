-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_participo
CREATE DATABASE IF NOT EXISTS `db_participo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_participo`;

-- Volcando estructura para tabla db_participo.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `idAlumno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.alumnos: ~29 rows (aproximadamente)
INSERT INTO `alumnos` (`idAlumno`, `nombre`, `apellido`, `email`, `fechaNacimiento`, `dni`) VALUES
	(1, 'Valentino Alejandro', 'Andrade', 'valentino.andrade@example.com', '2006-08-18', '12345678'),
	(2, 'Lucas', 'Cedres', 'lucas.cedres@example.com', '2003-12-20', '23456789'),
	(3, 'Facundo', 'Figun', 'facundo.figun@example.com', '2015-05-08', '34567890'),
	(4, 'Luca', 'Giordano', 'luca.giordano@example.com', '2003-07-20', '45678901'),
	(5, 'Bruno', 'Godoy', 'bruno.godoy@example.com', '2007-06-16', '56789012'),
	(6, 'Agustin', 'Gomez', 'agustin.gomez@example.com', '2004-11-19', '67890123'),
	(7, 'Brian', 'Gonzalez', 'brian.gonzalez@example.com', '2003-05-20', '78901234'),
	(8, 'Federico', 'Guigou Scottini', 'federico.guigou@example.com', '2003-03-20', '89012345'),
	(9, 'Luna', 'Marrano', 'luna.marrano@example.com', '2003-02-20', '90123456'),
	(10, 'Giuliana', 'Mercado Aviles', 'giuliana.mercado@example.com', '2003-04-20', '01234567'),
	(11, 'Lucila', 'Mercado Ruiz', 'lucila.mercado@example.com', '2012-01-11', '12345679'),
	(12, 'Angel', 'Murillo', 'angel.murillo@example.com', '2006-09-18', '23456789'),
	(13, 'Juan', 'Nissero', 'juan.nissero@example.com', '2007-05-16', '34567891'),
	(14, 'Fausto', 'Parada', 'fausto.parada@example.com', '2006-10-18', '45678902'),
	(15, 'Fausto', 'Parada', 'fausto.parada@example.com', '2006-10-18', '45678902'),
	(16, 'Ignacio', 'Piter', 'ignacio.piter@example.com', '2009-07-14', '56789013'),
	(17, 'Tomas', 'Planchon', 'tomas.planchon@example.com', '2007-12-16', '67890124'),
	(18, 'Elisa', 'Ronconi', 'elisa.ronconi@example.com', '2004-03-19', '78901235'),
	(19, 'Exequiel', 'Sanchez', 'exequiel.sanchez@example.com', '2006-08-17', '89012346'),
	(20, 'Melina', 'Schimpf Baldo', 'melina.schimpf@example.com', '2004-02-19', '90123457'),
	(21, 'Diego', 'Segovia', 'diego.segovia@example.com', '2003-07-20', '01234568'),
	(22, 'Camila', 'Sittner', 'camila.sittner@example.com', '2006-11-18', '12345680'),
	(23, 'Yamil', 'Villa', 'yamil.villa@example.com', '2007-01-16', '23456781'),
	(24, 'Daniel', 'Zabala', 'daniel.zabala@example.com', '2000-11-16', '23489781'),
	(63, 'Elisa', 'Ronconi', 'elisaronconi28@gmail.com', NULL, NULL),
	(64, 'Juan', 'Perez', NULL, NULL, NULL),
	(65, 'Elisa', 'Ronconi', 'elisaronconi28@gmail.com', '2000-07-15', '42477336'),
	(67, 'Renzo', 'Covre', 'renzocovre@gmail.com', NULL, '123'),
	(69, 'Juan', 'Perez', NULL, NULL, NULL),
	(70, 'Baltazar', 'Ronconi', 'elisaronconi28@gmail.com', NULL, NULL);

-- Volcando estructura para tabla db_participo.alumno_materia
CREATE TABLE IF NOT EXISTS `alumno_materia` (
  `idAlumno` int NOT NULL,
  `numeroMateria` int NOT NULL,
  PRIMARY KEY (`idAlumno`,`numeroMateria`),
  KEY `fk_materia` (`numeroMateria`),
  CONSTRAINT `fk_alumno` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_materia` FOREIGN KEY (`numeroMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.alumno_materia: ~29 rows (aproximadamente)
INSERT INTO `alumno_materia` (`idAlumno`, `numeroMateria`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(63, 1),
	(64, 1),
	(1, 2),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(65, 3),
	(67, 3),
	(69, 3),
	(70, 3);

-- Volcando estructura para tabla db_participo.asistencias
CREATE TABLE IF NOT EXISTS `asistencias` (
  `idAsistencia` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int NOT NULL,
  `idMateria` int NOT NULL,
  `fecha` date NOT NULL,
  `presente` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idAsistencia`),
  UNIQUE KEY `idAlumno` (`idAlumno`,`idMateria`,`fecha`),
  KEY `idMateria` (`idMateria`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`),
  CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`numeroMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.asistencias: ~2 rows (aproximadamente)
INSERT INTO `asistencias` (`idAsistencia`, `idAlumno`, `idMateria`, `fecha`, `presente`) VALUES
	(1, 65, 3, '2024-11-06', 0),
	(2, 67, 3, '2024-11-06', 0);

-- Volcando estructura para tabla db_participo.clases
CREATE TABLE IF NOT EXISTS `clases` (
  `numeroClase` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`numeroClase`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.clases: ~0 rows (aproximadamente)
INSERT INTO `clases` (`numeroClase`, `fecha`) VALUES
	(1, '2024-10-01');

-- Volcando estructura para tabla db_participo.institutos
CREATE TABLE IF NOT EXISTS `institutos` (
  `idInstituto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idInstituto`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.institutos: ~5 rows (aproximadamente)
INSERT INTO `institutos` (`idInstituto`, `nombre`, `direccion`) VALUES
	(1, 'Sedes Sapientiae', 'Sta. Fe 74, E3269 Gualeguaychú, Entre Ríos'),
	(2, 'Facultad de Bromatología - UNER Centro', 'Sede Centro: 25 de Mayo 709'),
	(3, 'Facultad de Bromatología - UNER Polo Educativo', 'Sede Polo Educativo: Pte. Perón 1154'),
	(4, 'UCU ', '25 de Mayo 1312, E3269 Gualeguaychú, Entre Ríos'),
	(5, 'UTN FRCU', 'BTD Concepción del Uruguay Entre Ríos AR, Ing. Pereyra 676, E3264');

-- Volcando estructura para tabla db_participo.materias
CREATE TABLE IF NOT EXISTS `materias` (
  `numeroMateria` int NOT NULL AUTO_INCREMENT,
  `materia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`numeroMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.materias: ~2 rows (aproximadamente)
INSERT INTO `materias` (`numeroMateria`, `materia`) VALUES
	(1, 'Programacion I'),
	(2, 'Programacion II'),
	(3, 'Matemática');

-- Volcando estructura para tabla db_participo.materia_instituto
CREATE TABLE IF NOT EXISTS `materia_instituto` (
  `numeroMateria` int DEFAULT NULL,
  `idInstituto` int DEFAULT NULL,
  KEY `FK_materia_instituto_materias` (`numeroMateria`),
  KEY `FK_materia_instituto_institutos` (`idInstituto`),
  CONSTRAINT `FK_materia_instituto_institutos` FOREIGN KEY (`idInstituto`) REFERENCES `institutos` (`idInstituto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_materia_instituto_materias` FOREIGN KEY (`numeroMateria`) REFERENCES `materias` (`numeroMateria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.materia_instituto: ~2 rows (aproximadamente)
INSERT INTO `materia_instituto` (`numeroMateria`, `idInstituto`) VALUES
	(1, 1),
	(2, 1),
	(3, 1);

-- Volcando estructura para tabla db_participo.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `calificacion` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `idAlumno` int DEFAULT NULL,
  `idNotas` int NOT NULL AUTO_INCREMENT,
  `idMateria` int DEFAULT NULL,
  `tipoNota` enum('parcial1','parcial2','final') NOT NULL,
  PRIMARY KEY (`idNotas`),
  KEY `fk_notas_alumnos` (`idAlumno`),
  KEY `FK_notas_materias` (`idMateria`),
  CONSTRAINT `fk_notas_alumnos` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`),
  CONSTRAINT `FK_notas_materias` FOREIGN KEY (`idMateria`) REFERENCES `materias` (`numeroMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.notas: ~0 rows (aproximadamente)
INSERT INTO `notas` (`calificacion`, `idAlumno`, `idNotas`, `idMateria`, `tipoNota`) VALUES
	('10', 65, 70, 3, 'parcial1'),
	('10', 67, 71, 3, 'parcial1'),
	('10', 69, 72, 3, 'parcial1'),
	('10', 65, 73, 3, 'parcial1'),
	('10', 65, 74, 3, 'parcial1'),
	('10', 65, 75, 3, 'parcial1');

-- Volcando estructura para tabla db_participo.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `libre` int DEFAULT NULL,
  `regular` int DEFAULT NULL,
  `promocion` int DEFAULT NULL,
  `Columna 4` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.parametros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_participo.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `idProfesor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `legajo` varchar(8) DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idProfesor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.profesores: ~1 rows (aproximadamente)
INSERT INTO `profesores` (`idProfesor`, `nombre`, `apellido`, `dni`, `legajo`, `idUsuario`, `email`) VALUES
	(1, 'Javier', 'Parra', '1234', '111', 5, NULL);

-- Volcando estructura para tabla db_participo.profesor_instituto
CREATE TABLE IF NOT EXISTS `profesor_instituto` (
  `idProfesor` int DEFAULT NULL,
  `idInstituto` int DEFAULT NULL,
  KEY `profesor_instituto` (`idProfesor`),
  KEY `instituo_profesor` (`idInstituto`),
  CONSTRAINT `instituo_profesor` FOREIGN KEY (`idInstituto`) REFERENCES `institutos` (`idInstituto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profesor_instituto` FOREIGN KEY (`idProfesor`) REFERENCES `profesores` (`idProfesor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.profesor_instituto: ~2 rows (aproximadamente)
INSERT INTO `profesor_instituto` (`idProfesor`, `idInstituto`) VALUES
	(1, 1),
	(1, 2);

-- Volcando estructura para tabla db_participo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contraseña` varchar(25) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `idProfesor` int DEFAULT NULL,
  PRIMARY KEY (`idUsuario`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idAlumno` (`idAlumno`),
  KEY `FK_usuarios_profesores` (`idProfesor`),
  CONSTRAINT `FK_usuarios_profesores` FOREIGN KEY (`idProfesor`) REFERENCES `profesores` (`idProfesor`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`idUsuario`, `idAlumno`, `usuario`, `contraseña`, `email`, `idProfesor`) VALUES
	(5, NULL, 'JavierParra', '1234', NULL, 1),
	(6, NULL, 'ElisaRonconi', '1234', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
