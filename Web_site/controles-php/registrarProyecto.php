<?php
	/* casos para este archivo:
		1. Registrar un proyecto
		2. Actualizar un proyecto
		3. eliminar un proyecto  
		4. Agregar un nuevo usuario a un proyecto
		5. Asignar un rol a un usuario de un proyecto */
	
	$caso = $_POST['caso'];

	/*"nombre=nombre&fechaInicio=fechaInicio&fechaFinal=fechafinal&lugar=lugar&costo=costo&beneficiario=beneficiario&codEstado=codEstado&codTipoProyecto=tipo&codUsuario=codUsuario"*/

	//importando las clases necesarias
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	//casos 
	switch ($caso) {
		//caso 1, registro de un nuevo proyecto
		case '1':
			//capturando los datos del proyecto
			$codigoProyecto = $_POST['codigoProyecto'];
			$nombreProyecto = $_POST['nombre'];
			$fechaInicio = $_POST['fechaInicio'];	
			$fechaFinal = $_POST['fechaFinal'];
			$lugar = $_POST['lugar'];
			$descripcion = $_POST['descripcion'];
			$costoEstimado = $_POST['costo'];
			$beneficiario = $_POST['beneficiario'];
			$estado = $_POST['codEstado'];
			$codTipoProyecto = $_POST['codTipoProyecto'];
			$codUsuario = $_POST['codUsuario'];
			$cadenaPatrocindores = $_POST['patrocinadores'];

				//consulta para registrar el proyecto
				$consulta = "INSERT INTO tblproyectos ("
				."codProyecto, "
				."nombreProyecto, "
				."fechaInicio, "
				."fechafinal, "
				."lugar, "
				."descripcion, "
				."codTipoProyecto, "
				."codEstado, "
				."codUsuario, "
				."costoEstimado," 
				."beneficiario"
			.") "

			."VALUES ( null ,"
						."'".$nombreProyecto."',"
						."'".$fechaInicio."'," 
						."'".$fechaFinal."',"
						."'".$lugar."',"
						."'".$descripcion."',"
						."'".$codTipoProyecto."',"
						."'".$estado."',"
						."'".$codUsuario."',"
						."'".$costoEstimado."',"
			."'".$beneficiario."');";
			//$consulta = $consulta." SELECT LAST_INSERT_ID() as codigo;";
			$resultado = $miConexion->ejecutarInstruccion($consulta);
			if ($resultado) {
				//capturar el valor del codigo asignado y utilizarlo parala nueva consulta´
				$consulta = " SELECT LAST_INSERT_ID() as codigo;";
				$resultado = $miConexion->ejecutarInstruccion($consulta);
				$fila = $miConexion->obtenerFila($resultado);
				$codigo = $fila['codigo']; 
				$miConexion->liberarResultado($resultado);
				//evaluar si existen patrocinadores seleccionados y crear los inserts para cada patrcinador
				$insertPatrocinadores = "";
				$arreglo = explode(",", $cadenaPatrocindores);
				if(count($arreglo) > 0){
					for($i=0; $i<count($arreglo); $i++){ 
						$insertPatrocinadores = 
						" insert into tblpatrocinadoresxproyecto (codPatrocinador, codProyecto) values (".$arreglo[$i]." , ".$codigo."); ";
						//registrar los patrocinadores del proyecto
						$resultado = $miConexion->ejecutarInstruccion($insertPatrocinadores);
					}
					if($resultado){
						echo "El proyecto y sus patrocinadores se registraron exitosamente.";
					} 
				}
			}else
				echo "Ocurrió un error, no se pudo registrar.";
				//echo "no se realizaó ningun registro: ".$consulta."y resultado: ".$resultado;
			break;

		//caso 2, actualizar un proyecto registrado
		case '2':
			//capturando los datos del proyecto
			$codigoProyecto = $_POST['codigoProyecto'];
			$nombreProyecto = $_POST['nombre'];
			$fechaInicio = $_POST['fechaInicio'];	
			$fechaFinal = $_POST['fechaFinal'];
			$lugar = $_POST['lugar'];
			$descripcion = $_POST['descripcion'];
			$costoEstimado = $_POST['costo'];
			$beneficiario = $_POST['beneficiario'];
			$estado = $_POST['codEstado'];
			$codTipoProyecto = $_POST['codTipoProyecto'];
			$codUsuario = $_POST['codUsuario'];
			$cadenaPatrocindores = $_POST['patrocinadores'];
			
			//consulta update
			$updateSQL = "UPDATE tblproyectos SET " 
								."nombreProyecto =  '".$nombreProyecto."', "
								."fechaInicio =  '".$fechaInicio."', "
								."fechafinal =  '".$fechaFinal."', "
								."lugar =  '".$lugar."', "
								."descripcion =  '".$descripcion."', "
								."codTipoProyecto = '".$codTipoProyecto."', "
								."codEstado =  '".$estado."', "
								."codUsuario =  '".$codUsuario."', "
								."costoEstimado = '".$costoEstimado."', "
								."beneficiario = '".$beneficiario."' "
			."WHERE codProyecto = ".$codigoProyecto; 
			$resultado = $miConexion->ejecutarInstruccion($updateSQL);
			if ($resultado) {
				//Eliminar todos los patrocinadores por proyecto
				$deleteQuey = "DELETE FROM tblpatrocinadoresxproyecto WHERE codProyecto = ".$codigoProyecto;
				$resultado = $miConexion->ejecutarInstruccion($deleteQuey);
				if($resultado){
					//volver a insertar la nueva seleccion
					$insertPatrocinadores = "";
					$arreglo = explode(",", $cadenaPatrocindores);
					if(count($arreglo) > 0){
						for($i=0; $i<count($arreglo); $i++){ 
							$insertPatrocinadores = 
							" insert into tblpatrocinadoresxproyecto (codPatrocinador, codProyecto) values (".$arreglo[$i]." , ".$codigoProyecto."); ";
							//registrar los patrocinadores del proyecto
							$resultado = $miConexion->ejecutarInstruccion($insertPatrocinadores);
						}
						if(!$resultado){
							echo "Error con los patrocinadores... ";
						} 
					}
				}
				echo "Se ha actualizado exitosamente";
			}else 
				echo "null : ".$updateSQL;
		break;
		//Asignar un rol a un usuario de un proyecto
		case '5':
			//capturando los datos del proyecto
			$codigoProyecto = $_POST['codigoProyecto'];
			$codUsuario = $_POST['codUsuario'];
			$rol = $_POST['rol'];
			$sqlAgregarRol =
				"update tblusuarioxproyecto set Rol = '"
				.$rol."' where codUsuario = ".$codUsuario." and codProyecto = ".$codigoProyecto;
			
			$resultado = $miConexion->ejecutarInstruccion($sqlAgregarRol);
			if ($resultado) {
				echo "Rol asignado exitosamente";
			}else
				echo "No se pudo asignar el rol.".$sqlAgregarRol;
		break;
	}

	
	$miConexion->cerrarConexion();    
	 



?>