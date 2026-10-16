-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2026 a las 00:25:00
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
-- Base de datos: `db_2026_1s_6b`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `correo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `correo` (
`idcorreo` int(11)
,`idcorreoelectronico` int(11)
,`idpersona` int(11)
,`correo` varchar(150)
,`nombre` varchar(150)
,`tipo` varchar(50)
,`fechaoptencion` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correoelectronico`
--

CREATE TABLE `correoelectronico` (
  `idcorreoelectronico` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT 'Personal',
  `fechaoptencion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `correoelectronico`
--

INSERT INTO `correoelectronico` (`idcorreoelectronico`, `idpersona`, `correo`, `nombre`, `tipo`, `fechaoptencion`) VALUES
(1, 1, 'carlos.mendoza@gmail.com', 'carlos.mendoza@gmail.com', 'Personal', '2023-01-15'),
(2, 1, 'cmendoza@empresa.ec', 'cmendoza@empresa.ec', 'Institucional', '2023-06-20'),
(3, 2, 'maria.fernanda.q@outlook.com', 'maria.fernanda.q@outlook.com', 'Personal', '2022-10-10'),
(4, 3, 'luis.valencia.c@hotmail.com', 'luis.valencia.c@hotmail.com', 'Personal', '2021-04-12'),
(5, 4, 'ana.estupinan@utlvte.edu.ec', 'ana.estupinan@utlvte.edu.ec', 'Institucional', '2024-02-01'),
(6, 5, 'alex.montano@yahoo.com', 'alex.montano@yahoo.com', 'Personal', '2024-05-18'),
(7, 6, 'rosa.arroyo@gmail.com', 'rosa.arroyo@gmail.com', 'Personal', '2020-09-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `iddireccion` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT 'Domicilio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`iddireccion`, `idpersona`, `direccion`, `nombre`, `tipo`) VALUES
(1, 1, 'Av. Olmedo y Rocafuerte, Barrio Central', 'Av. Olmedo y Rocafuerte, Barrio Central', 'Domicilio'),
(2, 1, 'Ciudadela Tolita 1, Manzana B Villa 12', 'Ciudadela Tolita 1, Manzana B Villa 12', 'Trabajo'),
(3, 2, 'Calle Bolívar 405 y 10 de Agosto', 'Calle Bolívar 405 y 10 de Agosto', 'Domicilio'),
(4, 3, 'Av. Kennedy frente al Parque Infantil', 'Av. Kennedy frente al Parque Infantil', 'Domicilio'),
(5, 4, 'Sector Las Palmas, Malecón y Calle 6', 'Sector Las Palmas, Malecón y Calle 6', 'Domicilio'),
(6, 5, 'Av. Pedro Vicente Maldonado y Sucre', 'Av. Pedro Vicente Maldonado y Sucre', 'Domicilio'),
(7, 6, 'Barrio Nueva Esperanza, Calle Principal #45', 'Barrio Nueva Esperanza, Calle Principal #45', 'Domicilio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivil`
--

CREATE TABLE `estadocivil` (
  `idestadocivil` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estadocivil`
--

INSERT INTO `estadocivil` (`idestadocivil`, `nombre`) VALUES
(1, 'Soltero/a'),
(2, 'Casado/a'),
(3, 'Divorciado/a'),
(4, 'Viudo/a'),
(5, 'Unión Libre / De Hecho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-10-12-212629', 'App\\Database\\Migrations\\CreatePersonaTables', 'default', 'App', 1791840434, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `idsexo` int(11) DEFAULT NULL,
  `idestadocivil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `cedula`, `nombres`, `apellidos`, `fechanacimiento`, `idsexo`, `idestadocivil`) VALUES
(1, '0801234567', 'Carlos Alberto', 'Mendoza Zambrano', '1992-05-14', 1, 1),
(2, '0802345678', 'María Fernanda', 'Quiñónez Hurtado', '1995-11-23', 2, 2),
(3, '0803456789', 'Luis Eduardo', 'Valencia Caicedo', '1988-03-30', 1, 5),
(4, '0804567890', 'Ana Patricia', 'Estupiñán Cortez', '1999-08-19', 2, 1),
(5, '0805678901', 'Alex Gabriel', 'Montaño Bone', '2001-01-10', 3, 1),
(6, '0806789012', 'Rosa Elena', 'Arroyo Mina', '1985-07-04', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `idsexo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`idsexo`, `nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'No Binario'),
(4, 'Prefiero no especificar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `idtelefono` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `tipo` varchar(50) DEFAULT 'Celular',
  `fechaoptencion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura para la vista `correo`
--
DROP TABLE IF EXISTS `correo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `correo`  AS SELECT `correoelectronico`.`idcorreoelectronico` AS `idcorreo`, `correoelectronico`.`idcorreoelectronico` AS `idcorreoelectronico`, `correoelectronico`.`idpersona` AS `idpersona`, `correoelectronico`.`correo` AS `correo`, `correoelectronico`.`nombre` AS `nombre`, `correoelectronico`.`tipo` AS `tipo`, `correoelectronico`.`fechaoptencion` AS `fechaoptencion` FROM `correoelectronico` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correoelectronico`
--
ALTER TABLE `correoelectronico`
  ADD PRIMARY KEY (`idcorreoelectronico`),
  ADD KEY `idpersona` (`idpersona`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`iddireccion`),
  ADD KEY `idpersona` (`idpersona`);

--
-- Indices de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  ADD PRIMARY KEY (`idestadocivil`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `idsexo` (`idsexo`),
  ADD KEY `idestadocivil` (`idestadocivil`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`idsexo`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`idtelefono`),
  ADD KEY `idpersona` (`idpersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `correoelectronico`
--
ALTER TABLE `correoelectronico`
  MODIFY `idcorreoelectronico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `iddireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estadocivil`
--
ALTER TABLE `estadocivil`
  MODIFY `idestadocivil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `idsexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `idtelefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `correoelectronico`
--
ALTER TABLE `correoelectronico`
  ADD CONSTRAINT `correoelectronico_idpersona_foreign` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_idpersona_foreign` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_idestadocivil_foreign` FOREIGN KEY (`idestadocivil`) REFERENCES `estadocivil` (`idestadocivil`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `persona_idsexo_foreign` FOREIGN KEY (`idsexo`) REFERENCES `sexo` (`idsexo`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `fk_telefono_persona` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
