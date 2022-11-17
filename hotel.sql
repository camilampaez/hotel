-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-11-2022 a las 03:26:57
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_hab`
--

CREATE TABLE `estado_hab` (
  `id` int(11) NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_hab`
--

INSERT INTO `estado_hab` (`id`, `estado`) VALUES
(9, 'disponible'),
(10, 'en refacción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_reservas`
--

CREATE TABLE `estado_reservas` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_reservas`
--

INSERT INTO `estado_reservas` (`id`, `estado`) VALUES
(1, 'proceso de pago'),
(2, 'pagada'),
(3, 'cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `edificio` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `piso` int(1) NOT NULL,
  `nro` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `individual` int(2) NOT NULL,
  `matrimonial` int(2) NOT NULL,
  `cocina` tinyint(1) NOT NULL,
  `jacuzzi` tinyint(1) NOT NULL,
  `precio` float NOT NULL,
  `id_estado_hab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `edificio`, `piso`, `nro`, `individual`, `matrimonial`, `cocina`, `jacuzzi`, `precio`, `id_estado_hab`) VALUES
(46, 'Costa Clara', 1, '1A', 0, 1, 0, 0, 1000, 9),
(47, 'Costa Clara', 1, '1B', 1, 1, 0, 0, 1100, 9),
(49, 'Costa Clara', 1, '1C', 2, 1, 0, 0, 1200, 9),
(50, 'Costa Clara', 1, '1D', 3, 1, 0, 0, 1300, 9),
(51, 'Costa Clara', 2, '2A', 0, 1, 1, 0, 1400, 9),
(52, 'Costa Clara', 2, '2B', 1, 1, 1, 0, 1500, 9),
(53, 'Costa Clara', 2, '2C', 2, 1, 1, 0, 1600, 9),
(54, 'Costa Clara', 2, '2D', 3, 1, 1, 0, 1700, 9),
(55, 'Costa Clara', 3, '3A', 0, 1, 0, 1, 1800, 9),
(56, 'Costa Clara', 3, '3B', 1, 1, 0, 1, 1900, 9),
(57, 'Costa Clara', 3, '3C', 2, 1, 0, 1, 2000, 9),
(58, 'Costa Clara', 3, '3D', 3, 1, 0, 1, 2100, 9),
(59, 'Costa Clara', 4, '4A', 0, 1, 1, 1, 2200, 9),
(60, 'Costa Clara', 4, '4B', 1, 1, 1, 1, 2300, 9),
(61, 'Costa Clara', 4, '4C', 2, 1, 1, 1, 2400, 9),
(62, 'Costa Clara', 4, '4D', 3, 1, 1, 1, 2500, 9),
(63, 'Anclamar', 1, '1A', 0, 1, 0, 0, 1000, 9),
(64, 'Anclamar', 1, '1B', 1, 1, 0, 0, 1100, 9),
(65, 'Anclamar', 1, '1C', 0, 2, 0, 0, 1200, 9),
(66, 'Anclamar', 1, '1D', 3, 1, 0, 0, 1300, 9),
(67, 'Anclamar', 2, '2A', 0, 1, 1, 0, 1400, 9),
(68, 'Anclamar', 2, '2B', 1, 1, 1, 0, 1500, 9),
(69, 'Anclamar', 2, '2D', 0, 2, 1, 0, 1700, 9),
(70, 'Anclamar', 3, '3A', 0, 1, 0, 1, 1800, 9),
(71, 'Anclamar', 3, '3B', 1, 1, 0, 1, 1900, 9),
(72, 'Anclamar', 3, '3C', 0, 2, 0, 1, 2000, 9),
(73, 'Anclamar', 3, '3D', 3, 1, 0, 1, 2100, 9),
(74, 'Anclamar', 4, '4A', 0, 1, 1, 1, 2200, 9),
(75, 'Anclamar', 4, '4B', 1, 1, 1, 1, 2300, 9),
(76, 'Anclamar', 4, '4C', 0, 2, 1, 1, 2400, 9),
(77, 'Anclamar', 4, '4D', 3, 1, 1, 1, 2500, 9),
(78, 'Anclamar', 2, '2C', 0, 2, 1, 0, 1600, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `precio_final` float NOT NULL,
  `id_estado_res` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuarios`
--

CREATE TABLE `rol_usuarios` (
  `id` int(11) NOT NULL,
  `rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol_usuarios`
--

INSERT INTO `rol_usuarios` (`id`, `rol`) VALUES
(1, 'administrador'),
(2, 'huesped');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `telefono` int(15) NOT NULL,
  `mail` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `dni`, `telefono`, `mail`, `password`, `id_rol`) VALUES
(1, 'camila', 'paez', 12456789, 1135359898, 'camila@hotmail.com', '1234', 1),
(4, 'jacquelin', 'gonzalez', 87654321, 1148480808, 'jacqui@mail.com', '1234', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado_hab`
--
ALTER TABLE `estado_hab`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_reservas`
--
ALTER TABLE `estado_reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `un_edificio_nro_idest` (`edificio`,`nro`,`id_estado_hab`) USING BTREE;

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hab_desde_huesp_est` (`id_habitacion`,`fecha_desde`,`id_usuario`,`id_estado_res`) USING BTREE;

--
-- Indices de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `un_rol_tipo` (`rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `un_dni_idrol` (`dni`,`id_rol`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado_hab`
--
ALTER TABLE `estado_hab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado_reservas`
--
ALTER TABLE `estado_reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`id_estado_hab`) REFERENCES `estado_hab` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_estado_res`) REFERENCES `estado_reservas` (`id`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol_usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
