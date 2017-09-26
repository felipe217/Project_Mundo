<?php
	
	//capturando los datos del proyecto
	//$codigo = $_POST['codigo'];
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

	/*"nombre=nombre&fechaInicio=fechaInicio&fechaFinal=fechafinal&lugar=lugar&costo=costo&beneficiario=beneficiario&codEstado=codEstado&codTipoProyecto=tipo&codUsuario=codUsuario"*/

	//importando las clases necesarias
	include_once("../class/class_conexion.php");	

	$miConexion = new Conexion();
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
	                                ."'".$beneficiario."')";

	$resultado = $miConexion->ejecutarInstruccion($consulta);
	if ($resultado) {
		echo "se registro exitosamente";
	}
	$miConexion->cerrarConexion();     



?>