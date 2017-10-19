<?php 
	/* casos de este archivo
	 1. insertar una nueva tarea y sus usuarios asignados
	 2. editar la información de una tarea
	 */ 

	//Capturando los datos de tabla Tarea
	$nombreTarea = $_POST['nombreTarea'];
	$descripcion = $_POST['descripcion'];
	$prioridad = $_POST['prioridad'];
	$fechaInicio = $_POST['fechaInicio'];	
	$fechaEntrega = $_POST['fechaEntrega'];		
	$codProyecto = $_POST['codProyecto'];
	$cadenaDeUsuarios = $_POST['cadenaDeUsuarios'];
	$caso = $_POST['caso'];
	
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	switch ($caso) {
		//insertar una nueva tarea y sus usuarios asignados
		case '1':
			$consulta = "INSERT INTO tblTareas ("
						."codTarea, "
						."nombreTarea, "
						."descripcion, "
						."prioridad, "
						."fechaInicio, "
						."fechaEntrega, "                      
						."codProyecto"
					.") "
					."VALUES ( null ,"
							."'".$nombreTarea."',"
							."'".$descripcion."'," 
							."'".$prioridad."',"
							."'".$fechaInicio."',"
							."'".$fechaEntrega."',"             
							."'".$codProyecto."')";

			$resultado = $miConexion->ejecutarInstruccion($consulta);
			if ($resultado) {		
				//capturar el valor del codigo asignado y utilizarlo parala nueva consulta´
				$consulta = " SELECT LAST_INSERT_ID() as codigo;";
				$resultado = $miConexion->ejecutarInstruccion($consulta);
				$fila = $miConexion->obtenerFila($resultado);
				$codigo = $fila['codigo']; 
				$miConexion->liberarResultado($resultado);
				//evaluar si existen usuarios seleccionados y crear los inserts para cada usuario
				$insertUsuarios = "";
				$arreglo = explode(",", $cadenaDeUsuarios);
				if(count($arreglo) > 0){
					for($i=0; $i<count($arreglo); $i++){ 
						$insertUsuarios = 
						"INSERT INTO  tblusuarioxtarea (codTarea, codUsuario) VALUES ('".$codigo."', '".$arreglo[$i]."')";
						//registrar los usuarios del proyecto
						$resultado = $miConexion->ejecutarInstruccion($insertUsuarios);
					}
					if($resultado){
						echo "La tarea y sus usuarios se registraron exitosamente.";
					} 
				}
				}else
					echo "hubo un lindo y hermoso error";
		break;
		
		case '2': 
			$codTarea = $_POST['codTarea'];
			//consulta update
			$updateSQL = "UPDATE tbltareas SET nombreTarea='".$nombreTarea."', " 
									."descripcion='".$descripcion."', "
									."prioridad='".$prioridad."', "
									."fechaInicio='".$fechaInicio."', "
									."fechaEntrega='".$fechaEntrega."', "
									."codProyecto='".$codProyecto."'"
								."WHERE codTarea= ".$codTarea;

			$resultado = $miConexion->ejecutarInstruccion($updateSQL);
			if ($resultado) {
				//Eliminar todos los usuarios enrolados en el proyecto y asignados a la tarea
				$deleteQuey = "DELETE FROM tblusuarioxtarea WHERE codUsuario = ".$codigoProyecto;
				$resultado = $miConexion->ejecutarInstruccion($deleteQuey);
				if($resultado){
					//volver a insertar la nueva seleccion
					$insertUsuarios = "";
					$arreglo = explode(",", $cadenaDeUsuarios);
					if(count($arreglo) > 0){
						for($i=0; $i<count($arreglo); $i++){ 
							$insertUsuarios = 
							" insert into tblpatrocinadoresxproyecto (codPatrocinador, codProyecto) values (".$arreglo[$i]." , ".$codigoProyecto."); ";
							//registrar los usuarios del proyecto
							$resultado = $miConexion->ejecutarInstruccion($insertUsuarios);
						}
						if(!$resultado){
							echo "Error con los usuarios... ";
						} 
					}
				}
				echo "Se ha actualizado exitosamente";
			}else 
				echo "null : ".$updateSQL;

		break;
		default:
			# code...
			break;
	}

	
	   
	$miConexion->cerrarConexion();     


 ?>
 