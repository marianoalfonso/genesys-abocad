-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-10-2022 a las 19:25:49
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appointmentsmanager`
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
		insert into eventos (profesional,dni,title,description,start,end,textColor,backgroundColor) select profesional,dni,title,description,newFechaDesde,newFechaHasta,textColor,backgroundColor from eventos where id = idEvento;
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coberturas`
--

INSERT INTO `coberturas` (`id`, `nombre`) VALUES
(1, 'Osde 210'),
(2, 'Osde 310'),
(3, 'Osde 410'),
(4, 'Osde 410'),
(5, 'Swiss Medical 110'),
(6, 'Swiss Medical 210'),
(7, 'Swiss Medical 310'),
(8, 'Galeno plata'),
(9, 'Galeno oro'),
(10, 'Accord Salud 110'),
(11, 'Accord Salud 210'),
(12, 'Accord Salud 310'),
(13, 'Ioma');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`) VALUES
(1, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-10-01 09:00:00', '2022-10-01 09:59:00', '#ffffff', '#3788d8'),
(29, 1, 65464565, 'Juanes Pedro', '', '2022-11-19 17:00:00', '2022-11-19 18:00:00', '#ffffff', '#d74737'),
(30, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-10-08 09:00:00', '2022-10-08 09:59:00', '#ffffff', '#3788d8'),
(31, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-10-15 09:00:00', '2022-10-15 09:59:00', '#ffffff', '#3788d8'),
(32, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-10-22 09:00:00', '2022-10-22 09:59:00', '#ffffff', '#3788d8'),
(33, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-10-29 09:00:00', '2022-10-29 09:59:00', '#ffffff', '#3788d8'),
(34, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-11-05 09:00:00', '2022-11-05 09:59:00', '#ffffff', '#3788d8'),
(35, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-11-12 09:00:00', '2022-11-12 09:59:00', '#ffffff', '#3788d8'),
(36, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-11-19 09:00:00', '2022-11-19 09:59:00', '#ffffff', '#3788d8'),
(37, 1, 65464565, 'Juanes Pedro', 'test para replicacion', '2022-11-26 09:00:00', '2022-11-26 09:59:00', '#ffffff', '#3788d8'),
(38, 1, 3554353, 'Timoteo Miguel', '', '2022-10-07 12:00:00', '2022-10-07 12:45:00', '#ffffff', '#3788d8'),
(39, 1, 3554353, 'Timoteo Miguel', '', '2022-10-14 12:00:00', '2022-10-14 12:45:00', '#ffffff', '#3788d8'),
(40, 1, 3554353, 'Timoteo Miguel', '', '2022-10-21 12:00:00', '2022-10-21 12:45:00', '#ffffff', '#3788d8'),
(41, 1, 3554353, 'Timoteo Miguel', '', '2022-10-28 12:00:00', '2022-10-28 12:45:00', '#ffffff', '#3788d8'),
(42, 1, 3554353, 'Timoteo Miguel', '', '2022-11-04 12:00:00', '2022-11-04 12:45:00', '#ffffff', '#3788d8'),
(43, 1, 3554353, 'Timoteo Miguel', '', '2022-11-11 12:00:00', '2022-11-11 12:45:00', '#ffffff', '#3788d8'),
(44, 1, 3554353, 'Timoteo Miguel', '', '2022-11-18 12:00:00', '2022-11-18 12:45:00', '#ffffff', '#3788d8'),
(45, 1, 3554353, 'Timoteo Miguel', '', '2022-11-25 12:00:00', '2022-11-25 12:45:00', '#ffffff', '#3788d8'),
(46, 1, 3554353, 'Timoteo Miguel', '', '2022-12-02 12:00:00', '2022-12-02 12:45:00', '#ffffff', '#3788d8'),
(47, 1, 3554353, 'Timoteo Miguel', '', '2022-12-09 12:00:00', '2022-12-09 12:45:00', '#ffffff', '#3788d8'),
(48, 1, 3554353, 'Timoteo Miguel', '', '2022-12-16 12:00:00', '2022-12-16 12:45:00', '#ffffff', '#3788d8'),
(49, 1, 3554353, 'Timoteo Miguel', '', '2022-12-23 12:00:00', '2022-12-23 12:45:00', '#ffffff', '#3788d8'),
(50, 1, 3554353, 'Timoteo Miguel', '', '2022-12-30 12:00:00', '2022-12-30 12:45:00', '#ffffff', '#3788d8'),
(51, 1, 3554353, 'Timoteo Miguel', '', '2023-01-06 12:00:00', '2023-01-06 12:45:00', '#ffffff', '#3788d8'),
(52, 1, 3554353, 'Timoteo Miguel', '', '2023-01-13 12:00:00', '2023-01-13 12:45:00', '#ffffff', '#3788d8'),
(53, 1, 3554353, 'Timoteo Miguel', '', '2023-01-20 12:00:00', '2023-01-20 12:45:00', '#ffffff', '#3788d8'),
(54, 1, 3554353, 'Timoteo Miguel', '', '2023-01-27 12:00:00', '2023-01-27 12:45:00', '#ffffff', '#3788d8'),
(55, 1, 3554353, 'Timoteo Miguel', '', '2023-02-03 12:00:00', '2023-02-03 12:45:00', '#ffffff', '#3788d8'),
(56, 1, 3554353, 'Timoteo Miguel', '', '2023-02-10 12:00:00', '2023-02-10 12:45:00', '#ffffff', '#3788d8'),
(57, 1, 3554353, 'Timoteo Miguel', '', '2023-02-17 12:00:00', '2023-02-17 12:45:00', '#ffffff', '#3788d8'),
(58, 1, 3554353, 'Timoteo Miguel', '', '2023-02-24 12:00:00', '2023-02-24 12:45:00', '#ffffff', '#3788d8'),
(59, 1, 3554353, 'Timoteo Miguel', '', '2023-03-03 12:00:00', '2023-03-03 12:45:00', '#ffffff', '#3788d8'),
(60, 1, 3554353, 'Timoteo Miguel', '', '2023-03-10 12:00:00', '2023-03-10 12:45:00', '#ffffff', '#3788d8');

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
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `cobertura1` tinyint NOT NULL,
  `c1numero` bigint NOT NULL,
  `cobertura2` tinyint NOT NULL,
  `c2numero` bigint NOT NULL,
  `contacto` text NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`),
  KEY `FK_cobertura_persona` (`cobertura1`),
  KEY `FK_cobertura2_persona` (`cobertura2`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `apellido`, `nombre`, `dni`, `direccion`, `cobertura1`, `c1numero`, `cobertura2`, `c2numero`, `contacto`, `estado`) VALUES
(5, 'Juanes', 'Pedro', '65464565', 'calle 8 numero 432', 10, 98758586759, 0, 0, 'madre (9876876987)\r\npadre (0987987)\r\nvecino', 1),
(6, 'Timoteo', 'Miguel', '3554353', 'Larrea 234', 6, 7765556579, 0, 0, 'silvia (2342997987)', 1);

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
(1, 'profesional 1'),
(2, 'profesional 2'),
(3, 'profesional 3'),
(4, 'profesional 4'),
(5, 'Alvarado Jose');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
