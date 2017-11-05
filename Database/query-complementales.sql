-- Estados de la base de datos:
INSERT INTO `tblestados` (`codEstado`, `estado`) VALUES (NULL, 'Pendiente'), (NULL, 'Proceso');
INSERT INTO `tblestados` (`codEstado`, `estado`) VALUES (NULL, 'Terminado'), (NULL, 'suspendido');

-- Tipos de proyecto
INSERT INTO `tbltiposproyectos` (`codTiposProyecto`, `tipoProyecto`, `descripcion`) 
VALUES  (NULL, 'Social y comunitario', ''),
        (NULL, 'Infraestructura', ''), 
        (NULL, 'Salud y medicinas', ''), 
        (NULL, 'Educacion', '');

-- Tabla de patrocinadores
--Agregando campo direccion
ALTER TABLE `tblpatrocinadores` ADD `direccion` TEXT NOT NULL AFTER `telefonoContacto`;

--Tabla proyectos
-- cambiando tipo de datos en campo descripcion
ALTER TABLE `tblproyectos` CHANGE `descripcion` `descripcion` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

-- tabla de usuarios
-- agregar el campo estado
ALTER TABLE `tblusuarios` ADD `estado` INT(5) NOT NULL AFTER `codTipoUsuario`;
-- agregar campo departamento
ALTER TABLE `tblusuarios` ADD `departamento` VARCHAR(35) NOT NULL AFTER `estado`;

-- tabla usuariosxproyecto
ALTER TABLE `tblusuarioxproyecto` ADD `rol` VARCHAR(25) NOT NULL AFTER `codProyecto`;

-- renombrar tabla patrocinadoresxproyecto
RENAME TABLE `mundo`.`tblpatrocinadoresxproyectos` TO `mundo`.`tblpatrocinadoresxproyecto`;


-- agregar campo en tabla de desembolsos y tabla bitacora
ALTER TABLE `tbldesembolsos` ADD `codPatrocinador` INT(15) NOT NULL AFTER `codProyecto`;
ALTER TABLE `tblbitacora` ADD `descripcion` TEXT NOT NULL AFTER `codUsuario`, ADD `fecha` DATE NOT NULL AFTER `descripcion`;