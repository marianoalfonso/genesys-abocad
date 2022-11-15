-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-11-2022 a las 02:28:02
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abocad`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `mpa_ReplicarFecha`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mpa_ReplicarFecha` (IN `idEvento` INT, IN `fechaReplicacion` DATE)  BEGIN
    declare fechaDesde datetime;
    declare fechaHasta datetime;
    declare newFechaDesde datetime;
    declare newFechaHasta datetime;
    
    set fechaDesde = (select `start` from eventos where id = idEvento);
    set fechaHasta = (select `end` from eventos where id = idEvento);
    set newFechaDesde = (select date_add(fechaDesde,interval 7 day));
    set newFechaHasta = (select date_add(fechaHasta,interval 7 day));
    
	block:while (fechaReplicacion >= newFechaDesde) do
		insert into eventos (profesional,dni,title,description,start,end,textColor,backgroundColor,estado) select profesional,dni,title,description,newFechaDesde,newFechaHasta,textColor,backgroundColor,null from eventos where id = idEvento;
		set newFechaDesde = (select date_add(newFechaDesde,interval 7 day));
		set newFechaHasta = (select date_add(newFechaHasta,interval 7 day));
	end
    while block;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coberturas`
--

DROP TABLE IF EXISTS `coberturas`;
CREATE TABLE IF NOT EXISTS `coberturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coberturas`
--

INSERT INTO `coberturas` (`id`, `nombre`) VALUES
(1, 'ASE'),
(2, 'ELEVAR'),
(3, 'GALENO'),
(4, 'HOSPITAL ALEMAN'),
(5, 'IOSFA'),
(6, 'MEDICUS'),
(7, 'MEDIFE'),
(8, 'OBSBA'),
(9, 'OSADRA'),
(10, 'OSCEP'),
(11, 'OSDE'),
(12, 'OSDEPYM'),
(13, 'OSDIPP'),
(14, 'OSDO'),
(15, 'OSECAC'),
(16, 'OSPEDYC'),
(17, 'OSPERYH'),
(18, 'OSPOCE'),
(19, 'OSPRERA'),
(20, 'PARTICULAR'),
(21, 'SWISS MEDICAL'),
(22, 'UNION PERSONAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profesional` int NOT NULL,
  `dni` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `textColor` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `backgroundColor` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` char(3) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`, `estado`) VALUES
(1, 1, 234234, 'Picapiedras Wilma', 'test', '2022-11-13 10:00:00', '2022-11-13 11:00:00', '#FFFFFF', '#FFFFFF', 'pre'),
(43, 1, 234234, 'Picapiedras Wilma', 'test modificacion', '2022-11-13 14:00:00', '2022-11-13 15:00:00', '#FFFFFF', '#FFFFFF', 'aCa'),
(44, 1, 234234, 'Picapiedras Wilma', 'test', '2022-11-14 10:00:00', '1900-01-14 12:53:36', '#FFFFFF', '#FFFFFF', 'aSa'),
(46, 2, 3323425, 'simpson homero', '', '2022-11-10 10:00:00', '2022-11-10 11:00:00', '#ffffff', '#3788d8', ''),
(47, 2, 234234, 'Picapiedras Wilma', '', '2022-11-10 11:00:00', '2022-11-10 12:30:00', '#ffffff', '#d73747', ''),
(48, 1, 3323425, 'simpson homero', '', '2022-11-11 18:00:00', '2022-11-11 19:00:00', '#ffffff', '#3788d8', 'aCa'),
(49, 3, 3323425, 'simpson homero', '', '2022-11-11 17:00:00', '2022-11-11 17:50:00', '#ffffff', '#3788d8', ''),
(50, 3, 3323425, 'simpson homero', '', '2022-11-18 17:00:00', '2022-11-18 17:50:00', '#ffffff', '#3788d8', NULL),
(51, 3, 3323425, 'simpson homero', '', '2022-11-25 17:00:00', '2022-11-25 17:50:00', '#ffffff', '#3788d8', NULL),
(52, 3, 3323425, 'simpson homero', '', '2022-12-02 17:00:00', '2022-12-02 17:50:00', '#ffffff', '#3788d8', NULL),
(53, 3, 3323425, 'simpson homero', '', '2022-12-09 17:00:00', '2022-12-09 17:50:00', '#ffffff', '#3788d8', NULL),
(54, 3, 3323425, 'simpson homero', '', '2022-12-16 17:00:00', '2022-12-16 17:50:00', '#ffffff', '#3788d8', NULL),
(55, 3, 3323425, 'simpson homero', '', '2022-12-23 17:00:00', '2022-12-23 17:50:00', '#ffffff', '#3788d8', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventospredefinidos`
--

DROP TABLE IF EXISTS `eventospredefinidos`;
CREATE TABLE IF NOT EXISTS `eventospredefinidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `colortexto` varchar(7) DEFAULT NULL,
  `colorfondo` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventospredefinidos`
--

INSERT INTO `eventospredefinidos` (`id`, `titulo`, `horaInicio`, `horaFin`, `colortexto`, `colorfondo`) VALUES
(1, 'sobreturno', '14:00:00', '15:00:00', '#FFFFFF', '#FF3333'),
(2, 'turno especial', '12:00:00', '14:00:00', '#FFFFFF', '#00AC22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `msg` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`msg`) VALUES
(''),
('');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `cobertura1` tinyint NOT NULL,
  `c1numero` bigint NOT NULL,
  `contacto` text NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `reintegro` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`),
  KEY `FK_cobertura_persona` (`cobertura1`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `direccion`, `cobertura1`, `c1numero`, `contacto`, `estado`, `reintegro`) VALUES
(20, 'Romero', 'Matias', '22342352', 'tomaria 332', 7, 333455534, 'madre: 011-33345433\r\npadre: 011: 77643999', 1, 0),
(17, 'simpson', 'homero', '3323425', 'avenida siempre viva 342', 1, 3332342342, 'marge', 1, 0),
(13, 'Picapiedras', 'Wilma', '234234', 'piedradura 3211', 9, 23423422, 'edad de piedra', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientesold`
--

DROP TABLE IF EXISTS `pacientesold`;
CREATE TABLE IF NOT EXISTS `pacientesold` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pacientesold`
--

INSERT INTO `pacientesold` (`id`, `apellido`, `nombre`, `email`) VALUES
(14, 'Smith', 'Jack', ''),
(3, 'Stark', 'Tony', 'tonystark@stark.com'),
(12, 'Simpson', 'Homero Jay', ''),
(17, 'Perez', 'Natalie', ''),
(21, 'Sabin', 'Pedro', ''),
(19, 'Lorem', 'Lucas K', ''),
(20, 'Weber', 'Marie', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `profesionales`
--

INSERT INTO `profesionales` (`id`, `nombre`) VALUES
(1, 'Durand Mariana'),
(2, 'Durand Liliana'),
(3, 'Espina Virginia'),
(4, 'Laurenti Paula'),
(5, 'Leguiza Florencia'),
(6, 'Perez Villar Fernando'),
(7, 'Picard Smith Lorena'),
(8, 'Sanchez Negrete Cecilia'),
(9, 'Trotta Valeria'),
(10, 'Ventura Monique'),
(11, 'Waimberg Sol'),
(12, 'Waisman Laura'),
(13, 'Zanino Adela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usr_dni` int NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_tipo` tinyint NOT NULL,
  PRIMARY KEY (`usr_dni`),
  KEY `fk_usuario_tipo_idx` (`usr_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usr_dni`, `usr_nombre`, `usr_password`, `usr_tipo`) VALUES
(22925061, 'Mariano Alfonso', 'test1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipo`
--

DROP TABLE IF EXISTS `usuarios_tipo`;
CREATE TABLE IF NOT EXISTS `usuarios_tipo` (
  `tipo_id` tinyint NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios_tipo`
--

INSERT INTO `usuarios_tipo` (`tipo_id`, `tipo_descripcion`) VALUES
(1, 'administrador'),
(2, 'administrativo'),
(3, 'profesional');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
