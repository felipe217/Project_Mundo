<?php 
/* casos   
    1. consultar la informacion de perfil de usuarios
    2. actualizar la informacion de un usuario
*/
    include_once("../class/class_conexion.php");
    $caso = $_GET['caso'];
    $miConexion = new Conexion();
	$JSONLine = "";
    switch(caso){
        // 1. consultar la informacion de perfil de usuario
        case '1': 
            $sqlPerfil = "select codUsuario, nacimiento, pais, departamento, cargo from tblusuarios where codUsuario = 1";
            $resultado = $miConexion->ejecutarInstruccion($sqlEstados);
            $cant = $miConexion->cantidadRegistros($resultado); 
    }

?>