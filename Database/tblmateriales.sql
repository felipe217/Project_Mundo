-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2017 a las 04:27:52
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `administradorproyectos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmateriales`
--

CREATE TABLE `tblmateriales` (
  `codMaterial` int(11) NOT NULL,
  `fechaAsignacion` date NOT NULL,
  `proveedor` varchar(45) DEFAULT NULL,
  `material` varchar(45) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `codProyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblmateriales`
--

INSERT INTO `tblmateriales` (`codMaterial`, `fechaAsignacion`, `proveedor`, `material`, `cant`, `precio`, `total`, `codProyecto`) VALUES
(1, '2017-09-27', 'el chino', 'material 1', 2, 30, 60, 1),
(2, '2017-09-20', 'el chino', 'material 2', 5, 100, 500, 1),
(3, '2017-09-15', 'Comercial El Rosario', 'Sacapuntas metalico', 30, 2.45, 73.5, 1),
(4, '2017-09-21', 'Diunsa', 'Televisor 32 pulg', 1, 6789, 6789, 1),
(5, '2017-09-19', 'Juan carlos', 'Pala ', 1, 250, 250, 1),
(6, '2017-09-25', 'Comercial El Rosario', 'Impresora multifuncional', 1, 3800, 3800, 2),
(7, '2017-09-14', 'El chino', 'Tinta', 5, 150, 750, 2),
(8, '2017-10-01', 'Comercial El Rosario', 'Grapadora', 2, 120, 240, 3),
(9, '2017-08-30', 'Comercial El Rosario', 'Pala ', 1, 300, 300, 5),
(10, '2017-10-06', 'Comercial El Rosario', 'Sacapuntas metalico', 5, 5, 25, 4),
(11, '2017-10-03', 'Comercial El Rosario', 'Pala ', 2, 56, 112, 5),
(12, '2017-10-18', 'Utiles de Honduras', 'Marcadores de pizarra', 12, 18, 216, 7),
(13, '2017-10-15', 'Variedades Yeny', 'Escoba para barrer', 10, 46.5, 465, 4),
(14, '2017-10-10', 'Comercial El Rosario', 'Impresora multifuncional', 2, 3455, 6910, 6),
(15, '2017-10-17', 'Juan carlos', 'Impresora multifuncional', 2, 2344, 4688, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblmateriales`
--
ALTER TABLE `tblmateriales`
  ADD PRIMARY KEY (`codMaterial`),
  ADD KEY `fk_tblMateriales_tblProyectos1_idx` (`codProyecto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblmateriales`
--
ALTER TABLE `tblmateriales`
  MODIFY `codMaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
