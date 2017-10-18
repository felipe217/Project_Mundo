<?php 
	

	//Capturando los datos de tabla Materiales
	//$codMaterial = $_POST['codMaterial'];
	$proveedor = $_POST['proveedor'];
	$material = $_POST['material'];
	$cantidad = $_POST['cantidad'];
	$precio = $_POST['precio'];	
	$total = $_POST['total'];		
	$codProyecto = $_POST['codProyecto'];
	
	include_once("../class/class_conexion.php");	

	$miConexion = new Conexion();
	$consulta = "INSERT INTO tblMateriales ("
	                            ."codMaterial, "
	                            ."proveedor, "
	                            ."material, "
	                            ."cant, "
	                            ."precio, "
	                            ."total, "             
	                            ."codProyecto"
	                        .") "

	                       ."VALUES ( null ,"
	                                ."'".$proveedor."',"
	                                ."'".$material."'," 
	                                ."'".$cantidad."',"
	                                ."'".$precio."',"
	                                ."'".$total."',"          
	                                ."'".$codProyecto."')";

	$resultado = $miConexion->ejecutarInstruccion($consulta);
	if ($resultado) {		
		echo "se registro exitosamente";
	}else
		echo "No se pudo registrar.".$consulta;
	$miConexion->cerrarConexion();     


 ?>