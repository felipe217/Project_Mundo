-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2017 a las 04:50:13
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
-- Estructura de tabla para la tabla `tblpatrocinadores`
--

CREATE TABLE `tblpatrocinadores` (
  `codPatrocinador` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `tipoPatrocinador` varchar(50) DEFAULT NULL,
  `lugarProcedencia` varchar(45) DEFAULT NULL,
  `correoElectronico` varchar(45) DEFAULT NULL,
  `nombreContacto` varchar(45) DEFAULT NULL,
  `telefonoContacto` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblpatrocinadores`
--

INSERT INTO `tblpatrocinadores` (`codPatrocinador`, `nombre`, `tipoPatrocinador`, `lugarProcedencia`, `correoElectronico`, `nombreContacto`, `telefonoContacto`, `direccion`) VALUES
(1, 'ONG INTERNACIONAL', 'ONG', 'Estados Unidos', 'mari@algo.com', 'Maria Isabel', '22778899', 'Colonia el loaque '),
(2, 'OTRA ONG', 'Organizacion no gubernamental', 'ALEMANIA', 'algo@servidor.com', 'MIRNA JUANES', '11223344', ''),
(3, 'Amigos de los ninos', 'Organizacion no gubernamental', 'Honduras', 'algo@servidor.com', 'Sergio peÃ±a', '22456734', ''),
(4, 'Fulanito de tal', 'Empresa Socialmente Responsable', 'san pedro sula ', 'juana@gmail.com', 'Juana Maria', '95288656', 'a la par d un lado'),
(5, 'World vision Honduras', 'Organizacion no gubernamental', 'Francia', 'marleness@algo.com', 'Marlene Suarez', '22334455', 'Colonia lomas del guijarro, calle principal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  ADD PRIMARY KEY (`codPatrocinador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  MODIFY `codPatrocinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
