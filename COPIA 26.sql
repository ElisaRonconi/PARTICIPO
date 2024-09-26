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
  `idInstituto` int DEFAULT NULL,
  PRIMARY KEY (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.alumnos: ~2 rows (aproximadamente)
INSERT INTO `alumnos` (`idAlumno`, `nombre`, `apellido`, `email`, `fechaNacimiento`, `dni`, `idInstituto`) VALUES
	(1, 'Juan', 'Perez', 'juan.perez@example.com', '2000-01-01', '12345678', NULL),
	(2, 'Menganito', 'Lopez', 'menganito@example.com', '2001-09-06', '87654321', NULL);

-- Volcando estructura para tabla db_participo.clases
CREATE TABLE IF NOT EXISTS `clases` (
  `numeroClase` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`numeroClase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.clases: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_participo.institutos
CREATE TABLE IF NOT EXISTS `institutos` (
  `idInstituto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idInstituto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.institutos: ~4 rows (aproximadamente)
INSERT INTO `institutos` (`idInstituto`, `nombre`, `direccion`) VALUES
	(1, 'Sedes Sapientiae', 'Sta. Fe 74, E3269 Gualeguaychú, Entre Ríos'),
	(2, 'Facultad de Bromatología - UNER', 'Sede Centro: 25 de Mayo 709'),
	(3, 'Facultad de Bromatología - UNER Polo', 'Sede Polo Educativo: Pte. Perón 1154'),
	(4, 'UCU ', '25 de Mayo 1312, E3269 Gualeguaychú, Entre Ríos');

-- Volcando estructura para tabla db_participo.materias
CREATE TABLE IF NOT EXISTS `materias` (
  `numeroMateria` int NOT NULL AUTO_INCREMENT,
  `materia` varchar(50) DEFAULT NULL,
  `idInstituto` int DEFAULT NULL,
  PRIMARY KEY (`numeroMateria`),
  KEY `fk_materia_instituto` (`idInstituto`),
  CONSTRAINT `fk_materia_instituto` FOREIGN KEY (`idInstituto`) REFERENCES `institutos` (`idInstituto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.materias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_participo.notas
CREATE TABLE IF NOT EXISTS `notas` (
  `parcial1` varchar(10) DEFAULT NULL,
  `parcial2` varchar(10) DEFAULT NULL,
  `tpFinal` varchar(10) DEFAULT NULL,
  `idAlumno` int DEFAULT NULL,
  KEY `fk_notas_alumnos` (`idAlumno`),
  CONSTRAINT `fk_notas_alumnos` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.notas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_participo.profesores
CREATE TABLE IF NOT EXISTS `profesores` (
  `idProfesor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `legajo` varchar(8) DEFAULT NULL,
  `idInstituto` int DEFAULT NULL,
  PRIMARY KEY (`idProfesor`),
  KEY `fk_profesor_instituto` (`idInstituto`),
  CONSTRAINT `fk_profesor_instituto` FOREIGN KEY (`idInstituto`) REFERENCES `institutos` (`idInstituto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.profesores: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_participo.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contraseña` varchar(25) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`),
  KEY `idAlumno` (`idAlumno`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_participo.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`idUsuario`, `idAlumno`, `usuario`, `contraseña`, `email`) VALUES
	(3, 1, 'JuanPerez', '1234', NULL),
	(4, 2, 'Menganito', '2345', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
