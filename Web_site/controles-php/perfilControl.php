<?php 
/* casos   
    1. consultar la informacion de perfil de usuarios
    2. actualizar la informacion de un usuario
*/
    include_once("../class/class_conexion.php");
    $caso = $_POST['caso'];
    $miConexion = new Conexion();
	$JSONLine = "";
    switch($caso){
        // 1. consultar la informacion de perfil de usuario
        case '1':  
            $sqlPerfil = "select codUsuario, usuario, pais, departamento, cargo from tblusuarios where codUsuario = ".$_POST['codigo'];
            $resultado = $miConexion->ejecutarInstruccion($sqlPerfil);
            $cant = $miConexion->cantidadRegistros($resultado); 
            if ($cant>0) {
                $estadosArray = array();
				$i=0;
				while ($fila = $miConexion->obtenerFila($resultado)){
					$estadosArray[$i]["codUsuario"] = $fila['codUsuario']; 
					$estadosArray[$i]["pais"] = $fila['pais']; 
					$estadosArray[$i]["departamento"] = $fila['departamento'];
                    $estadosArray[$i]["cargo"] = $fila['cargo'];
                    $estadosArray[$i]["usuario"] = $fila['usuario'];			
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
        case '2':
            //capturando los datos del usuario
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];             
            //consulta update
            $updateSQL = "UPDATE tblusuarios SET " 
                                ."usuario = '".$usuario."', "
                                ."contrasena =  '".$contrasena."'" 							
                                ."WHERE codUsuario = ".$_POST['codigo'];
            $resultado = $miConexion->ejecutarInstruccion($updateSQL);
            if ($resultado) {
                echo "Se actualizo exitosamente el usuario.";	 
            }else
                //echo "Ocurrió un error, no se pudo registrar.";
                echo "No se pudo actualizar: ".$updateSQL."y resultado: ".$resultado;
        break; 
    }

?>