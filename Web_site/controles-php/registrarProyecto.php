<?php
	
	//capturando los datos del proyecto
	$codigo = 0;
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

	/*"nombre=nombre&fechaInicio=fechaInicio&fechaFinal=fechafinal&lugar=lugar&costo=costo&beneficiario=beneficiario&codEstado=codEstado&codTipoProyecto=tipo&codUsuario=codUsuario"*/

	//importando las clases necesarias
	include_once("../class/class_conexion.php");	

	$miConexion = new Conexion();
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
	                                ."".$costoEstimado.","
									."'".$beneficiario."');";
	$consulta = $consulta." SELECT LAST_INSERT_ID() as codigo; ";
	$resultado = $miConexion->ejecutarInstruccion($consulta);
	if ($resultado) {
		//capturar el valor del codigo asignado y utilizarlo parala nueva consulta´
		$fila = $miConexion->obtenerFila($resultado);
		$codigo = $fila['codigo']; 
		//evaluar si existen patrocinadores seleccionados y crear los inserts para cada patrcinador
		$insertPatrocidaresQ = "";
		$arreglo = explode(",", $cadenaPatrocindores);
		if(count($arreglo) > 0){
			for($i=0; $i<count($arreglo); $i++){ 
				$insertPatrocidaresQ = 
				$insertPatrocidaresQ." "
				." insert into tblpatrocinadoresxproyecto (codPatrocinador, codProyecto) values (".$arreglo[$i]." , ".$codigo."); ";
			}
			//registrar los patrocinadores del proyecto
			$resultado = $miConexion->ejecutarInstruccion($insertPatrocidaresQ);
			if($resultado){
				echo "El proyecto y sus patrocinadores se registraron exitosamente.";
			}

			$miConexion->liberarResultado($resultado);
		}
	}else
		echo "no se realizaó ningun registro";
	$miConexion->cerrarConexion();     



?>