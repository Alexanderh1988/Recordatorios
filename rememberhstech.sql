-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor:xxx
-- Tiempo de generación: 19-11-2020 a las 07:03:03
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chs44206_dbhstech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rememberhstech`
--

CREATE TABLE `rememberhstech` (
  `id` int(11) NOT NULL,
  `asunto` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `mensaje` text NOT NULL,
  `desactivado` int(6) NOT NULL,
  `fechaingreso` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rememberhstech`
--

INSERT INTO `rememberhstech` (`id`, `asunto`, `time`, `fecha`, `mensaje`, `desactivado`, `fechaingreso`) VALUES
(1571755730, 'prueba fecha', 0, '2019-11-10', 'prueba fecha', 1, '2019-11-10'),
;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rememberhstech`
--
ALTER TABLE `rememberhstech`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rememberhstech`
--
ALTER TABLE `rememberhstech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1571755762;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
