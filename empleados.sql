-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-10-2022 a las 18:56:22
-- Versión del servidor: 5.7.36
-- Versión de PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taxnow`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `rut` varchar(13) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `inicio_contrato` date NOT NULL,
  `direccion` text NOT NULL,
  `telefono` int(8) NOT NULL,
  `tipo_contrato` text NOT NULL,
  `dias_trabajados` int(11) NOT NULL,
  `dias_licencia` int(11) NOT NULL,
  `dias_ausencia` int(11) NOT NULL,
  `sueldo_base` int(11) NOT NULL,
  `gratificacion` int(11) NOT NULL,
  `colacion` int(11) NOT NULL,
  `movilizacion` int(11) NOT NULL,
  `total_imponible` int(11) NOT NULL,
  `salud` text NOT NULL,
  `valor_salud` int(11) NOT NULL,
  `afp` text NOT NULL,
  `valor_afp` int(11) NOT NULL,
  `anticipo` int(11) NOT NULL,
  `total_dctos` int(11) NOT NULL,
  `imp_unico` int(11) NOT NULL,
  `seg_cesantia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `rut`, `nombre`, `inicio_contrato`, `direccion`, `telefono`, `tipo_contrato`, `dias_trabajados`, `dias_licencia`, `dias_ausencia`, `sueldo_base`, `gratificacion`, `colacion`, `movilizacion`, `total_imponible`, `salud`, `valor_salud`, `afp`, `valor_afp`, `anticipo`, `total_dctos`, `imp_unico`, `seg_cesantia`) VALUES
(1, '19.985.094-6', 'Kevin Martinez', '2022-08-08', 'Valdes 123, Melipilla', 949962577, 'Definido', 30, 0, 0, 1500000, 500000, 0, 0, 1000000, 'Fonasa', 0, 'MasVida', 0, 500000, 100000, 0, 0),
(20, '19.985.094-6', 'Kevin', '2022-08-08', 'asdawd', 949962577, 'awdawd', 30, 5, 5, 1500000, 500000, 555555, 55555, 555555, 'Salud', 400, 'AFP', 234, 423, 234, 234, 234),
(26, '5088156-3', 'José Carrasco', '2020-08-01', 'No Direccion', 11111111, 'INDEFINIDO', 30, 0, 0, 842240, 0, 0, 0, 1042240, 'VidaTres', 72957, 'Habitat', 0, 0, 0, 0, 0),
(25, '5088156-3', 'José Carrasco', '2020-08-01', 'No Direccion', 11111111, 'INDEFINIDO', 30, 0, 0, 842240, 0, 0, 0, 1042240, 'VidaTres', 72957, 'Habitat', 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
