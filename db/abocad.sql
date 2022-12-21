-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-12-2022 a las 15:46:34
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

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
		insert into eventos (profesional,dni,title,description,start,end,textColor,backgroundColor,estado,cobertura,tratamiento) select profesional,dni,title,description,newFechaDesde,newFechaHasta,textColor,backgroundColor,null,cobertura,tratamiento from eventos where id = idEvento;
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profesional` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `textColor` varchar(7) CHARACTER SET utf8mb4 DEFAULT NULL,
  `backgroundColor` varchar(7) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estado` char(3) DEFAULT '',
  `cobertura` tinyint(4) DEFAULT NULL,
  `tratamiento` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventospredefinidos`
--

DROP TABLE IF EXISTS `eventospredefinidos`;
CREATE TABLE IF NOT EXISTS `eventospredefinidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `contacto` text,
  `contactoColegio` text,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `reintegro` tinyint(4) DEFAULT '0',
  `tipoCobertura` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
CREATE TABLE IF NOT EXISTS `profesionales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
-- Estructura de tabla para la tabla `tipocobertura`
--

DROP TABLE IF EXISTS `tipocobertura`;
CREATE TABLE IF NOT EXISTS `tipocobertura` (
  `idTipoCobertura` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descTipoCobertura` varchar(15) NOT NULL,
  PRIMARY KEY (`idTipoCobertura`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipocobertura`
--

INSERT INTO `tipocobertura` (`idTipoCobertura`, `descTipoCobertura`) VALUES
(1, 'discapacidad'),
(2, 'NO discapacidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE IF NOT EXISTS `tratamientos` (
  `idTratamiento` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descTratamiento` varchar(25) NOT NULL,
  PRIMARY KEY (`idTratamiento`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`idTratamiento`, `descTratamiento`) VALUES
(1, 'fonoaudiologia'),
(2, 'psicologia'),
(3, 'psicopedagogia'),
(4, 'orientacion padres'),
(5, 'talleres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usr_dni` int(11) NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`usr_dni`),
  KEY `fk_usuario_tipo_idx` (`usr_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `tipo_id` tinyint(4) NOT NULL,
  `tipo_descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
