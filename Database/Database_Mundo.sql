-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2017 at 09:07 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Database_Mundo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblBitacora`
--

CREATE TABLE `tblBitacora` (
  `codOperacion` int(10) NOT NULL,
  `Operacion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `codUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblComentarios`
--

CREATE TABLE `tblComentarios` (
  `codComentario` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `comentario` varchar(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `codTarea` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblDesembolsos`
--

CREATE TABLE `tblDesembolsos` (
  `codDesembolso` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `codPatrocinio` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblEstados`
--

CREATE TABLE `tblEstados` (
  `codEstado` int(10) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblPatrocinadores`
--

CREATE TABLE `tblPatrocinadores` (
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
-- Table structure for table `tblPatrocinadoresxProyectos`
--

CREATE TABLE `tblPatrocinadoresxProyectos` (
  `codigo` int(10) NOT NULL,
  `codPatrocinador` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblPatrocinios`
--

CREATE TABLE `tblPatrocinios` (
  `codigo` int(10) NOT NULL,
  `tipoPatrocinio` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `fecha` date NOT NULL,
  `valor` double NOT NULL,
  `codPatrocinador` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblProyectos`
--

CREATE TABLE `tblProyectos` (
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
-- Table structure for table `tblTareas`
--

CREATE TABLE `tblTareas` (
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
-- Table structure for table `tblTiposProyectos`
--

CREATE TABLE `tblTiposProyectos` (
  `codTiposProyectos` int(11) NOT NULL,
  `tipoProyecto` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblTipoUsuario`
--

CREATE TABLE `tblTipoUsuario` (
  `codTipoUsuario` int(10) NOT NULL,
  `tipo_usuario` varchar(20) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUsuarios`
--

CREATE TABLE `tblUsuarios` (
  `codUsuario` int(10) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `nacimiento` date NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `cargo` varchar(45) NOT NULL,
  `codTipoUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUsuarioxProyecto`
--

CREATE TABLE `tblUsuarioxProyecto` (
  `codUsuarioxProyecto` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblUsuarioxTarea`
--

CREATE TABLE `tblUsuarioxTarea` (
  `codigo` int(10) NOT NULL,
  `codTarea` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblBitacora`
--
ALTER TABLE `tblBitacora`
  ADD PRIMARY KEY (`codOperacion`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indexes for table `tblComentarios`
--
ALTER TABLE `tblComentarios`
  ADD PRIMARY KEY (`codComentario`),
  ADD KEY `codUsuario` (`codUsuario`,`codTarea`),
  ADD KEY `tblComentarios_ibfk_2` (`codTarea`);

--
-- Indexes for table `tblDesembolsos`
--
ALTER TABLE `tblDesembolsos`
  ADD PRIMARY KEY (`codDesembolso`),
  ADD KEY `codPatrocinio` (`codPatrocinio`,`codProyecto`),
  ADD KEY `tblDesembolsos_ibfk_2` (`codProyecto`);

--
-- Indexes for table `tblEstados`
--
ALTER TABLE `tblEstados`
  ADD PRIMARY KEY (`codEstado`);

--
-- Indexes for table `tblPatrocinadores`
--
ALTER TABLE `tblPatrocinadores`
  ADD PRIMARY KEY (`codPatrocinador`);

--
-- Indexes for table `tblPatrocinadoresxProyectos`
--
ALTER TABLE `tblPatrocinadoresxProyectos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codPatrocinador` (`codPatrocinador`,`codProyecto`),
  ADD KEY `tblPatrocinadoresxProyectos_ibfk_2` (`codProyecto`);

--
-- Indexes for table `tblPatrocinios`
--
ALTER TABLE `tblPatrocinios`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codPatrocinador` (`codPatrocinador`);

--
-- Indexes for table `tblProyectos`
--
ALTER TABLE `tblProyectos`
  ADD PRIMARY KEY (`codProyecto`),
  ADD KEY `codTipoProyecto` (`codTipoProyecto`,`codEstado`,`codUsuario`),
  ADD KEY `tblProyectos_ibfk_2` (`codEstado`),
  ADD KEY `tblProyectos_ibfk_3` (`codUsuario`);

--
-- Indexes for table `tblTareas`
--
ALTER TABLE `tblTareas`
  ADD PRIMARY KEY (`codTarea`),
  ADD KEY `codProyecto` (`codProyecto`);

--
-- Indexes for table `tblTiposProyectos`
--
ALTER TABLE `tblTiposProyectos`
  ADD PRIMARY KEY (`codTiposProyectos`);

--
-- Indexes for table `tblTipoUsuario`
--
ALTER TABLE `tblTipoUsuario`
  ADD PRIMARY KEY (`codTipoUsuario`);

--
-- Indexes for table `tblUsuarios`
--
ALTER TABLE `tblUsuarios`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `codTipoUsuario` (`codTipoUsuario`);

--
-- Indexes for table `tblUsuarioxProyecto`
--
ALTER TABLE `tblUsuarioxProyecto`
  ADD PRIMARY KEY (`codUsuarioxProyecto`),
  ADD KEY `codUsuario` (`codUsuario`,`codProyecto`),
  ADD KEY `tblUsuarioxProyecto_ibfk_2` (`codProyecto`);

--
-- Indexes for table `tblUsuarioxTarea`
--
ALTER TABLE `tblUsuarioxTarea`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codTarea` (`codTarea`,`codUsuario`),
  ADD KEY `tblUsuarioxTarea_ibfk_2` (`codUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblUsuarios`
--
ALTER TABLE `tblUsuarios`
  MODIFY `codUsuario` int(10) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblBitacora`
--
ALTER TABLE `tblBitacora`
  ADD CONSTRAINT `tblBitacora_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblUsuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblComentarios`
--
ALTER TABLE `tblComentarios`
  ADD CONSTRAINT `tblComentarios_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblUsuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblComentarios_ibfk_2` FOREIGN KEY (`codTarea`) REFERENCES `tblTareas` (`codTarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblDesembolsos`
--
ALTER TABLE `tblDesembolsos`
  ADD CONSTRAINT `tblDesembolsos_ibfk_1` FOREIGN KEY (`codPatrocinio`) REFERENCES `tblPatrocinios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblDesembolsos_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblProyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblPatrocinadoresxProyectos`
--
ALTER TABLE `tblPatrocinadoresxProyectos`
  ADD CONSTRAINT `tblPatrocinadoresxProyectos_ibfk_1` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblPatrocinadores` (`codPatrocinador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblPatrocinadoresxProyectos_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblProyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblPatrocinios`
--
ALTER TABLE `tblPatrocinios`
  ADD CONSTRAINT `tblPatrocinios_ibfk_1` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblPatrocinadores` (`codPatrocinador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblProyectos`
--
ALTER TABLE `tblProyectos`
  ADD CONSTRAINT `tblProyectos_ibfk_1` FOREIGN KEY (`codTipoProyecto`) REFERENCES `tblTiposProyectos` (`codTiposProyectos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblProyectos_ibfk_2` FOREIGN KEY (`codEstado`) REFERENCES `tblEstados` (`codEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblProyectos_ibfk_3` FOREIGN KEY (`codUsuario`) REFERENCES `tblUsuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblTareas`
--
ALTER TABLE `tblTareas`
  ADD CONSTRAINT `tblTareas_ibfk_1` FOREIGN KEY (`codProyecto`) REFERENCES `tblProyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblUsuarios`
--
ALTER TABLE `tblUsuarios`
  ADD CONSTRAINT `tblUsuarios_ibfk_1` FOREIGN KEY (`codTipoUsuario`) REFERENCES `tblTipoUsuario` (`codTipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblUsuarioxProyecto`
--
ALTER TABLE `tblUsuarioxProyecto`
  ADD CONSTRAINT `tblUsuarioxProyecto_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblUsuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblUsuarioxProyecto_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblProyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblUsuarioxTarea`
--
ALTER TABLE `tblUsuarioxTarea`
  ADD CONSTRAINT `tblUsuarioxTarea_ibfk_1` FOREIGN KEY (`codTarea`) REFERENCES `tblTareas` (`codTarea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblUsuarioxTarea_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tblUsuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
