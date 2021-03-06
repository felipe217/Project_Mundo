<!DOCTYPE html>

<?php 
session_start();
if($_SESSION['login'] == true){
	$username = $_SESSION['username'];
	$name = $_SESSION['name'];
	$lastname = $_SESSION['lastname'];
}
else{
	session_unset();
  	session_destroy();
 	 header('location: index.php');
}

if(isset($_POST['cerrar_sesion']))
{
session_start();
session_destroy();
header('location: index.php');
}
?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Plantilla del sitio</title>
	<link rel="stylesheet" type="text/css" href="css/datatables.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/miEstilo.css">

	<style type="text/css">
		
	</style>

</head>
<body>

	<!--Barra de navegacion -->
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Un Mundo</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
							<li>
								<a href="panelusuarios.php">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						 Usuarios 
						</a>
					</li>
					<li >
								<a href="panelproyectos.php">
								<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
							Proyectos  
						</a>
					</li>
					<li>
								<a href="panelrecursos.php">
								<span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
							Recursos 
						</a>
					</li>
							<li class="menu-activo">
								<a href="documentos.php">
						<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
						 Documentos  
						</a>
					</li>
						</ul> 

	      <ul class="nav navbar-nav navbar-right">
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<img class="small-profile-pic img-circle" src="img/userprofile.jpg"> <?php echo $name ." ". $lastname; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Configurar cuenta</a></li>
	            <li role="separator" class="divider"></li>
							<li><a data-toggle="modal" data-target="#exit" >Cerrar sesión</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<!--Fin de la barra de navegación-->

	<!--Contenido de la pagina-->
	 	<!-- Inicio de contenido-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 grid-margin">
				<div class="panel panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>   Documentos
					  </div>
					  <!--Inicio de panel izquierso -->
					  <div class="panel-body">
					  	<div id="operaciones-proyectos">
					  		<div class="btn-group" role="group">
									<button id="btnNuevo" type="button" class="btn btn-default" data-toggle="modal" data-target="#frmNewDoc"> 
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
									</button>
									<!-- <button type="button" class="btn btn-default"data-toggle="modal" data-target="#frmNuevoProyecto">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
									</button>  -->
								</div> 
							</div> 
							<br>
								<select class="form-control" id="slcProyectos">
									<option value="0">Seleccione un proyecto</option>
									<option value="3">Proyecto 3</option>
								</select>
							<br>
					    <div>
					    	<table class="table display"  id="tabla-documentos">
					    		<thead>
					    			<th>Nombre</th>
										<th>Usuario</th>  
									</thead>
										<!-- <tr id="docs/doc.pdf">
											<td>nombre</td>
											<td>descripcion</td>
										</tr> -->
					    		<tbody> 
									</tbody>
					    	</table>
					    </div>
					  </div>
					</div>	
			</div> <!-- Final del panel izquierdo-->

			<!-- Panel derecho-->
			<div>
				<div class="col-lg-9 grid-margin">
					<div class="panel with-nav-tabs panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<!--<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Proyecto: Nombre de proyecto-->
  						<ul class="nav nav-tabs">
								<li><span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="padding: 10px;"></span>
									 <label >Titulo de documento: </label><span id="tittleTag"></span>  &nbsp;&nbsp;&nbsp;&nbsp;
									 <label >Subido por: </label><span id="docUserTag"></span> &nbsp;&nbsp;&nbsp;&nbsp;
									 <!-- <label >Fecha creación: </label><span id="docFechaTag"></span> -->
								</li>
						</ul>
					  </div>
					  <div class="panel-body "> 
							<iframe id="docViewer" src = "" width='100%' height='450px' allowfullscreen webkitallowfullscreen></iframe>
					  </div>
					 </div>
				</div>
			</div>
		</div>
	</div>

	<!-- VENTANAS MODALES -->
	<div id="frmNewDoc" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Modal title</h4>
					</div>
					<div class="modal-body">
							<form class="form-horizontal" action="controles-php/documentosControl.php" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-sm-4 control-label">Titulo de documento:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="txtTitulo" placeholder="Titulo de documento" name="docTitulo">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Seleccione un documento .pdf no mayor a 5MB </label>
									<div class="col-sm-8">
											<input type="file" name="docFile" id="docFile">
									</div>  
								</div>			 
								<input class="hidden" type="text" name="docUser" id="docUser">
								<input class="hidden" type="text" name="docProy" id="docProy">
					</div> 
					<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="submit" value="Subir documento" name="submit" class="btn btn-success"> 
					</div>
				</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div id="exit" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Informacion</h4>
						</div>
						<div class="modal-body">
							<h3>¿Cerrar sesion?</h3>
						</div>
						<div class="modal-footer">
							<form class="navbar-form navbar-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			            <input type="hidden" name="cerrar_sesion">
									<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			            <button type="submit" class="btn btn-primary">Si</button>
			        </form>
						</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/datatables.js"></script> 
	<script src="js/bootstrap.min.js"></script>	
	<script src="js/documentos-ctrl.js"></script>
	<script>
		
	</script>

</body>
</html>