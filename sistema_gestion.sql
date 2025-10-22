-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2025 a las 06:09:51
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_gestion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `ID` int(11) NOT NULL,
  `DNI` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  `Estado` enum('activo','inactivo') NOT NULL,
  `Sesion_activa` tinyint(1) NOT NULL DEFAULT 0,
  `Ultimo_acceso` timestamp NULL DEFAULT NULL,
  `Creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `Actualizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`ID`, `DNI`, `Nombre`, `Apellido`, `Email`, `Contraseña`, `Rol_ID`, `Estado`, `Sesion_activa`, `Ultimo_acceso`, `Creado`, `Actualizado`) VALUES
(15, '10000000', 'Diego', 'Maradona', 'diegote@email.com', '$2y$10$kT6ERjAy2kuaPDNn6EIVIuNY1bYrYr4Kwa2ns8tW718WMlReoKHPO', 1, 'activo', 0, '2025-10-21 23:24:31', '2025-10-21 20:02:05', '2025-10-21 23:24:31'),
(21, '2000000', 'juan', 'perez', 'juan@email.com', '$2y$10$pDYWBy6.7x.GUMbNY6f4VO0AjYaORyJi.GJ7aHTBJg0.12aeHFZ4S', 2, 'inactivo', 0, '2025-10-21 22:11:11', '2025-10-21 22:10:13', '2025-10-21 22:26:08'),
(22, '3000000', 'Lionel', 'Messi', 'messi@email.com', '$2y$10$3Gmc4gs5e/AtclV3L8Np8O2RkZDY22Vdo6RfolCMaYorCPXUOUlrO', 1, 'activo', 0, '2025-10-21 22:14:31', '2025-10-21 22:13:33', '2025-10-21 22:14:31'),
(23, '4000000', 'Leo', 'Di Caprio', 'leo@email.com', '$2y$10$oMKGnhbQZml4Q7BmRedTaebuz19jgYDYaZwuzUcJWKiKOy350k5Ty', 2, 'activo', 0, '2025-10-21 23:03:41', '2025-10-21 23:03:29', '2025-10-21 23:03:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `Modulo` varchar(50) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `Animal` varchar(50) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Presentacion` varchar(50) NOT NULL,
  `Descripcion` text NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Creado_por` int(11) DEFAULT NULL,
  `Modificado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Animal`, `Nombre`, `Presentacion`, `Descripcion`, `Precio`, `Stock`, `Creacion`, `Actualizacion`, `Creado_por`, `Modificado_por`) VALUES
(1, 'Gatos', 'Purina catchow gatos', '15KG', '15kg de Aliimento para gatos Adultos', 90000.00, 15, '2025-09-01 18:34:09', '2025-09-21 04:08:32', NULL, NULL),
(2, 'Gatos', 'Pro Cat', '7,5KG', '7,5Kg de Alimento para Gato Adulto', 35000.00, 20, '2025-09-01 18:34:09', '2025-09-02 01:39:23', NULL, NULL),
(4, 'Gatos', 'Gatitos Felices', '15KG', '15Kg alimento balanceado gatitos felices', 68000.00, 6, '2025-09-01 23:43:24', '2025-09-02 01:36:19', NULL, NULL),
(6, 'Gatos', 'Vital Can Balanced', '7,5KG', '7,5Kg alimento balñanceado para gatos sabor Merluza', 190000.00, 22, '2025-09-02 02:18:15', '2025-09-04 19:05:26', NULL, NULL),
(15, 'Gatos', 'Vital Can ', '15KG', '15Kg alimento para gatos adultos sabor pollo', 91000.00, 15, '2025-09-04 19:51:13', '2025-09-04 19:51:13', NULL, NULL),
(16, 'Perros', 'Purina DogChow Perros', '15KG', '15Kg alimento balanceado para perro sabor Carne patagonica', 120000.00, 23, '2025-09-04 19:53:53', '2025-09-04 19:53:53', NULL, NULL),
(18, 'Perros', 'Purina DogChow Perros', '15KG', '15Kg alimento', 100000.00, 22, '2025-09-05 22:45:21', '2025-09-06 19:40:13', NULL, NULL),
(20, 'Perros', 'Purina DogChow Perros', '15KG', '15Jg', 90000.00, 23, '2025-09-06 19:41:05', '2025-09-06 19:41:05', NULL, NULL),
(21, 'Perros', 'Purina DogChow Perros', '15KG', '15Kg sabor carne', 78000.00, 12, '2025-09-06 19:41:35', '2025-09-06 19:41:35', NULL, NULL),
(22, 'Perros', 'Purina DogChow Perros', '7,5KG', 'sabor pollo', 79000.00, 11, '2025-09-06 19:41:56', '2025-09-06 19:41:56', NULL, NULL),
(23, 'Perros', 'Vital Can ', '15KG', 'holaaaaaaaa', 23450.00, 23, '2025-09-06 20:37:49', '2025-09-07 02:04:02', NULL, NULL),
(26, 'Gatos', 'Purina DogChow Perros', '15KG', 'sdsdsadsaddsadsdsdasdsdAAAAAAA', 100000.00, 34, '2025-09-21 03:30:50', '2025-09-21 03:30:50', NULL, NULL),
(27, 'Gatos', 'Vital Can Balanced', '7,5KG', 'sube el producto 13', 120000.00, 13, '2025-09-21 19:27:14', '2025-09-21 19:27:14', NULL, NULL),
(28, 'Perro', 'DogMax', '15kg', 'alimentos balanceado', 100000.00, 25, '2025-10-21 20:22:36', '2025-10-21 20:22:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `Nombre`, `Status`, `Creacion`) VALUES
(1, 'Gerente', 1, '2025-09-21 02:02:44'),
(2, 'Empleado', 1, '2025-09-21 02:02:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `ID` int(11) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  `Permiso_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones_empleados`
--

CREATE TABLE `sesiones_empleados` (
  `ID` int(11) NOT NULL,
  `Empleado_ID` int(11) NOT NULL,
  `Inicio_sesion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Fin_sesion` timestamp NULL DEFAULT NULL,
  `Status` enum('activo','cerrada','expirada') NOT NULL,
  `IP_address` varchar(50) DEFAULT NULL,
  `Session_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Rol_ID` (`Rol_ID`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Creado_por` (`Creado_por`),
  ADD KEY `Modificado_por` (`Modificado_por`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Rol_ID` (`Rol_ID`),
  ADD KEY `Permiso_ID` (`Permiso_ID`);

--
-- Indices de la tabla `sesiones_empleados`
--
ALTER TABLE `sesiones_empleados`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Session_token` (`Session_token`),
  ADD KEY `Empleado_ID` (`Empleado_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesiones_empleados`
--
ALTER TABLE `sesiones_empleados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `roles` (`ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`Creado_por`) REFERENCES `empleados` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`Modificado_por`) REFERENCES `empleados` (`ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `roles` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`Permiso_ID`) REFERENCES `permisos` (`ID`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesiones_empleados`
--
ALTER TABLE `sesiones_empleados`
  ADD CONSTRAINT `sesiones_empleados_ibfk_1` FOREIGN KEY (`Empleado_ID`) REFERENCES `empleados` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
