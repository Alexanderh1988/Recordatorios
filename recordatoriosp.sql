-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2021 a las 14:58:50
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

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
-- Estructura de tabla para la tabla `recordatoriosp`
--

CREATE TABLE `recordatoriosp` (
  `id` int(11) NOT NULL,
  `asunto` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `mensaje` text NOT NULL,
  `desactivado` int(6) NOT NULL,
  `fechaingreso` date NOT NULL,
  `recurrente` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recordatoriosp`
--

INSERT INTO `recordatoriosp` (`id`, `asunto`, `time`, `fecha`, `mensaje`, `desactivado`, `fechaingreso`, `recurrente`) VALUES
(1, 'Recordar en 3 dias', 1638971434, '0000-00-00', 'Recordar esto en 3 dias mas', 1, '2021-12-05', 0),
(2, 'Saludar a mi compadre', 0, '2022-01-06', 'Cumpleaños de fulano', 1, '2021-12-05', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recordatoriosp`
--
ALTER TABLE `recordatoriosp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recordatoriosp`
--
ALTER TABLE `recordatoriosp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1571756430;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
