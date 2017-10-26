<?php 
	/*
		 CASOS:
		 1. carga todos los patrocinadores en el sistema
		 2. carga todos los patrocinadoresde un proyecto especifico
		 3. conculta todas las tares de un proyecto
		 4. consultas de todos los materiales de un proyecto 
		 5. selecciona los colaboradores del proyecto seleccionado:
		 6. cargar todos los estados disponibles en la base de datos
		 7. carga todos los diferentes tipos de proyectos establecidos en la base de datos 
		 8. carga todos los patrocinadores en el sistema
		 9. carga todos los patrocinadoresde un proyecto especifico 
		10. carga los usuarios sin rol asignados a un proyecto
		11. carga todos los datos de una tarea especifica


	*/ 
	 
	$caso = $_GET['caso'];
	$codigoPatrocinador = $_GET['codPatrocinador'];
	include_once("../class/class_conexion.php");
	include_once("../class/clase_Patrocinadores.php");
	include_once("../class/clase_Patrocinios.php");
	include_once("../class/clase_Desembolsos.php"); 	
	$miConexion = new Conexion();
	$JSONLine = "";
	//$listResponsables = ""; 

	switch ($caso) {
        //carga todos los patrocinadores en el sistema
		case '1':
			$sqlEstados = "select codPatrocinador, nombre from tblpatrocinadores";
			$resultado = $miConexion->ejecutarInstruccion($sqlEstados);
			$cant = $miConexion->cantidadRegistros($resultado); 
			if ($cant>0) {
				$Patrocinador = new Patrocinadores();
				$arreglo = array();
				$i=0;
				while ($fila = $miConexion->obtenerFila($resultado)){
					$Patrocinador->setCodigo($fila['codPatrocinador']);
					$Patrocinador->setNombre($fila['nombre']);
					$JSONLine = $JSONLine.$Patrocinador->toJSON()."*";
					// $arreglo[$i]["codigo"] = $fila['codPatrocinador'];
					// $arreglo[$i]["nombre"] = $fila['nombre'];
					// $i++;				
				}
				
				//$JSONLine = json_encode(array_values($arreglo));	
				if ($cant==1) {
					echo rtrim($JSONLine,"*");
				}else
				echo rtrim($JSONLine,"*");
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion(); 
		    break; 
		// carga todos los patrocinadores de un proyecto especifico
		case '2':
			$sqlPatrocinadoresxproyecto = "SELECT A.codPatrocinador, A.CodProyecto, B.nombre from "
										."tblpatrocinadoresxproyecto A inner join tblpatrocinadores B on A.codPatrocinador = B.codPatrocinador "
										."where A.codProyecto = ".$codigoPatrocinador;
			$resultado = $miConexion->ejecutarInstruccion($sqlPatrocinadoresxproyecto);
			$cant = $miConexion->cantidadRegistros($resultado); 
			if ($cant>0) {
				$patxproyectoArr = array();
				$i=0;
				while ($fila = $miConexion->obtenerFila($resultado)){
					$patxproyectoArr[$i]["codPatrocinador"] = $fila['codPatrocinador'];
					$patxproyectoArr[$i]["nombre"] = $fila['nombre'];
					$JSONLine = json_encode($patxproyectoArr);	
					$i++;				
				}
				if ($cant==1) {
					echo $JSONLine;
				}else
					echo $JSONLine;
			}else
				echo "null";
			
			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion(); 
			break;
		
		//consultar la información de un patrocinador especifico
		case '3':
			//consultar la información de un patrocinador especifico:
			$sqlPatrocinador ="SELECT codPatrocinador, nombre, tipoPatrocinador, lugarProcedencia, 
								correoElectronico, nombreContacto, telefonoContacto, direccion FROM tblpatrocinadores 
							   WHERE codPatrocinador = ".$codigoPatrocinador;
			
			$resultado = $miConexion->ejecutarInstruccion($sqlPatrocinador);
			$cant = $miConexion->cantidadRegistros($resultado);
			if ($cant>0) {
				while ($fila = $miConexion->obtenerFila($resultado)){
					$Patrocinador = new Patrocinadores();
					$Patrocinador->construir(
						$fila['codPatrocinador'],
						$fila['nombre'],
						$fila['tipoPatrocinador'],
						$fila['lugarProcedencia'],
						$fila['correoElectronico'],
						$fila['nombreContacto'],
						$fila['telefonoContacto'],
						$fila['direccion']
					);
				$JSONLine = $JSONLine.$Patrocinador->toJSON()."*"; 
				}
				if ($cant==1) {
					echo rtrim($JSONLine,"*");
				}else
					echo rtrim($JSONLine,"*");
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion(); 
			break;
  
		//Consulta el desembolso de patrocinador 
		case '4':
			$sqlEstados = "SELECT A.codDesembolso, A.fecha, A.valor, A.codPatrocinio, A.codProyecto, B.nombreProyecto 
						   FROM tbldesembolsos A 
						   INNER JOIN tblproyectos B ON A.codProyecto = B.codProyecto 
						   INNER JOIN tblpatrocinios C ON A.codPatrocinio = C.codigo 
						   INNER JOIN tblpatrocinadores D ON C.codPatrocinador = D.codPatrocinador 
						   WHERE D.codPatrocinador = ".$codigoPatrocinador;
							//echo $sqlEstados;
			$resultado = $miConexion->ejecutarInstruccion($sqlEstados);
			$cant = $miConexion->cantidadRegistros($resultado); 
			if ($cant>0) {
				$estadosArray = array();
				$i=0;
				while ($fila = $miConexion->obtenerFila($resultado)){
					$estadosArray[$i]["codDesembolso"] = $fila['codDesembolso'];
					$estadosArray[$i]["fecha"] = $fila['fecha'];
					$estadosArray[$i]["valor"] = $fila['valor'];
					$estadosArray[$i]["codPatrocinio"] = $fila['codPatrocinio'];
					$estadosArray[$i]["codProyecto"] = $fila['codProyecto'];
					$estadosArray[$i]["nombreProyecto"] = $fila['nombreProyecto'];			
					$i++;				
				}
				$JSONLine = json_encode($estadosArray);	
				if ($cant==1) {
					echo $JSONLine;
				}else
					echo $JSONLine;
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion(); 
			break;
		
		//consulta de los patrocionios:
		case '6':
			/* $sqlEstados = "SELECT codigo, tipoPatrocinio, descripcion, fecha, valor, codPatrocinador FROM tblpatrocinios
	 						WHERE codPatrocinio = ".$codigoPatrocinio;";
			$resultado = $miConexion->ejecutarInstruccion($sqlEstados);
			$cant = $miConexion->cantidadRegistros($resultado); 
			if ($cant>0) {
				$estadosArray = array();
				$i=0;
				while ($fila = $miConexion->obtenerFila($resultado)){
					$estadosArray[$i]["codigo"] = $fila['codEstado'];
					$estadosArray[$i]["estado"] = $fila['estado'];
					$i++;				
				}
				$JSONLine = json_encode($estadosArray);	
				if ($cant==1) {
					echo $JSONLine;
				}else
					echo $JSONLine;
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();  */
			break;

		//carga todos los diferentes tipos de proyectos establecidos en la base de datos 
		case '7':
			$sqlTipos = "select codTiposProyecto, tipoProyecto from tiposproyectos";
			$resultado = $miConexion->ejecutarInstruccion($sqlTipos);
			$cant = $miConexion->cantidadRegistros($resultado); 
			if ($cant>0) {
				$estadosArray = array();
				$i=0;
				while ($fila = $miConexion->obtenerFila($resultado)){
					$estadosArray[$i]["codigo"] = $fila['codTiposProyecto'];
					$estadosArray[$i]["tipo"] = $fila['tipoProyecto'];
					$JSONLine = json_encode($estadosArray);	
					$i++;				
				}
				if ($cant==1) {
					echo $JSONLine;
				}else
					echo $JSONLine;
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion(); 
			break;

		//consultar todos los proyectos
		case '8':
			$todosLosProyectos = "SELECT codProyecto, nombreProyecto, estado FROM tblproyectos A inner join tblestados B on a."
									."codEstado = b.codEstado";

			$resultado = $miConexion->ejecutarInstruccion($todosLosProyectos);
			while ($fila = $miConexion->obtenerFila($resultado)){
				$proyecto->setCodProyecto($fila['codProyecto']);
				$proyecto->setNombreProyecto($fila['nombreProyecto']);
				$proyecto->setEstado($fila['estado']);

				$JSONLine = $JSONLine.$proyecto->toJSON()."-";
			}

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();

			echo rtrim($JSONLine,"-");
			break;

        //consulta la información de un proyecto
		case '9':
			//consultar todos los datos de un proyecto 
			$dataProyecto = 
				"Select A.codProyecto, A.nombreProyecto, A.fechaInicio, A.fechafinal, A.lugar, A.descripcion, A.beneficiario,"
			    ." A.codTipoProyecto, B.estado, B.codEstado, A.costoEstimado, "
			    ."C.nombreUsuario, "
			    ."D.tipoProyecto "
			."FROM tblProyectos A "
			."inner join tblestados B on A.codEstado = B.codEstado "
			."inner join tblusuarios C on A.codUsuario = C.codUsuario "
			."inner join tiposproyectos D on A.codTipoProyecto = D.codTiposProyecto"
			." where A.codProyecto = ".$codigoProyecto;

			$resultado = $miConexion->ejecutarInstruccion($dataProyecto);
			if ($resultado) { 
				$fila = $miConexion->obtenerFila($resultado);
				$proyecto->setCodProyecto($fila['codProyecto']);
				$proyecto->setNombreProyecto($fila['nombreProyecto']);
				$proyecto->setEstado($fila['estado']);
				$proyecto->setFechaInicio($fila['fechaInicio']);
				$proyecto->setFechaFinal($fila['fechafinal']);
				$proyecto->setLugar($fila['lugar']);
				$proyecto->setDescripcion($fila['descripcion']);
				$proyecto->setCostoEstimado($fila['costoEstimado']);
				$proyecto->setResponsable($fila['nombreUsuario']);
				$proyecto->setBeneficiario($fila['beneficiario']);
				$proyecto->setTipoProyecto($fila['tipoProyecto']);
				$proyecto->setCodTipoProyecto($fila['codTipoProyecto']);
				$proyecto->setCodEstado($fila['codEstado']);

				$JSONLine = $JSONLine.$proyecto->toJSON()."-";
				
				echo rtrim($JSONLine,"-");

			}else {
				echo "Error en la consulta: ".$dataProyecto;
			}

			$miConexion->cerrarConexion();

			break;

		//carga los usuarios asignados a un proyecto 
		case '10':
			$sqlColaboradores = 
			"select  "
				."	a.codUsuario, a.nombreUsuario, "  
				."  b.Rol "
			."FROM tblusuarios a "
			."inner join tblusuarioxproyecto b on a.codUsuario = b.codUsuario "
			."inner join tbltipousuario c on a.codTipoUsuario = c.codTipoUsuario "
			."WHERE b.Rol = 'n/a' and b.codProyecto = ".$codigoProyecto;

			$resultado = $miConexion->ejecutarInstruccion($sqlColaboradores);
			$cant = $miConexion->cantidadRegistros($resultado); 
			$colaborador = new Colaborador();
			if ($cant>0) {

			while ($fila = $miConexion->obtenerFila($resultado)){
				$colaborador->setCodUsuario($fila['codUsuario']);
				$colaborador->setNombreUsuario($fila['nombreUsuario']);
				$colaborador->setRol($fila['Rol']); 
				$JSONLine = $JSONLine.$colaborador->toJSON()."*"; 
			}
			if ($cant==1) {
				echo rtrim($JSONLine,"*");
			}else
				echo rtrim($JSONLine,"*");
			}else
			echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();
			break;

		//carga todos los datos de una tarea especifica
		case '11':
			$codTarea = $_POST['codTarea'];
			$sqltareas ="SELECT nombreTarea, descripcion, prioridad, fechaInicio, fechaEntrega  FROM tbltareas WHERE codTarea = ".$codTarea;
			$tarea = new Tarea();
			$resultado = $miConexion->ejecutarInstruccion($sqltareas);
			$cant = $miConexion->cantidadRegistros($resultado);
			if ($cant>0) {
				while ($fila = $miConexion->obtenerFila($resultado)){
						//antes de llenar la tabla debemos identificar a los responsables de las tareas
						$sqlResponsables = 
										"select c.nombreUsuario from tblusuarioxtarea a "
										."inner join tbltareas b on a.codTarea = b.codTarea "
										."inner join tblusuarios c on a.codUsuario = c.codUsuario "
										."where b.codProyecto = ".$codigoProyecto." and a.codTarea = ".$codTarea;

						$rstResponsables =$miConexion->ejecutarInstruccion($sqlResponsables);
						while ($row = $miConexion->obtenerFila($rstResponsables)) {
							$listResponsables = $listResponsables." ".$row['nombreUsuario'].",";
						}
						$miConexion->liberarResultado($rstResponsables);
						$tarea->construir(
										$codTarea,
										$fila['nombreTarea'],
										$fila['descripcion'],										
										$fila['prioridad'],										
										$fila['fechaInicio'],
										$fila['fechaEntrega'],
										$listResponsables	
										);
					$JSONLine = $JSONLine.$tarea->toJSON();
					$listResponsables ="";
				}
				if ($cant==1) {
					echo rtrim($JSONLine,"*");
				}else
					echo rtrim($JSONLine,"*");
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();
			break;
		default:
		# code...
		break; 
 
	}

	 

	

?>