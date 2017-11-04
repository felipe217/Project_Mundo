<?php 
	 

	//Capturando los datos de tabla Patrocinio
	$tipoPatrocinio = $_POST['tipoPatrocinio'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];	
	$valor = $_POST['valor'];		
	$codPatrocinador = $_POST['codPatrocinador'];

   
	$caso = $_POST['caso'];
	
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
							." NOW() ,"
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
 