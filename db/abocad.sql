-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 27, 2022 at 01:10 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abocad`
--

DELIMITER $$
--
-- Procedures
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
-- Table structure for table `coberturas`
--

DROP TABLE IF EXISTS `coberturas`;
CREATE TABLE IF NOT EXISTS `coberturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coberturas`
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
-- Table structure for table `eventos`
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
  `cobertura` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `profesional`, `dni`, `title`, `description`, `start`, `end`, `textColor`, `backgroundColor`, `estado`, `cobertura`) VALUES
(1, 1, 234234, 'Picapiedras Wilma', 'test', '2022-11-13 10:00:00', '2022-11-13 11:00:00', '#FFFFFF', '#FFFFFF', 'pre', NULL),
(43, 1, 234234, 'Picapiedras Wilma', 'test modificacion', '2022-11-13 14:00:00', '2022-11-13 15:00:00', '#FFFFFF', '#FFFFFF', 'aCa', NULL),
(44, 1, 234234, 'Picapiedras Wilma', 'test', '2022-11-14 10:00:00', '1900-01-14 12:53:36', '#FFFFFF', '#FFFFFF', 'aSa', NULL),
(46, 2, 3323425, 'simpson homero', '', '2022-11-10 10:00:00', '2022-11-10 11:00:00', '#ffffff', '#3788d8', '', NULL),
(47, 2, 234234, 'Picapiedras Wilma', '', '2022-11-10 11:00:00', '2022-11-10 12:30:00', '#ffffff', '#d73747', '', NULL),
(48, 1, 3323425, 'simpson homero', '', '2022-11-11 18:00:00', '2022-11-11 19:00:00', '#ffffff', '#3788d8', 'aCa', NULL),
(49, 3, 3323425, 'simpson homero', '', '2022-11-11 17:00:00', '2022-11-11 17:50:00', '#ffffff', '#3788d8', '', NULL),
(50, 3, 3323425, 'simpson homero', '', '2022-11-18 17:00:00', '2022-11-18 17:50:00', '#ffffff', '#3788d8', NULL, NULL),
(51, 3, 3323425, 'simpson homero', '', '2022-11-25 17:00:00', '2022-11-25 17:50:00', '#ffffff', '#3788d8', NULL, NULL),
(52, 3, 3323425, 'simpson homero', '', '2022-12-02 17:00:00', '2022-12-02 17:50:00', '#ffffff', '#3788d8', NULL, NULL),
(53, 3, 3323425, 'simpson homero', '', '2022-12-09 17:00:00', '2022-12-09 17:50:00', '#ffffff', '#3788d8', NULL, NULL),
(54, 3, 3323425, 'simpson homero', '', '2022-12-16 17:00:00', '2022-12-16 17:50:00', '#ffffff', '#3788d8', NULL, NULL),
(55, 3, 3323425, 'simpson homero', '', '2022-12-23 17:00:00', '2022-12-23 17:50:00', '#ffffff', '#3788d8', NULL, NULL),
(56, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2022-11-23 11:00:00', '2022-11-23 12:00:00', '#ffffff', '#d73737', 'aCa', NULL),
(57, 1, 22342352, 'Romero Matias', '', '2022-11-23 12:00:00', '2022-11-23 13:00:00', '#ffffff', '#3788d8', 'aCa', NULL),
(58, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2022-11-30 11:00:00', '2022-11-30 12:00:00', '#ffffff', '#d73737', 'pre', NULL),
(59, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2022-12-07 11:00:00', '2022-12-07 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(60, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2022-12-14 11:00:00', '2022-12-14 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(61, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2022-12-21 11:00:00', '2022-12-21 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(62, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2022-12-28 11:00:00', '2022-12-28 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(63, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2023-01-04 11:00:00', '2023-01-04 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(64, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2023-01-11 11:00:00', '2023-01-11 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(65, 1, 78687687, 'Timoteo Miguel', 'me va a tgirart', '2023-01-18 11:00:00', '2023-01-18 12:00:00', '#ffffff', '#d73737', NULL, NULL),
(66, 2, 3323425, 'simpson homero', '', '2022-11-17 10:00:00', '2022-11-17 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(67, 2, 3323425, 'simpson homero', '', '2022-11-24 10:00:00', '2022-11-24 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(68, 2, 3323425, 'simpson homero', '', '2022-12-01 10:00:00', '2022-12-01 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(69, 2, 3323425, 'simpson homero', '', '2022-12-08 10:00:00', '2022-12-08 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(70, 2, 3323425, 'simpson homero', '', '2022-12-15 10:00:00', '2022-12-15 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(71, 2, 3323425, 'simpson homero', '', '2022-12-22 10:00:00', '2022-12-22 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(72, 2, 3323425, 'simpson homero', '', '2022-12-29 10:00:00', '2022-12-29 11:00:00', '#ffffff', '#3788d8', NULL, NULL),
(73, 1, 25444333, 'Neymar Jr', '', '2022-11-24 11:00:00', '2022-11-24 12:00:00', '#ffffff', '#3788d8', '', 0),
(74, 1, 25444333, 'Neymar Jr', '', '2022-11-25 10:00:00', '2022-11-25 11:00:00', '#ffffff', '#3788d8', '', 0),
(75, 1, 25444333, 'Neymar Jr', '', '2022-11-25 11:00:00', '2022-11-25 11:00:00', '#ffffff', '#3788d8', '', 0),
(76, 1, 23334443, 'Messi Lionel', '', '2022-11-26 00:00:00', '2022-11-26 00:00:00', '#ffffff', '#3788d8', '', 0),
(77, 2, 23334443, 'Messi Lionel', '', '2022-11-24 11:00:00', '2022-11-24 12:00:00', '#ffffff', '#3788d8', '', 0),
(78, 2, 23334443, 'Messi Lionel', 'test', '2022-11-26 10:00:00', '2022-11-26 11:00:00', '#ffffff', '#3788d8', '', 0),
(79, 2, 22342352, 'Romero Matias', '', '2022-11-25 10:00:00', '2022-11-25 11:00:00', '#ffffff', '#3788d8', '', 0),
(80, 2, 25444333, 'Neymar Jr', '', '2022-11-24 07:00:00', '2022-11-24 07:00:00', '#ffffff', '#3788d8', '', 1),
(81, 2, 78687687, 'Timoteo Miguel', '', '2022-11-25 12:00:00', '2022-11-25 13:00:00', '#ffffff', '#3788d8', '', 1),
(82, 2, 234234, 'Picapiedras Wilma', '', '2022-11-25 08:00:00', '2022-11-25 08:00:00', '#d85555', '#3788d8', '', 0),
(83, 2, 25444333, 'Neymar Jr', '', '2022-11-26 13:00:00', '2022-11-26 13:00:00', '#ffffff', '#3788d8', '', 0),
(84, 2, 25444333, 'Neymar Jr', '', '2022-11-25 07:00:00', '2022-11-25 07:00:00', '#ffffff', '#3788d8', '', 0),
(85, 2, 0, '', '', '2022-11-26 09:00:00', '2022-11-26 10:00:00', '#ffffff', '#3788d8', '', 0),
(86, 2, 234234, 'Picapiedras Wilma', '', '2022-11-27 07:30:00', '2022-11-27 07:30:00', '#ffffff', '#3788d8', '', 0),
(87, 2, 25444333, 'Neymar Jr', '', '2022-11-27 12:00:00', '2022-11-27 12:00:00', '#ffffff', '#3788d8', '', 0),
(88, 2, 25444333, 'Neymar Jr', '', '2022-11-26 07:30:00', '2022-11-26 07:30:00', '#ffffff', '#3788d8', '', 0),
(89, 2, 234234, 'Picapiedras Wilma', '', '2022-11-25 14:00:00', '2022-11-25 14:00:00', '#ffffff', '#3788d8', '', 0),
(90, 2, 23334443, 'Messi Lionel', '', '2022-11-25 16:00:00', '2022-11-25 17:00:00', '#ffffff', '#3788d8', '', 1),
(91, 2, 234234, 'Picapiedras Wilma', '', '2022-11-24 13:00:00', '2022-11-24 13:00:00', '#ffffff', '#3788d8', '', 0),
(92, 2, 23334443, 'Messi Lionel', '', '2022-11-28 09:00:00', '2022-11-28 10:00:00', '#ffffff', '#3788d8', '', 0),
(93, 2, 25444333, 'Neymar Jr', '', '2022-11-28 10:00:00', '2022-11-28 11:00:00', '#ffffff', '#3788d8', '', 0),
(94, 2, 22342352, 'Romero Matias', '', '2022-11-28 11:00:00', '2022-11-28 11:00:00', '#ffffff', '#3788d8', '', 11);

-- --------------------------------------------------------

--
-- Table structure for table `eventospredefinidos`
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
-- Dumping data for table `eventospredefinidos`
--

INSERT INTO `eventospredefinidos` (`id`, `titulo`, `horaInicio`, `horaFin`, `colortexto`, `colorfondo`) VALUES
(1, 'sobreturno', '14:00:00', '15:00:00', '#FFFFFF', '#FF3333'),
(2, 'turno especial', '12:00:00', '14:00:00', '#FFFFFF', '#00AC22');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `msg` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`msg`) VALUES
(''),
('');

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `contacto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `contactoColegio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `reintegro` tinyint DEFAULT '0',
  `tipoCobertura` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `dni`, `fechaNacimiento`, `contacto`, `contactoColegio`, `estado`, `reintegro`, `tipoCobertura`) VALUES
(20, 'Romero', 'Matias', '22342352', '2010-06-10', 'madre: 011-33345433\r\npadre: 011: 77643999', 'director: 786976', 1, 0, 1),
(13, 'Picapiedras', 'Wilma', '234234', '1997-02-12', 'edad de piedra', '', 1, 0, 2),
(21, 'Timoteo', 'Miguel', '78687687', '2021-12-21', 'perrro\r\ngato', '', 1, 0, 1),
(22, 'Neymar', 'Jr', '25444333', '2030-07-19', 'padre: 23423423\r\nmadre: 111111', 'direccion: 88777676', 1, 0, 2),
(23, 'Messi', 'Lionel', '23334443', '1975-10-09', 'familia', 'colegio', 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profesionales`
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
-- Table structure for table `tipocobertura`
--

DROP TABLE IF EXISTS `tipocobertura`;
CREATE TABLE IF NOT EXISTS `tipocobertura` (
  `idTipoCobertura` tinyint NOT NULL AUTO_INCREMENT,
  `descTipoCobertura` varchar(15) NOT NULL,
  PRIMARY KEY (`idTipoCobertura`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipocobertura`
--

INSERT INTO `tipocobertura` (`idTipoCobertura`, `descTipoCobertura`) VALUES
(1, 'discapacidad'),
(2, 'NO discapacidad');

-- --------------------------------------------------------

--
-- Table structure for table `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE IF NOT EXISTS `tratamientos` (
  `idTratamiento` tinyint NOT NULL AUTO_INCREMENT,
  `descTratamiento` varchar(25) NOT NULL,
  PRIMARY KEY (`idTratamiento`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tratamientos`
--

INSERT INTO `tratamientos` (`idTratamiento`, `descTratamiento`) VALUES
(1, 'fonoaudiolog??a'),
(2, 'psicolog??a'),
(3, 'psicopedagog??a'),
(4, 'orientaci??n padres'),
(5, 'talleres');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
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
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`usr_dni`, `usr_nombre`, `usr_password`, `usr_tipo`) VALUES
(22925061, 'Mariano Alfonso', 'test1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_tipo`
--

DROP TABLE IF EXISTS `usuarios_tipo`;
CREATE TABLE IF NOT EXISTS `usuarios_tipo` (
  `tipo_id` tinyint NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios_tipo`
--

INSERT INTO `usuarios_tipo` (`tipo_id`, `tipo_descripcion`) VALUES
(1, 'administrador'),
(2, 'administrativo'),
(3, 'profesional');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
