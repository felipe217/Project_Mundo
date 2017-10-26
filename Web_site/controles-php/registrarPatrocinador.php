<?php 
	/* casos de este archivo
	 1. insertar una nueva tarea y sus usuarios asignados
	 2. editar la información de una tarea
	 */                     
	
	$caso = $_GET['caso'];
	
	include_once("../class/class_conexion.php");	
	$miConexion = new Conexion();

	switch ($caso) {
		//caso 1, registro de un nuevo patrocinador
		case '1':
			
	        //Capturando los datos de tabla Patrocinador
           // $codPatrocinador = $_GET['codPatrocinador'];
            $nombre = $_GET['nombre'];
            $tipoPatrocinador = $_GET['tipoPatrocinador'];
            $lugarProcedencia = $_GET['lugarProcedencia'];
            $correoElectronico = $_GET['correoElectronico'];	
            $nombreContacto = $_GET['nombreContacto'];		
            $telefonoContacto = $_GET['telefonoContacto'];
            $direccion = $_GET['direccion'];

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

			."VALUES ( null ,"
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
				echo "no se realizaó ningun registro: ".$consulta."y resultado: ".$resultado;
			break;

		//caso 2, actualizar un patrocinador registrado
		case '2':
			//capturando los datos del proyecto
			$codPatrocinador = $_GET['codPatrocinador'];
            $nombre = $_GET['nombre'];
            $tipoPatrocinador = $_GET['tipoPatrocinador'];
            $lugarProcedencia =$_GET['lugarProcedencia'];
            $correoElectronico =$_GET['correoElectronico'];	
            $nombreContacto =$_GET['nombreContacto'];		
            $telefonoContacto =$_GET['telefonoContacto'];
            $direccion = $_GET['direccion'];
			
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
				echo "no se realizaó ningun registro: ".$updateSQL."y resultado: ".$resultado;
			break;
		//Asignar un rol a un usuario de un proyecto
		case '5':
			//capturando los datos del proyecto
			$codigoProyecto = $_POST['codigoProyecto'];
			$codUsuario = $_POST['codUsuario'];
			$rol = $_POST['rol'];
			$sqlAgregarRol =
				"update tblusuarioxproyecto set Rol = '"
				.$rol."' where codUsuario = ".$codUsuario." and codProyecto = ".$codigoProyecto;
			
			$resultado = $miConexion->ejecutarInstruccion($sqlAgregarRol);
			if ($resultado) {
				echo "Rol asignado exitosamente";
			}else
				echo "No se pudo asignar el rol.".$sqlAgregarRol;
		break;
	}

	
	$miConexion->cerrarConexion();    
	 



?>