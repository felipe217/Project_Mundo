<?php 
	 

	//Capturando los datos de tabla Desembolsos
    $fecha = $_GET['fecha'];
    $valor = $_GET['valor'];
	$codPatrocinio = $_GET['codPatrocinio'];		
	$codProyecto = $_GET['codProyecto'];             

   	$caso = $_GET['caso'];
	
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	switch ($caso) {
		//Insertar un nuevo desembolso
		case '1':
			$consulta = "INSERT INTO tbldesembolsos ("
						."codDesembolso, "
                        ."fecha, "
						."valor, "
						."codPatrocinio, "											                     
						."codProyecto"
					.") "
					."VALUES ( null ,"
                            ."'".$fecha."',"
							."'".$valor."',"							             
							."'".$codPatrocinio."',"							
							."'".$codProyecto."')";

 				//Linea para prueba del registro de datos 
                //caso=1&fecha=2015-10-23&valor=45660&codPatrocinio=2&codProyecto=3           

			$resultado = $miConexion->ejecutarInstruccion($consulta);
			if ($resultado) {
				echo "Se registro exitosamente el desembolso";			
				
			}else
				//echo "Ocurrió un error, no se pudo registrar.";
				echo "no se realizaó ningun registro: ".$consulta." y resultado: ".$resultado;
			break;		
		
	}	   
	$miConexion->cerrarConexion();

 ?>
 