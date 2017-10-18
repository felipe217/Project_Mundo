<?php 
	

	//Capturando los datos de tabla Tarea
	//$codTarea = $_POST['codTarea'];
	$nombreTarea = $_POST['nombreTarea'];
	$descripcion = $_POST['descripcion'];
	$prioridad = $_POST['prioridad'];
	$fechaInicio = $_POST['fechaInicio'];	
	$fechaEntrega = $_POST['fechaEntrega'];		
	$codProyecto = $_POST['codProyecto'];
	
	include_once("../class/class_conexion.php");	

	$miConexion = new Conexion();
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
		echo "se registro exitosamente";
	}
	$miConexion->cerrarConexion();     


 ?>
 

<!-- `codTarea` int(10) NOT NULL,
  `nombreTarea` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `prioridad` varchar(30) CHARACTER SET latin1 NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaEntrega` date NOT NULL,
  `codProyecto` int(10) NOT NULL -->