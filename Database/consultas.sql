


SELECT A.codigo, A.codPatrocinador, A.CodProyecto, B.nombre from 
tblpatrocinadoresxproyecto A inner join tblpatrocinadores B on A.codPatrocinador = B.codPatrocinador
where A.codProyecto = 1


Select A.codProyecto, A.nombreProyecto, A.fechaInicio, A.fechafinal, A.lugar, A.descripcion, A.beneficiario, .B.estado, 
A.costoEstimado, C.nombreUsuario, D.tipoProyecto, B.codEstado FROM tblProyectos A 
inner join tblestados B on A.codEstado = B.codEstado 
inner join tblusuarios C on A.codUsuario = C.codUsuario 
inner join tiposproyectos D on A.codTipoProyecto = D.codTiposProyecto
where A.codProyecto = 1

Select A.codProyecto, A.nombreProyecto, A.fechaInicio, A.fechafinal, A.lugar, A.descripcion, A.beneficiario,
			    B.estado, A.costoEstimado, 
			    C.nombreUsuario, 
			    D.tipoProyecto 
			FROM tblProyectos A 
			inner join tblestados B on A.codEstado = B.codEstado 
			inner join tblusuarios C on A.codUsuario = C.codUsuario 
			inner join tiposproyectos D on A.codTipoProyecto = D.codTiposProyecto
			 where A.codProyecto = 1

select  a.nombreUsuario, b.Rol FROM tblusuarios a 
inner join tblusuarioxproyecto b on a.codUsuario = b.codUsuario 
inner join tbltipousuario c on a.codTipoUsuario = c.codTipoUsuario 
WHERE b.Rol = 'n/a' and b.codProyecto = 1

Asignar un rol a un usuario de un proyecto
	update tblusuarioxproyecto set Rol = "practicante" where codUsuario = 4 and codProyecto = 1






	//consulta a la tabla patrocinador agregando el campo direccion
	ALTER TABLE tblpatrocinadores ADD direccion VARCHAR(150) NOT NULL ;

//CAMBIAR LOGINTUD DE CAMPO TIPO patrocinador
ALTER TABLE `tblpatrocinadores` CHANGE `tipoPatrocinador` `tipoPatrocinador` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

	//consultar la información de un patrocinador especifico
	SELECT codPatrocinador, nombre, tipoPatrocinador, lugarProcedencia, correoElectronico, nombreContacto,
	 telefonoContacto, direccion FROM tblpatrocinadores WHERE codPatrocinador = ".$codigoPatrocinador;

	//Insert de un nuevo patrocinador

	INSERT INTO tblpatrocinadores (nombre, tipoPatrocinador, lugarProcedencia, 
	correoElectronico, nombreContacto, telefonoContacto, direccion) VALUES ();

	//update de un patrocinador
	UPDATE tblpatrocinadores SET codPatrocinador=[value-1],nombre=[value-2],tipoPatrocinador=[value-3],
	lugarProcedencia=[value-4],correoElectronico=[value-5],nombreContacto=[value-6],
	telefonoContacto=[value-7],direccion=[value-8] WHERE codPatrocinador = ".$codigoPatrocinador;

	//consulta de los patrocionios 
	SELECT codigo, tipoPatrocinio, descripcion, fecha, valor, codPatrocinador FROM tblpatrocinios
	 WHERE codPatrocinio = ".$codigoPatrocinio;

	//Insert de un nuevo patrocionio
	INSERT INTO tblpatrocinios (codigo, tipoPatrocinio, descripcion, fecha, valor, codPatrocinador) 
	VALUES ();


	//Consulta de los todos los desembolsos
	SELECT codDesembolso, fecha, valor, codPatrocinio, codProyecto FROM tbldesembolsos 
	WHERE codDesembolso = ".$codigoDesembolso;

	//Insert de un nuevo desembolsos
	INSERT INTO tbldesembolsos (codDesembolso, fecha, valor, codPatrocinio, codProyecto) 
	VALUES ();
	

INSERT INTO `tblpatrocinios` (`codigo`, `tipoPatrocinio`, `descripcion`, `fecha`, `valor`, `codPatrocinador`) 
VALUES (NULL, 'Economico', NULL, '2017-10-04', '200', '1');


//Se agrego dos columnas en la tabla bitacora
ALTER TABLE tblbitacora ADD descripcion VARCHAR(150) NOT NULL AFTER codUsuario,
 ADD fecha DATE NOT NULL AFTER descripcion;

-- cambios el 30 de octubre
 RENAME TABLE `mundo`.`tbltiposproyectos` TO `mundo`.`tiposproyectos`;
 ALTER TABLE `tiposproyectos` CHANGE `codTiposProyectos` `codTiposProyecto` INT(11) NOT NULL;

-- seleciona los proyectos patrocinados por un patrocinador
select a.codigo, a.codProyecto, b.nombreProyecto from tblpatrocinadoresxproyecto a
inner join tblproyectos b on a.codProyecto = b.codProyecto
where a.codPatrocinador = 1

