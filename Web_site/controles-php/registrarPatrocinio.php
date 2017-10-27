<?php 
	 

	//Capturando los datos de tabla Patrocinio
	$tipoPatrocinio = $_GET['tipoPatrocinio'];
	$descripcion = $_GET['descripcion'];
	$fecha = $_GET['fecha'];	
	$valor = $_GET['valor'];		
	$codPatrocinador = $_GET['codPatrocinador'];

   
	$caso = $_GET['caso'];
	
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	switch ($caso) {
		//Insertar un nuevo patrocinio
		case '1':
			$consulta = "INSERT INTO tblpatrocinios ("
						."codigo, "
						."tipoPatrocinio, "
						."descripcion, "
						."fecha, "
						."valor, "						                     
						."codPatrocinador"
					.") "
					."VALUES ( null ,"
							."'".$tipoPatrocinio."',"
							."'".$descripcion."'," 
							."'".$fecha."',"
							."'".$valor."',"							             
							."'".$codPatrocinador."')";

             //Linea para prueba del registro de datos  
             //caso=1&tipoPatrocinio=tipo_3&descripcion=es de otro mundo&fecha=2015-10-23&valor=45660&codPatrocinador=2            

			$resultado = $miConexion->ejecutarInstruccion($consulta);
			if ($resultado) {
				echo "Se registro exitosamente el patrocinio";			
				
			}else
				//echo "Ocurrió un error, no se pudo registrar.";
				echo "no se realizaó ningun registro: ".$consulta." y resultado: ".$resultado;
			break;		
		
	}	   
	$miConexion->cerrarConexion();

 ?>
 