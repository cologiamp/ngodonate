
-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2019 a las 03:43:06
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ngo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donation`
--

CREATE TABLE IF NOT EXISTS `donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngoId` int(11) NOT NULL,
  `ngoName` varchar(100) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Volcado de datos para la tabla `donation`
--

INSERT INTO `donation` (`id`, `ngoId`, `ngoName`, `amount`, `created`) VALUES
(62, 1, 'Doctors Without Borders', '100', '2019-10-24 23:08:39'),
(63, 2, 'Habitat For Humanity', '10', '2019-10-24 23:10:39'),
(64, 3, 'UNHCR', '11', '2019-10-24 23:10:46'),
(65, 3, 'UNHCR', '11', '2019-10-24 23:10:53'),
(66, 1, 'Doctors Without Borders', '1', '2019-10-25 00:22:46'),
(67, 1, 'Doctors Without Borders', '25', '2019-10-25 00:23:01'),
(68, 2, 'Habitat For Humanity', '25', '2019-10-25 00:23:06'),
(69, 1, 'Doctors Without Borders', '25', '2019-10-25 00:29:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ngo`
--

CREATE TABLE IF NOT EXISTS `ngo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ngo`
--

INSERT INTO `ngo` (`id`, `name`, `created`) VALUES
(1, 'Doctors Without Borders', '2019-10-17 16:00:27'),
(2, 'Habitat For Humanity', '2019-10-17 16:00:53'),
(3, 'UNHCR', '2019-10-17 16:00:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
