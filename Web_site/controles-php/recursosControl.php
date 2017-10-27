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
	 
	$caso = $_POST['caso'];
	$codigoPatrocinador = $_POST['codPatrocinador'];
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
		case '5':
			$sqlEstados = "SELECT codigo, tipoPatrocinio, descripcion, fecha, valor, codPatrocinador FROM tblpatrocinios
	 						WHERE codPatrocinador = ".$codigoPatrocinador;
			$resultado = $miConexion->ejecutarInstruccion($sqlEstados);
			$cant = $miConexion->cantidadRegistros($resultado); 
			if ($cant>0) {
				$patrocinio = new Patrocinios();
				while ($fila = $miConexion->obtenerFila($resultado)){
					$patrocinio->construir(
						$fila['codigo'], $fila['tipoPatrocinio'],$fila['descripcion'],$fila['fecha'],$fila['valor'],$fila['codPatrocinador']
					);
					$JSONLine = $JSONLine.$patrocinio->toJSON()."*";			
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