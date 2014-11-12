-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2014 a las 01:02:02
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `credencial`
--
CREATE DATABASE IF NOT EXISTS `credencial` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `credencial`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_depto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_depto` varchar(30) NOT NULL,
  `id_org` int(11) NOT NULL,
  PRIMARY KEY (`id_depto`,`id_org`),
  KEY `id_org` (`id_org`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_depto`, `nombre_depto`, `id_org`) VALUES
(1, 'Almacen', 1),
(2, 'Producción', 1),
(3, 'Gerencia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `id_emp` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_emp` varchar(30) NOT NULL,
  `apellidop_emp` varchar(20) NOT NULL,
  `puesto_trabajo_emp` varchar(30) NOT NULL,
  `id_depto` int(11) NOT NULL,
  `id_org` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_emp`,`id_depto`,`id_org`),
  KEY `id_depto` (`id_depto`,`id_org`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_emp`, `nombre_emp`, `apellidop_emp`, `puesto_trabajo_emp`, `id_depto`, `id_org`, `fecha`) VALUES
(1, 'Rogelio', 'Trejo', 'ISC', 1, 1, '2014-11-05'),
(2, 'Rogelio', 'Trejo', 'Operador', 2, 1, '2014-11-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id_org` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `logo_org` varchar(20) NOT NULL,
  PRIMARY KEY (`id_org`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_org`, `nombre`, `logo_org`) VALUES
(1, 'ITC', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`id_org`) REFERENCES `empresa` (`id_org`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_depto`, `id_org`) REFERENCES `departamento` (`id_depto`, `id_org`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
