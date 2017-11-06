<?php
    /*casos:
        1. Consultar todos los documentos 
        2. consultar todos los proyectos de un usuario 
    */
    include_once("../class/class_conexion.php");
    $caso = $_POST['caso'];
    $miConexion = new Conexion();
	$JSONLine = "";

    switch ($caso) {
        case '1':
            $sqlDocs = "SELECT a.nombre, a.descripcion, a.fecha, a.url, a.codUsuario, b.usuario FROM tbldocumentos a 
            inner join tblusuarios b on a.codUsuario = b.codUsuario
            WHERE codProyecto = ".$_POST['codigo'];
            $resultado = $miConexion->ejecutarInstruccion($sqlDocs);
            $cant = $miConexion->cantidadRegistros($resultado);  
            if ($cant>0) {
                $estadosArray = array();
                $i=0;
                while ($fila = $miConexion->obtenerFila($resultado)){
                    $estadosArray[$i]["nombre"] = $fila['nombre']; 
                    $estadosArray[$i]["descripcion"] = $fila['descripcion']; 
                    $estadosArray[$i]["url"] = $fila['url'];
                    $estadosArray[$i]["usuario"] = $fila['usuario']; 
                    $estadosArray[$i]["fecha"] = $fila['fecha']; 		
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
            $sqlProyectos = "SELECT a.nombre, a.descripcion, a.url, a.codUsuario, b.usuario FROM tbldocumentos a 
            inner join tblusuarios b on a.codUsuario = b.codUsuario
            WHERE codProyecto = ".$_POST['codigo'];
            $resultado = $miConexion->ejecutarInstruccion($sqlProyectos);
            $cant = $miConexion->cantidadRegistros($resultado);  
            if ($cant>0) {
                $estadosArray = array();
                $i=0;
                while ($fila = $miConexion->obtenerFila($resultado)){
                    $estadosArray[$i]["nombre"] = $fila['nombre']; 
                    $estadosArray[$i]["descripcion"] = $fila['descripcion']; 
                    $estadosArray[$i]["url"] = $fila['url'];
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
        case '3':
        break;
        default: 
            if (!isset($_FILES["docFile"]["name"])) {
                echo "no se cargo";
            }else{
                $target_dir = "../docs/";
                $target_file = $target_dir.basename($_FILES["docFile"]["name"]);
                $url = "docs/".basename($_FILES["docFile"]["name"]);
                $uploadOk = 1;
                $FileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // // Check if image file is a actual image or fake image
                if (file_exists($target_file)) {
                    echo "<script>alert('Hemos encontrado un documento con el mismo nombre.');</script>";
                    $uploadOk = 0;
                }
                
                if($FileType != "pdf" ) {
                    echo "<script>alert('El documento debe ser formato .PDF');</script>";
                    $uploadOk = 0;
                }
                
                if ($_FILES["docFile"]["size"] > 5000000) {
                    echo "<script>alert('El documento es muy pesado');</script>";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    echo "<script>alert('El documento no pudo guardarse');</script>";                     
                    //header('Location: ../documentos.html');
                // if everything is ok, try to upload file
                } else {
                    //si todo está bien con el archivo, entonces hay que revisar los datos para la base  
                    if(isset($_POST['docTitulo'])){
                        $consulta = "INSERT INTO tbldocumentos (nombre, url, codProyecto, codUsuario, fecha, descripcion)"
                                    ." VALUES ('".$_POST['docTitulo']."','".$url."','".$_POST['docProy']."','".$_POST['docUser']."',NOW(), 'ninguna')";

                        $resultado = $miConexion->ejecutarInstruccion($consulta);
                        if ($resultado) {		
                            echo "se registro exitosamente";
                        }else
                            echo "No se pudo registrar.".$consulta;
                        $miConexion->cerrarConexion();   
                        //luego se procede a guargar el elemento
                        if (move_uploaded_file($_FILES["docFile"]["tmp_name"], $target_file)) {
                            //echo "The file ". basename( $_FILES["docFile"]["name"]). " has been uploaded.";
                            echo "<script>alert('Documento Guardado con exito.');</script>";
                            header('Location: ../documentos.html');
                        } else {
                            echo "<script>alert('El documento no puedo guardarse');</script>";
                            header('Location: ../documentos.html');
                        }    
                    }else
                        echo "el titulo no esta definido";                    
                }
            }
        break;
    }
?>