<?php 	
	 
	//Capturando los datos de tabla Bitacora  
	$Operacion = $_GET['Operacion']; 
    $codUsuario = $_GET['codUsuario'];   		
	$descripcion = $_GET['descripcion']; 
    $fecha = $_GET['fecha'];          

   	$caso = $_GET['caso'];
	
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	switch ($caso) {
		//Insertar un nuevo desembolso
		case '1':
			$consulta = "INSERT INTO tblbitacora ("
						."codOperacion, "
                        ."Operacion, "															                     
						."codUsuario, "
                        ."descripcion, "
                        ."fecha "
					.") "
					."VALUES ( null ,"                            
							."'".$Operacion."',"							             
							."'".$codUsuario."',"
                            ."'".$descripcion."',"							
							."'".$fecha."')";

 				//Linea para prueba del registro de datos 
                //?caso=1&Operacion=operacion_1&codUsuario=2&descripcion=probando bitacora&fecha=2015-10-29          

			$resultado = $miConexion->ejecutarInstruccion($consulta);
			if ($resultado) {
				echo "Se registro exitosamente la bitacora";			
				
			}else
				//echo "Ocurrió un error, no se pudo registrar.";
				echo "no se realizaó ningun registro: ".$consulta." y resultado: ".$resultado;
			break;		
		
	}	   
	$miConexion->cerrarConexion();

 ?>
 