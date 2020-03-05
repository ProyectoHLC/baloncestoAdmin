-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2020 a las 21:42:20
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baloncesto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `cod_equipo` int(11) NOT NULL,
  `cod_liga` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `num_social` int(11) NOT NULL,
  `fecha` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`cod_equipo`, `cod_liga`, `nombre`, `ciudad`, `num_social`, `fecha`) VALUES
(8, 1, 'Los Androidos', 'Cádiz', 1735632, 2018),
(9, 1, 'Los Iónicos', 'Madrid', 61416614, 2011),
(10, 1, 'Los Peacheperos', 'Toledo', 7247245, 2011),
(11, 1, 'Los Javos', 'Almería', 6426426, 2007),
(12, 1, 'Los Pitoneros', 'Valencia', 80134051, 2020),
(13, 1, 'Los Kotlinos', 'Huelva', 9519854, 2008),
(14, 1, 'Los Ceeseezeros', 'Granada', 9074915, 2013),
(15, 1, 'Los Angulados', 'Sevilla', 10978261, 2017),
(16, 1, 'Los Ezecueles', 'Jaén', 4301932, 2016),
(17, 1, 'Los No-Ezecueles', 'Zaragoza', 923568215, 2018),
(18, 1, 'Los Oodos', 'Alicante', 899150342, 2017),
(19, 1, 'Los Hibernados', 'Bilbao', 782136261, 2015);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `cod_liga` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `year` year(4) NOT NULL,
  `descripcion` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`cod_liga`, `nombre`, `year`, `descripcion`) VALUES
(1, 'Liga Baldomero', 2014, 'Liga de baloncesto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id_result` int(11) NOT NULL,
  `cod_equipo1` int(11) NOT NULL,
  `cod_equipo2` int(11) NOT NULL,
  `result_equipo1` int(11) NOT NULL,
  `result_equipo2` int(11) NOT NULL,
  `fecha` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id_result`, `cod_equipo1`, `cod_equipo2`, `result_equipo1`, `result_equipo2`, `fecha`) VALUES
(29, 8, 9, 8, 6, 2019),
(30, 14, 15, 6, 2, 2019),
(31, 18, 11, 10, 6, 2020),
(32, 16, 17, 5, 5, 2020),
(33, 13, 10, 6, 3, 2019),
(34, 14, 10, 4, 7, 2020),
(35, 18, 12, 5, 2, 2020),
(36, 17, 8, 1, 3, 2020),
(37, 17, 15, 5, 7, 2020),
(38, 10, 12, 5, 3, 2020),
(39, 9, 14, 8, 5, 2019),
(40, 18, 9, 3, 6, 2008),
(41, 14, 16, 2, 6, 2020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `password`) VALUES
('Baldomero', '12345678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`cod_equipo`),
  ADD KEY `fk_liga` (`cod_liga`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`cod_liga`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id_result`),
  ADD KEY `fk_equipo_1` (`cod_equipo1`),
  ADD KEY `fk_equipo_2` (`cod_equipo2`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `cod_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fk_liga` FOREIGN KEY (`cod_liga`) REFERENCES `liga` (`cod_liga`);

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `fk_equipo_1` FOREIGN KEY (`cod_equipo1`) REFERENCES `equipos` (`cod_equipo`),
  ADD CONSTRAINT `fk_equipo_2` FOREIGN KEY (`cod_equipo2`) REFERENCES `equipos` (`cod_equipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
