-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2017 a las 06:50:39
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mundo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldocumentos`
--

CREATE TABLE `tbldocumentos` (
  `codDocumento` int(15) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `url` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codProyecto` int(15) NOT NULL,
  `codUsuario` int(15) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbldocumentos`
--

INSERT INTO `tbldocumentos` (`codDocumento`, `nombre`, `descripcion`, `url`, `codProyecto`, `codUsuario`, `fecha`) VALUES
(1, 'Documento de prueba', 'Documento para prueba', 'docs/doc1.pdf', 3, 1, '2017-11-01'),
(2, 'Documento de prueba 2', 'Docuemtno de prueba 2', 'docs/doc.pdf', 3, 1, '2017-10-19'),
(6, 'Archivo 41', 'ninguna', 'docs/archivo4.pdf', 3, 1, '2017-11-06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbldocumentos`
--
ALTER TABLE `tbldocumentos`
  ADD PRIMARY KEY (`codDocumento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbldocumentos`
--
ALTER TABLE `tbldocumentos`
  MODIFY `codDocumento` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
