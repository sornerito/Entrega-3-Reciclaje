-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2025 a las 06:38:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reciclaje_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `numeroIdentidad` varchar(15) NOT NULL,
  `rol` varchar(50) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`numeroIdentidad`, `rol`) VALUES
('3', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `idNotificacion` int(11) NOT NULL,
  `fechaEnvio` date NOT NULL,
  `mensaje` text NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `idSolicitud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `numeroIdentidad` varchar(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `numeroCelular` varchar(20) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fechaRegistro` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`numeroIdentidad`, `nombre`, `correo`, `numeroCelular`, `contrasena`, `fechaRegistro`) VALUES
('1', 'RECINORGANIC', 'recinorganic@gmail.com', '5142364158', 'recinorganic123*', '0000-00-00'),
('2', 'Juan Cliente Merengue', 'juanmerengue@gmail.com', '3201451248', 'juan123*', '0000-00-00'),
('3', 'Admin', 'admin@gmail.com', '3102451784', 'admin123*', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recolectora`
--

CREATE TABLE `recolectora` (
  `nit` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recolectora`
--

INSERT INTO `recolectora` (`nit`, `direccion`) VALUES
('1', 'Campo Amor Cll 7 #45-89');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idSolicitud` int(11) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `fechaRecoleccion` date DEFAULT NULL,
  `numeroTurno` int(11) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `puntosOtorgados` int(11) DEFAULT 0,
  `idResiduo` varchar(10) NOT NULL,
  `nitRecolectora` varchar(15) DEFAULT NULL,
  `numeroIdentidadUsuario` varchar(15) NOT NULL,
  `numeroIdentidadAdmin` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idSolicitud`, `fechaRegistro`, `fechaRecoleccion`, `numeroTurno`, `estado`, `puntosOtorgados`, `idResiduo`, `nitRecolectora`, `numeroIdentidadUsuario`, `numeroIdentidadAdmin`) VALUES
(1, '2025-08-14', '2025-08-20', NULL, 'Pendiente', NULL, '1', NULL, '2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudinorganica`
--

CREATE TABLE `solicitudinorganica` (
  `idSolicitud` int(11) NOT NULL,
  `pesoKg` float DEFAULT NULL CHECK (`pesoKg` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudinorganica`
--

INSERT INTO `solicitudinorganica` (`idSolicitud`, `pesoKg`) VALUES
(1, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiporesiduo`
--

CREATE TABLE `tiporesiduo` (
  `idResiduo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiporesiduo`
--

INSERT INTO `tiporesiduo` (`idResiduo`, `nombre`, `descripcion`) VALUES
('1', 'Inorganico', NULL),
('2', 'Organico', NULL),
('3', 'Peligroso', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `numeroIdentidad` varchar(15) NOT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `estadoSuscripcion` tinyint(1) DEFAULT 1,
  `rol` varchar(50) DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`numeroIdentidad`, `localidad`, `direccion`, `estadoSuscripcion`, `rol`) VALUES
('2', 'Itagüi', 'Galon cll 8 #34 09', 1, 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`numeroIdentidad`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `idSolicitud` (`idSolicitud`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`numeroIdentidad`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `recolectora`
--
ALTER TABLE `recolectora`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `idResiduo` (`idResiduo`),
  ADD KEY `nitRecolectora` (`nitRecolectora`),
  ADD KEY `numeroIdentidadUsuario` (`numeroIdentidadUsuario`),
  ADD KEY `numeroIdentidadAdmin` (`numeroIdentidadAdmin`);

--
-- Indices de la tabla `solicitudinorganica`
--
ALTER TABLE `solicitudinorganica`
  ADD PRIMARY KEY (`idSolicitud`);

--
-- Indices de la tabla `tiporesiduo`
--
ALTER TABLE `tiporesiduo`
  ADD PRIMARY KEY (`idResiduo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`numeroIdentidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`numeroIdentidad`) REFERENCES `persona` (`numeroIdentidad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud` (`idSolicitud`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recolectora`
--
ALTER TABLE `recolectora`
  ADD CONSTRAINT `recolectora_ibfk_1` FOREIGN KEY (`nit`) REFERENCES `persona` (`numeroIdentidad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`idResiduo`) REFERENCES `tiporesiduo` (`idResiduo`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`nitRecolectora`) REFERENCES `recolectora` (`nit`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`numeroIdentidadUsuario`) REFERENCES `usuario` (`numeroIdentidad`),
  ADD CONSTRAINT `solicitud_ibfk_4` FOREIGN KEY (`numeroIdentidadAdmin`) REFERENCES `administrador` (`numeroIdentidad`);

--
-- Filtros para la tabla `solicitudinorganica`
--
ALTER TABLE `solicitudinorganica`
  ADD CONSTRAINT `solicitudinorganica_ibfk_1` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud` (`idSolicitud`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`numeroIdentidad`) REFERENCES `persona` (`numeroIdentidad`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
