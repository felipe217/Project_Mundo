-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 05:06 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mundo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbitacora`
--

CREATE TABLE `tblbitacora` (
  `codOperacion` int(10) NOT NULL,
  `Operacion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `codUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblcomentarios`
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
-- Table structure for table `tbldesembolsos`
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
-- Table structure for table `tblestados`
--

CREATE TABLE `tblestados` (
  `codEstado` int(10) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblpatrocinadores`
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
-- Table structure for table `tblpatrocinadoresxproyectos`
--

CREATE TABLE `tblpatrocinadoresxproyectos` (
  `codigo` int(10) NOT NULL,
  `codPatrocinador` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblpatrocinios`
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
-- Table structure for table `tblproyectos`
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
-- Table structure for table `tbltareas`
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
-- Table structure for table `tbltiposproyectos`
--

CREATE TABLE `tbltiposproyectos` (
  `codTiposProyectos` int(11) NOT NULL,
  `tipoProyecto` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbltipousuario`
--

CREATE TABLE `tbltipousuario` (
  `codTipoUsuario` int(10) NOT NULL,
  `tipo_usuario` varchar(20) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbltipousuario`
--

INSERT INTO `tbltipousuario` (`codTipoUsuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Voluntario');

-- --------------------------------------------------------

--
-- Table structure for table `tblusuarios`
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

--
-- Dumping data for table `tblusuarios`
--

INSERT INTO `tblusuarios` (`codUsuario`, `identificacion`, `nombres`, `apellidos`, `nacimiento`, `domicilio`, `pais`, `cargo`, `usuario`, `contrasena`, `codTipoUsuario`) VALUES
(5, '1234', 'k', 'k', '1990-11-11', 'k', 'Argentina', 'Voluntario', 'k', '13fbd79c3d390e5d6585a21e11ff5ec1970cff0c', 2),
(6, '1111-2222-32568', 'KELVIN FELIPE', 'ALVAREZ CABRERA', '2017-10-03', 'ALEMANIA', 'Honduras', 'Voluntario', 'felipe.al', 'b41e9b8dd61267c8eb3db48acfda473f53d9964b', 2),
(7, '1111-2222-32568', 'MARCCIO', 'BARRERA', '2017-10-11', 'ALEMANIA', 'El salvador', 'Voluntario', 'felipe.al', 'f9aca9fb84cee1f117a742e47ee30540dc7ab110', 2),
(8, '6666-6666-66666', 'admin', 'sys', '2017-10-05', 'HOUSE', 'Guatemala', 'Voluntario', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(9, '1111-2222-32568', 'user', 'user', '2017-10-06', 'ALEMANIA', 'Argentina', 'Voluntario', 'user', '12dea96fec20593566ab75692c9949596833adc9', 2),
(10, '1111-2222-32568', 'asquito', 'asquito', '2017-10-02', 'HOUSE', 'Guatemala', 'Administrador', 'asquito', '3fb4379ccc26c7b7bde966b1735cc2a6d8ac1bc1', 1),
(11, '1111-2222-32568', 'qaz', 'qaz', '2017-10-04', 'ALEMANIA', 'Argentina', 'Administrador', 'qaz', '7c286a779653e0c1d9cbc2b9c772fbea7033e452', 1),
(12, '1111-2222-32568', 'qwe', 'qwe', '2017-08-11', 'qwe', 'El salvador', 'Administrador', 'qwe', '056eafe7cf52220de2df36845b8ed170c67e23e3', 1),
(13, '', '', '', '0000-00-00', '', 'Seleciona un paÃ­s', 'Selecciona uno', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusuarioxproyecto`
--

CREATE TABLE `tblusuarioxproyecto` (
  `codUsuarioxProyecto` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblusuarioxtarea`
--

CREATE TABLE `tblusuarioxtarea` (
  `codigo` int(10) NOT NULL,
  `codTarea` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbitacora`
--
ALTER TABLE `tblbitacora`
  ADD PRIMARY KEY (`codOperacion`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indexes for table `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  ADD PRIMARY KEY (`codComentario`),
  ADD KEY `codUsuario` (`codUsuario`,`codTarea`),
  ADD KEY `tblComentarios_ibfk_2` (`codTarea`);

--
-- Indexes for table `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  ADD PRIMARY KEY (`codDesembolso`),
  ADD KEY `codPatrocinio` (`codPatrocinio`,`codProyecto`),
  ADD KEY `tblDesembolsos_ibfk_2` (`codProyecto`);

--
-- Indexes for table `tblestados`
--
ALTER TABLE `tblestados`
  ADD PRIMARY KEY (`codEstado`);

--
-- Indexes for table `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  ADD PRIMARY KEY (`codPatrocinador`);

--
-- Indexes for table `tblpatrocinadoresxproyectos`
--
ALTER TABLE `tblpatrocinadoresxproyectos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codPatrocinador` (`codPatrocinador`,`codProyecto`),
  ADD KEY `tblPatrocinadoresxProyectos_ibfk_2` (`codProyecto`);

--
-- Indexes for table `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codPatrocinador` (`codPatrocinador`);

--
-- Indexes for table `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD PRIMARY KEY (`codProyecto`),
  ADD KEY `codTipoProyecto` (`codTipoProyecto`,`codEstado`,`codUsuario`),
  ADD KEY `tblProyectos_ibfk_2` (`codEstado`),
  ADD KEY `tblProyectos_ibfk_3` (`codUsuario`);

--
-- Indexes for table `tbltareas`
--
ALTER TABLE `tbltareas`
  ADD PRIMARY KEY (`codTarea`),
  ADD KEY `codProyecto` (`codProyecto`);

--
-- Indexes for table `tbltiposproyectos`
--
ALTER TABLE `tbltiposproyectos`
  ADD PRIMARY KEY (`codTiposProyectos`);

--
-- Indexes for table `tbltipousuario`
--
ALTER TABLE `tbltipousuario`
  ADD PRIMARY KEY (`codTipoUsuario`);

--
-- Indexes for table `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `codTipoUsuario` (`codTipoUsuario`);

--
-- Indexes for table `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  ADD PRIMARY KEY (`codUsuarioxProyecto`),
  ADD KEY `codUsuario` (`codUsuario`,`codProyecto`),
  ADD KEY `tblUsuarioxProyecto_ibfk_2` (`codProyecto`);

--
-- Indexes for table `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `codTarea` (`codTarea`,`codUsuario`),
  ADD KEY `tblUsuarioxTarea_ibfk_2` (`codUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `codUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbitacora`
--
ALTER TABLE `tblbitacora`
  ADD CONSTRAINT `tblBitacora_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  ADD CONSTRAINT `tblComentarios_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblComentarios_ibfk_2` FOREIGN KEY (`codTarea`) REFERENCES `tbltareas` (`codTarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  ADD CONSTRAINT `tblDesembolsos_ibfk_1` FOREIGN KEY (`codPatrocinio`) REFERENCES `tblpatrocinios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblDesembolsos_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblpatrocinadoresxproyectos`
--
ALTER TABLE `tblpatrocinadoresxproyectos`
  ADD CONSTRAINT `tblPatrocinadoresxProyectos_ibfk_1` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblpatrocinadores` (`codPatrocinador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblPatrocinadoresxProyectos_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  ADD CONSTRAINT `tblPatrocinios_ibfk_1` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblpatrocinadores` (`codPatrocinador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD CONSTRAINT `tblProyectos_ibfk_1` FOREIGN KEY (`codTipoProyecto`) REFERENCES `tbltiposproyectos` (`codTiposProyectos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblProyectos_ibfk_2` FOREIGN KEY (`codEstado`) REFERENCES `tblestados` (`codEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblProyectos_ibfk_3` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltareas`
--
ALTER TABLE `tbltareas`
  ADD CONSTRAINT `tblTareas_ibfk_1` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD CONSTRAINT `tblUsuarios_ibfk_1` FOREIGN KEY (`codTipoUsuario`) REFERENCES `tbltipousuario` (`codTipoUsuario`);

--
-- Constraints for table `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  ADD CONSTRAINT `tblUsuarioxProyecto_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblUsuarioxProyecto_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  ADD CONSTRAINT `tblUsuarioxTarea_ibfk_1` FOREIGN KEY (`codTarea`) REFERENCES `tbltareas` (`codTarea`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblUsuarioxTarea_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
