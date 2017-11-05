<!DOCTYPE html>

<?php
	//felipe, no se realmente como esta manejando lo de los accessos. 
	//pero para este caso, el archibo necesita recibir el codigo de usuario como parametro
	//get, para poder buscar la informacion del usuario en la base de datos. Por lo demás despreocupese, 
	//solo asegurese de que debe recibir el codigo de usuario logeado, como debería suceder en las demas paginas. 
	//variable que almacena el codigo del usuario
	$loggedUser = $_GET['id'];
	
?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Perfil</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/miEstilo.css"> 
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"> 
	<style type="text/css">
		
	</style> 
</head>
<body> 
	<!--Contenido de la pagina-->
		 <!-- Inicio de contenido-->
	<label id="receptor" ><?php echo $loggedUser; ?></label>
	<div class="container"> 
		<div class="row">
			<br>
			<div class="col-xs-12 col-md-9 col-lg-10 col-lg-offset-1 grid-margin">
					<div class="panel with-nav-tabs panel-primary panel-cuadrado">
					  	<div class="panel-heading">

					  		<!--<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Proyecto: Nombre de proyecto-->
					  		<center>	
									<br>
									<img src="images/steve-jobs.jpg" class="img-circle" width="140px" height="140px">			  		
									<br>
									<h3 id="userTag"></h3>
									<br>
									<ul class="nav nav-tabs">
										<li style="margin-right: 5px;"><a href="panelproyectos.html" type="button" class="btn btn-primary" aria-label="Right Align">
										<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Volver a mis proyectos 
										</a>
										</li>
										<li class="active"><a  href="#1" data-toggle="tab">Mis datos personales</a></li>
										<li><a href="#2" data-toggle="tab">Actividad reciente</a></li>
									</ul>
								</center>							
					  	</div>
					  	<div class="panel-body">
							<div class="tab-content ">							
							<br>
								<div class="tab-pane active" id="1">
							    <!-- tab 1-->
							    	<button type="button" class="btn btn-default" id="btnActualizarPerfil">
								  	 	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
									</button>
									<br><br>
								  <div class="col-sm-8 col-sm-offset-2">
										<form class="form-horizontal">
											<div class="form-group">
												<label  class="col-sm-4 control-label">Nombre de usuario:</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtUserName" readonly placeholder="Nombre Usuario">
												</div>
											</div>
											<div class="form-group">
												<label  class="col-sm-4 control-label">País de residencia: </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtPais" readonly placeholder="País">
												</div>
											</div> 
											<div class="form-group">
												<label  class="col-sm-4 control-label">Departamento: </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtDepartamento" readonly placeholder="Departamento">
												</div>
											</div> 
											<div class="form-group">
												<label  class="col-sm-4 control-label">Cargo: </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtCargo" readonly placeholder="Cargo">
												</div>
											</div>
											<div class="form-group hiddengroup hidden">
												<label  class="col-sm-4 control-label">Contraseña: </label>
												<div class="col-sm-8">
													<input type="password" class="form-control" id="txtContrasena" placeholder="Contraseña">
												</div>
											</div>
											<div class="form-group hiddengroup hidden" >
												<label  class="col-sm-4 control-label">Confirmar Contraseña: </label>
												<div class="col-sm-8">
													<input type="password" class="form-control" id="txtContrasenaConfirm" placeholder="Contraseña">
												</div>
											</div>
											<div class="form-group pull-right">
												<div class="btn-toolbar" role="toolbar">
													<div class="btn-group" role="group" aria-label="...">
														<button type="button" id="btnCancelarGuardar" class="btn btn-default hiddengroup hidden">Cancelar</button>
													</div>
													<div class="btn-group" role="group" >
														<button type="button" id="btnGuardarCambios" class="btn btn-success hidden">Guardar cambios</button>
													</div> 
												</div> 
											</div>
										</form> 
									</div> 
								</div> 
								<!--Tab4-->
								<div class="tab-pane" id="2">
									<table class="table table-striped"  id="tabla-actividad">
							    		<thead>
								    		<tr>
								    			<th>#</th>
								    			<th>Fecha</th>
								    			<th>Nombre_usuario</th>
								    			<th>Proyecto</th>
								    			<th>Actividad</th>
								    		</tr>
								    	</thead>
								    	<tbody>
								    		<tr>
								    			<td>1</td>
								    			<td>dd/mm/aaaa</td>
								    			<td>Usuario x</td>
								    			<td>Proyecto x</td>
								    			<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</td>
								    		</tr>
								    		<tr>
								    			<td>1</td>
								    			<td>dd/mm/aaaa</td>
								    			<td>Usuario x</td>
								    			<td>Proyecto x</td>
								    			<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</td>
								    		</tr>
								    		
								    	</tbody>
							    	</table>
								</div>
							</div>
						</div>
					 </div>
			</div>
		</div>
	 
	</div>
		  
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/perfil-ctrl.js"></script>

</body>
</html>