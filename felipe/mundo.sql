-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2017 at 03:20 AM
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

--
-- Dumping data for table `tbldesembolsos`
--

INSERT INTO `tbldesembolsos` (`codDesembolso`, `fecha`, `valor`, `codPatrocinio`, `codProyecto`) VALUES
(4, '2017-10-31', 400, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbldocumentos`
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
-- Dumping data for table `tbldocumentos`
--

INSERT INTO `tbldocumentos` (`codDocumento`, `nombre`, `descripcion`, `url`, `codProyecto`, `codUsuario`, `fecha`) VALUES
(1, 'Documento de prueba', 'Documento para prueba', 'docs/doc1.pdf', 3, 1, '2017-11-01'),
(2, 'Documento de prueba 2', 'Docuemtno de prueba 2', 'docs/doc.pdf', 3, 1, '2017-10-19'),
(6, 'Archivo 41', 'ninguna', 'docs/archivo4.pdf', 3, 1, '2017-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `tblestados`
--

CREATE TABLE `tblestados` (
  `codEstado` int(10) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblestados`
--

INSERT INTO `tblestados` (`codEstado`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Proceso'),
(3, 'Terminado'),
(4, 'suspendido');

-- --------------------------------------------------------

--
-- Table structure for table `tblmateriales`
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
-- Dumping data for table `tblmateriales`
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
(15, '2017-10-17', 'Juan carlos', 'Impresora multifuncional', 2, 2344, 4688, 6),
(16, '2017-10-04', 'Comercial El Rosario', 'Mochila super', 50, 120, 6000, 3);

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
  `telefonoContacto` varchar(45) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpatrocinadores`
--

INSERT INTO `tblpatrocinadores` (`codPatrocinador`, `nombre`, `tipoPatrocinador`, `lugarProcedencia`, `correoElectronico`, `nombreContacto`, `telefonoContacto`, `direccion`) VALUES
(1, 'ONG internacional', 'Organizacion no gubernamental', 'Estados Unidos', 'juana@gmail.com', 'Juana Maria Rivera', '2233-7788', 'Colonia lomas del guijarro casa 1239'),
(2, 'World vision Honduras', 'Organizacion no gubernamental', 'Europa', 'sergi.pena@gmail.com', 'Sergio peÃ±a', '9988-7766', 'Colonia Loma linda, San Pedro Sula');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatrocinadoresxproyecto`
--

CREATE TABLE `tblpatrocinadoresxproyecto` (
  `codigo` int(10) NOT NULL,
  `codPatrocinador` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpatrocinadoresxproyecto`
--

INSERT INTO `tblpatrocinadoresxproyecto` (`codigo`, `codPatrocinador`, `codProyecto`) VALUES
(3, 1, 3),
(4, 2, 3);

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

--
-- Dumping data for table `tblpatrocinios`
--

INSERT INTO `tblpatrocinios` (`codigo`, `tipoPatrocinio`, `descripcion`, `fecha`, `valor`, `codPatrocinador`) VALUES
(1, 'Economico', ' Contribucion en cuenta', '2017-10-05', 5000, 1),
(2, 'Economico', ' Deposito en cuenta', '2017-10-04', 1200.5, 1);

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
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `codTipoProyecto` int(10) NOT NULL,
  `codEstado` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `costoEstimado` double NOT NULL,
  `beneficiario` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblproyectos`
--

INSERT INTO `tblproyectos` (`codProyecto`, `nombreProyecto`, `fechaInicio`, `fechaFinal`, `lugar`, `descripcion`, `codTipoProyecto`, `codEstado`, `codUsuario`, `costoEstimado`, `beneficiario`) VALUES
(3, 'Proyecto de mochilas', '2017-09-01', '2017-09-15', 'Distrito Central', 'Escribir una pequeÃ±a descripcion del proyecto en cuestion', 4, 1, 1, 20800, 'Escuela Honduras');

-- --------------------------------------------------------

--
-- Table structure for table `tbltareas`
--

CREATE TABLE `tbltareas` (
  `codTarea` int(10) NOT NULL,
  `nombreTarea` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(500) CHARACTER SET latin1 NOT NULL,
  `prioridad` varchar(30) CHARACTER SET latin1 NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaEntrega` date NOT NULL,
  `codProyecto` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbltareas`
--

INSERT INTO `tbltareas` (`codTarea`, `nombreTarea`, `descripcion`, `prioridad`, `fechaInicio`, `fechaEntrega`, `codProyecto`) VALUES
(1, 'Cotizacion de materiales', 'Cotizar todos los materiales que iran en cada mochila', 'ALTA', '2017-09-01', '2017-09-05', 3);

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
(2, 'Voluntario'),
(3, 'Empleado');

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
  `codTipoUsuario` int(50) NOT NULL,
  `estado` int(5) NOT NULL,
  `departamento` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblusuarios`
--

INSERT INTO `tblusuarios` (`codUsuario`, `identificacion`, `nombres`, `apellidos`, `nacimiento`, `domicilio`, `pais`, `cargo`, `usuario`, `contrasena`, `codTipoUsuario`, `estado`, `departamento`) VALUES
(1, '', 'Administrador', '', '2017-10-01', '', '', '', 'admin', 'admin', 1, 1, ''),
(2, '0801-1990-12345', 'Maria Juana', 'Cruz Perez', '1990-04-06', '', '', 'Gerente', 'MJCruz', '123', 3, 1, 'Proyectos'),
(3, '4454545778', 'qwerty', 'qwerty', '2017-11-16', 'qwerty', 'El salvador', '', 'qwerty', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1, 0, ''),
(4, '343132423424', 'qaz', 'qaz', '2017-11-16', 'qeqeqweq', 'El salvador', '', 'qaz', '7c286a779653e0c1d9cbc2b9c772fbea7033e452', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblusuarioxproyecto`
--

CREATE TABLE `tblusuarioxproyecto` (
  `codUsuarioxProyecto` int(10) NOT NULL,
  `codUsuario` int(10) NOT NULL,
  `codProyecto` int(10) NOT NULL,
  `rol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblusuarioxproyecto`
--

INSERT INTO `tblusuarioxproyecto` (`codUsuarioxProyecto`, `codUsuario`, `codProyecto`, `rol`) VALUES
(1, 2, 3, 'Manager');

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
-- Dumping data for table `tblusuarioxtarea`
--

INSERT INTO `tblusuarioxtarea` (`codigo`, `codTarea`, `codUsuario`) VALUES
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tiposproyectos`
--

CREATE TABLE `tiposproyectos` (
  `codTiposProyecto` int(11) NOT NULL,
  `tipoProyecto` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tiposproyectos`
--

INSERT INTO `tiposproyectos` (`codTiposProyecto`, `tipoProyecto`, `descripcion`) VALUES
(1, 'Social y comunitario', ''),
(2, 'Infraestructura', ''),
(3, 'Salud y medicinas', ''),
(4, 'Educacion', '');

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
-- Indexes for table `tbldocumentos`
--
ALTER TABLE `tbldocumentos`
  ADD PRIMARY KEY (`codDocumento`);

--
-- Indexes for table `tblestados`
--
ALTER TABLE `tblestados`
  ADD PRIMARY KEY (`codEstado`);

--
-- Indexes for table `tblmateriales`
--
ALTER TABLE `tblmateriales`
  ADD PRIMARY KEY (`codMaterial`),
  ADD KEY `fk_tblMateriales_tblProyectos1_idx` (`codProyecto`);

--
-- Indexes for table `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  ADD PRIMARY KEY (`codPatrocinador`);

--
-- Indexes for table `tblpatrocinadoresxproyecto`
--
ALTER TABLE `tblpatrocinadoresxproyecto`
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
-- Indexes for table `tiposproyectos`
--
ALTER TABLE `tiposproyectos`
  ADD PRIMARY KEY (`codTiposProyecto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbitacora`
--
ALTER TABLE `tblbitacora`
  MODIFY `codOperacion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  MODIFY `codComentario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  MODIFY `codDesembolso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbldocumentos`
--
ALTER TABLE `tbldocumentos`
  MODIFY `codDocumento` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblestados`
--
ALTER TABLE `tblestados`
  MODIFY `codEstado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblmateriales`
--
ALTER TABLE `tblmateriales`
  MODIFY `codMaterial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblpatrocinadores`
--
ALTER TABLE `tblpatrocinadores`
  MODIFY `codPatrocinador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpatrocinadoresxproyecto`
--
ALTER TABLE `tblpatrocinadoresxproyecto`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblproyectos`
--
ALTER TABLE `tblproyectos`
  MODIFY `codProyecto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbltareas`
--
ALTER TABLE `tbltareas`
  MODIFY `codTarea` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbltipousuario`
--
ALTER TABLE `tbltipousuario`
  MODIFY `codTipoUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `codUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  MODIFY `codUsuarioxProyecto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  MODIFY `codigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiposproyectos`
--
ALTER TABLE `tiposproyectos`
  MODIFY `codTiposProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbitacora`
--
ALTER TABLE `tblbitacora`
  ADD CONSTRAINT `tblbitacora_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`);

--
-- Constraints for table `tblcomentarios`
--
ALTER TABLE `tblcomentarios`
  ADD CONSTRAINT `tblcomentarios_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`),
  ADD CONSTRAINT `tblcomentarios_ibfk_2` FOREIGN KEY (`codTarea`) REFERENCES `tbltareas` (`codTarea`);

--
-- Constraints for table `tbldesembolsos`
--
ALTER TABLE `tbldesembolsos`
  ADD CONSTRAINT `tbldesembolsos_ibfk_1` FOREIGN KEY (`codPatrocinio`) REFERENCES `tblpatrocinios` (`codigo`),
  ADD CONSTRAINT `tbldesembolsos_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`);

--
-- Constraints for table `tblpatrocinadoresxproyecto`
--
ALTER TABLE `tblpatrocinadoresxproyecto`
  ADD CONSTRAINT `tblpatrocinadoresxproyecto_ibfk_1` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`),
  ADD CONSTRAINT `tblpatrocinadoresxproyecto_ibfk_2` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblpatrocinadores` (`codPatrocinador`);

--
-- Constraints for table `tblpatrocinios`
--
ALTER TABLE `tblpatrocinios`
  ADD CONSTRAINT `tblpatrocinios_ibfk_1` FOREIGN KEY (`codPatrocinador`) REFERENCES `tblpatrocinadores` (`codPatrocinador`);

--
-- Constraints for table `tblproyectos`
--
ALTER TABLE `tblproyectos`
  ADD CONSTRAINT `tblproyectos_ibfk_1` FOREIGN KEY (`codTipoProyecto`) REFERENCES `tiposproyectos` (`codTiposProyecto`),
  ADD CONSTRAINT `tblproyectos_ibfk_2` FOREIGN KEY (`codEstado`) REFERENCES `tblestados` (`codEstado`),
  ADD CONSTRAINT `tblproyectos_ibfk_3` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`);

--
-- Constraints for table `tbltareas`
--
ALTER TABLE `tbltareas`
  ADD CONSTRAINT `tbltareas_ibfk_1` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`);

--
-- Constraints for table `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD CONSTRAINT `tblusuarios_ibfk_1` FOREIGN KEY (`codTipoUsuario`) REFERENCES `tbltipousuario` (`codTipoUsuario`);

--
-- Constraints for table `tblusuarioxproyecto`
--
ALTER TABLE `tblusuarioxproyecto`
  ADD CONSTRAINT `tblusuarioxproyecto_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`),
  ADD CONSTRAINT `tblusuarioxproyecto_ibfk_2` FOREIGN KEY (`codProyecto`) REFERENCES `tblproyectos` (`codProyecto`);

--
-- Constraints for table `tblusuarioxtarea`
--
ALTER TABLE `tblusuarioxtarea`
  ADD CONSTRAINT `tblusuarioxtarea_ibfk_1` FOREIGN KEY (`codTarea`) REFERENCES `tbltareas` (`codTarea`),
  ADD CONSTRAINT `tblusuarioxtarea_ibfk_2` FOREIGN KEY (`codUsuario`) REFERENCES `tblusuarios` (`codUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
