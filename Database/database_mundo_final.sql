-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2017 a las 22:21:37
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Estructura de tabla para la tabla `tblbitacora`
--

CREATE TABLE `tblbitacora` (
  `codOperacion` int(10) NOT NULL,
  `Operacion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `codUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcomentarios`
--

CREATE TABLE `tblcomentarios` (
  `codComentario` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `comentario` varchar(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `codTarea` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldesembolsos`
--

CREATE TABLE `tbldesembolsos` (
  `codDesembolso` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `codPatrocinio` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblestados`
--

CREATE TABLE `tblestados` (
  `codEstado` int(10) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpatrocinadores`
--

CREATE TABLE `tblpatrocinadores` (
  `codPatrocinador` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipoPatrocinador` varchar(45) NOT NULL,
  `lugarProcedencia` varchar(45) NOT NULL,
  `correoElectronico` varchar(45) NOT NULL,
  `nombreContacto` varchar(45) NOT NULL,
  `telefonoContacto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpatrocinadoresxproyectos`
--

CREATE TABLE `tblpatrocinadoresxproyectos` (
  `codigo` int(10) NOT NULL,
  `codPatrocinador` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpatrocinios`
--

CREATE TABLE `tblpatrocinios` (
  `codigo` int(10) NOT NULL,
  `tipoPatrocinio` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `codPatrocinador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproyectos`
--

CREATE TABLE `tblproyectos` (
  `codProyecto` int(10) NOT NULL,
  `nombreProyecto` varchar(45) CHARACTER SET latin1 NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `lugar` varchar(45) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `codTipoProyecto` int(10) NOT NULL,
  `codEstado` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `costoEstimado` double NOT NULL,
  `beneficiario` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltareas`
--

CREATE TABLE `tbltareas` (
  `codTarea` int(10) NOT NULL,
  `nombreTarea` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `prioridad` varchar(30) CHARACTER SET latin1 NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaEntrega` date NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltiposproyectos`
--

CREATE TABLE `tbltiposproyectos` (
  `codTiposProyectos` int(11) NOT NULL,
  `tipoProyecto` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltipousuario`
--

CREATE TABLE `tbltipousuario` (
  `codTipoUsuario` int(10) NOT NULL,
  `tipo_usuario` varchar(20) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbltipousuario`
--

INSERT INTO `tbltipousuario` (`codTipoUsuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Voluntario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `codUsuario` int(10) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `nacimiento` date NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `codTipoUsuario` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarioxproyecto`
--

CREATE TABLE `tblusuarioxproyecto` (
  `codUsuarioxProyecto` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarioxtarea`
--

CREATE TABLE `tblusuarioxtarea` (
  `codigo` int(10) NOT NULL,
  `codTarea` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblbitacora`
--
ALTER TABLE `tblbitacora`
  ADD PRIMARY KEY (`codOperacion`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indices de la tabla `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  ADD PRIMARY KEY (`codComentario`),
  ADD KEY `codUsuario` (`codUsuario`,`codTarea`),
  ADD KEY `tblComentarios_ibfk_2` (`codTarea`);

--
-- Indices de la tabla `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  ADD PRIMARY KEY (`codDesembolso`),
  ADD KEY `codPatrocinio` (`codPatrocinio`,`codProyecto`),
  ADD KEY `tblDesembolsos_ibfk_2` (`codProyecto`);

--
-- Indices de la tabla `tblestados`
--
ALTER TABLE `tblestados`
  ADD PRIMARY KEY (`codEstado`);

--
-- Indices de la tabla `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  ADD PRIMARY KEY (`codPatrocinador`);

--
-- Indices de la tabla `tblpatrocinadoresxproyectos`
--
ALTER TABLE `tblpatrocinadoresxproyectos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codPatrocinador` (`codPatrocinador`,`codProyecto`),
  ADD KEY `tblPatrocinadoresxProyectos_ibfk_2` (`codProyecto`);

--
-- Indices de la tabla `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codPatrocinador` (`codPatrocinador`);

--
-- Indices de la tabla `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD PRIMARY KEY (`codProyecto`),
  ADD KEY `codTipoProyecto` (`codTipoProyecto`,`codEstado`,`codUsuario`),
  ADD KEY `tblProyectos_ibfk_2` (`codEstado`),
  ADD KEY `tblProyectos_ibfk_3` (`codUsuario`);

--
-- Indices de la tabla `tbltareas`
--
ALTER TABLE `tbltareas`
  ADD PRIMARY KEY (`codTarea`),
  ADD KEY `codProyecto` (`codProyecto`);

--
-- Indices de la tabla `tbltiposproyectos`
--
ALTER TABLE `tbltiposproyectos`
  ADD PRIMARY KEY (`codTiposProyectos`);

--
-- Indices de la tabla `tbltipousuario`
--
ALTER TABLE `tbltipousuario`
  ADD PRIMARY KEY (`codTipoUsuario`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `codTipoUsuario` (`codTipoUsuario`);

--
-- Indices de la tabla `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  ADD PRIMARY KEY (`codUsuarioxProyecto`),
  ADD KEY `codUsuario` (`codUsuario`,`codProyecto`),
  ADD KEY `tblUsuarioxProyecto_ibfk_2` (`codProyecto`);

--
-- Indices de la tabla `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codTarea` (`codTarea`,`codUsuario`),
  ADD KEY `tblUsuarioxTarea_ibfk_2` (`codUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblbitacora`
--
ALTER TABLE `tblbitacora`
  MODIFY `codOperacion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  MODIFY `codComentario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  MODIFY `codDesembolso` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblestados`
--
ALTER TABLE `tblestados`
  MODIFY `codEstado` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  MODIFY `codPatrocinador` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblpatrocinadoresxproyectos`
--
ALTER TABLE `tblpatrocinadoresxproyectos`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblproyectos`
--
ALTER TABLE `tblproyectos`
  MODIFY `codProyecto` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbltareas`
--
ALTER TABLE `tbltareas`
  MODIFY `codTarea` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbltiposproyectos`
--
ALTER TABLE `tbltiposproyectos`
  MODIFY `codTiposProyectos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbltipousuario`
--
ALTER TABLE `tbltipousuario`
  MODIFY `codTipoUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `codUsuario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  MODIFY `codUsuarioxProyecto` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblbitacora`
--
ALTER TABLE `tblbitacora`
  ADD CONSTRAINT `tblbitacora_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`);

--
-- Filtros para la tabla `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  ADD CONSTRAINT `tblcomentarios_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`),
  ADD CONSTRAINT `tblcomentarios_ibfk_2` FOREIGN KEY (`codTarea`) REFERENCES `tbltareas` (`codTarea`);

--
-- Filtros para la tabla `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  ADD CONSTRAINT `tbldesembolsos_ibfk_1` FOREIGN KEY (`codPatrocinio`) REFERENCES `tblpatrocinios` (`codigo`),
  ADD CONSTRAINT `tbldesembolsos_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`);

--
-- Filtros para la tabla `tblpatrocinadoresxproyectos`
--
ALTER TABLE `tblpatrocinadoresxproyectos`
  ADD CONSTRAINT `tblpatrocinadoresxproyectos_ibfk_1` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`),
  ADD CONSTRAINT `tblpatrocinadoresxproyectos_ibfk_2` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblpatrocinadores` (`codPatrocinador`);

--
-- Filtros para la tabla `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  ADD CONSTRAINT `tblpatrocinios_ibfk_1` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblpatrocinadores` (`codPatrocinador`);

--
-- Filtros para la tabla `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD CONSTRAINT `tblproyectos_ibfk_1` FOREIGN KEY (`codTipoProyecto`) REFERENCES `tbltiposproyectos` (`codTiposProyectos`),
  ADD CONSTRAINT `tblproyectos_ibfk_2` FOREIGN KEY (`codEstado`) REFERENCES `tblestados` (`codEstado`),
  ADD CONSTRAINT `tblproyectos_ibfk_3` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`);

--
-- Filtros para la tabla `tbltareas`
--
ALTER TABLE `tbltareas`
  ADD CONSTRAINT `tbltareas_ibfk_1` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`);

--
-- Filtros para la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD CONSTRAINT `tblusuarios_ibfk_1` FOREIGN KEY (`codTipoUsuario`) REFERENCES `tbltipousuario` (`codTipoUsuario`);

--
-- Filtros para la tabla `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  ADD CONSTRAINT `tblusuarioxproyecto_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`),
  ADD CONSTRAINT `tblusuarioxproyecto_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`);

--
-- Filtros para la tabla `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  ADD CONSTRAINT `tblusuarioxtarea_ibfk_1` FOREIGN KEY (`codTarea`) REFERENCES `tbltareas` (`codTarea`),
  ADD CONSTRAINT `tblusuarioxtarea_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
