-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2017 a las 04:35:20
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
-- Estructura de tabla para la tabla `tblproyectos`
--

DROP TABLE IF EXISTS `tblproyectos`;
CREATE TABLE `tblproyectos` (
  `codProyecto` int(11) NOT NULL,
  `nombreProyecto` varchar(45) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechafinal` date DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `codTipoProyecto` int(11) NOT NULL,
  `codEstado` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `costoEstimado` double DEFAULT NULL,
  `beneficiario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblproyectos`
--

INSERT INTO `tblproyectos` (`codProyecto`, `nombreProyecto`, `fechaInicio`, `fechafinal`, `lugar`, `descripcion`, `codTipoProyecto`, `codEstado`, `codUsuario`, `costoEstimado`, `beneficiario`) VALUES
(1, 'proyecto de prueba inicial', '2017-07-01', '2017-07-15', 'Tegucigalpa', 'Sed ut perspiciatis unde omnis iste', 2, 2, 1, 120000, 'Oscar Madrid'),
(2, 'proyecto de prueba 2', '2017-07-04', '2017-07-20', 'tegucigalpa', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium', 2, 1, 1, 45800.45, 'Maria Riverae'),
(3, 'nombre de proyecto 3', '2017-10-20', '2017-10-30', 'Tegucigalpa', 'descripcion 3', 1, 2, 1, 56789, 'nombre de beneficiario'),
(4, 'Proyecto numero 4', '2017-07-05', '2017-07-05', 'lugar', 'descripcion', 1, 3, 1, 35890.78, 'Marlon Soto'),
(5, 'Proyecto 5', '2017-07-05', '2017-07-05', 'san pedro sula', 'descripcion', 2, 2, 1, 90000, 'pedro maria'),
(6, 'proyecto de alfabetixzacion', '2017-07-04', '2017-07-12', 'san pedro sula', 'Specifies that the drop-down list should automatically ', 1, 2, 1, 5656456, 'pedro maria'),
(7, 'proyecto de salud', '2017-08-01', '2017-09-01', 'La ceiba', 'Specifies that the drop-down list should automaticall ', 2, 4, 1, 67567546, 'comunidad la ceiba'),
(8, 'Proyecto de prueba 21', '2017-10-22', '2017-10-28', 'Tegucigapa', 'Ninguna anotacion importante al respecto', 2, 1, 1, 5000, ''),
(9, 'Proyecto 9', '2017-10-13', '2017-10-27', 'La ceiba', '', 2, 4, 1, 8900, 'Iglesia Renacimiento'),
(10, 'Pavimentacion calle real', '2017-10-13', '2017-10-27', 'calle real tegucigalpa', '', 2, 3, 1, 1298900, 'Tegucigalpa'),
(11, 'Proyecto en ejecucion 200', '2017-10-06', '2017-10-14', 'Tegucigalpa', 'Esta es una descripcion generada para el proyecto 200. xD', 2, 2, 1, 90000.43, 'Oscar Madrid'),
(12, 'Proyeccto z', '2017-10-07', '2017-10-27', 'A la par de un lado', 'Esta es una descripcion de prueba para el proyecto en cuestion . ', 2, 3, 1, 8977, ''),
(19, 'Proyecto 19', '2017-10-04', '2017-10-20', '', '', 2, 2, 1, 45211, 'Pedro Riverea'),
(28, 'Proyecto reiniciado', '2017-10-05', '2017-10-27', '', '', 1, 2, 1, 345678, 'Maria Riverae'),
(29, 'Proyecto 2008', '2017-10-13', '2017-10-28', 'Santa Ana', '', 2, 2, 1, 345678, 'Oscar Madrid');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD PRIMARY KEY (`codProyecto`),
  ADD KEY `fk_tblProyectos_tiposProyectos1_idx` (`codTipoProyecto`),
  ADD KEY `fk_tblProyectos_tblEstados1_idx` (`codEstado`),
  ADD KEY `fk_tblProyectos_tblUsuarios1_idx` (`codUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblproyectos`
--
ALTER TABLE `tblproyectos`
  MODIFY `codProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD CONSTRAINT `fk_tblProyectos_tiposProyectos1` FOREIGN KEY (`codTipoProyecto`) REFERENCES `tiposproyectos` (`codTiposProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
