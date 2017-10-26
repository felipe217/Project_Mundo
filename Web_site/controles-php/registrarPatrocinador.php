<?php 
	/* casos de este archivo
	 1. insertar una nueva tarea y sus usuarios asignados
	 2. editar la información de una tarea
	 */                     
	
	$caso = $_POST['caso'];
	
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	switch ($caso) {
		//caso 1, registro de un nuevo patrocinador
		case '1':
			
	        //Capturando los datos de tabla Patrocinador
           // $codPatrocinador = $_POST['codPatrocinador'];
            $nombre = $_POST['nombre'];
            $tipoPatrocinador = $_POST['tipoPatrocinador'];
            $lugarProcedencia = $_POST['lugarProcedencia'];
            $correoElectronico = $_POST['correoElectronico'];	
            $nombreContacto = $_POST['nombreContacto'];		
            $telefonoContacto = $_POST['telefonoContacto'];
            $direccion = $_POST['direccion'];

            //tipoPatrocinador=tipo_1&lugarProcedencia=Cuyamel&correoElectronico=yamevoy@gmail.com&nombreContacto=halo&telefonoContacto=22232567&direccion=cerca de aca

				//consulta para registrar el patrocinador
				$consulta = "INSERT INTO tblpatrocinadores ("
				."codPatrocinador, "
				."nombre, "
				."tipoPatrocinador, "
				."lugarProcedencia, "
				."correoElectronico, "
				."nombreContacto, "
				."telefonoContacto, "
				."direccion)"

			." VALUES ( null ,"
						."'".$nombre."',"
						."'".$tipoPatrocinador."'," 
						."'".$lugarProcedencia."',"
						."'".$correoElectronico."',"
						."'".$nombreContacto."',"
						."'".$telefonoContacto."',"
						."'".$direccion."');";
			//$consulta = $consulta." SELECT LAST_INSERT_ID() as codigo;";
			$resultado = $miConexion->ejecutarInstruccion($consulta);
			if ($resultado) {
				echo "Se registro exitosamente el patrocinador";			
				
			}else
				//echo "Ocurrió un error, no se pudo registrar.";
				echo "no se realizaó ningun registro: ".$consulta." y resultado: ".$resultado;
			break;

		//caso 2, actualizar un patrocinador registrado
		case '2':
			//capturando los datos del proyecto
			$codPatrocinador = $_POST['codPatrocinador'];
            $nombre = $_POST['nombre'];
            $tipoPatrocinador = $_POST['tipoPatrocinador'];
            $lugarProcedencia =$_POST['lugarProcedencia'];
            $correoElectronico =$_POST['correoElectronico'];	
            $nombreContacto =$_POST['nombreContacto'];		
            $telefonoContacto =$_POST['telefonoContacto'];
            $direccion = $_POST['direccion'];
			
			//consulta update
			$updateSQL = "UPDATE tblpatrocinadores SET " 
								."nombre =  '".$nombre."', "
								."tipoPatrocinador =  '".$tipoPatrocinador."', "
								."lugarProcedencia =  '".$lugarProcedencia."', "
								."correoElectronico =  '".$correoElectronico."', "
								."nombreContacto =  '".$nombreContacto."', "
								."telefonoContacto = '".$telefonoContacto."', "
								."direccion =  '".$direccion."' "								
			                    ."WHERE codPatrocinador = ".$codPatrocinador; 
			$resultado = $miConexion->ejecutarInstruccion($updateSQL);
			if ($resultado) {
				echo "Se actualizo exitosamente el patrocinador";			
				
			}else
				//echo "Ocurrió un error, no se pudo registrar.";
				echo "no se realizó ningun registro: ".$updateSQL."y resultado: ".$resultado;
			break; 
	}

	
	$miConexion->cerrarConexion();    
	 



?>