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
	<title>Panel de recursos</title>
	<link rel="stylesheet" type="text/css" href="css/datatables.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/miEstilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

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
				<li class="menu-activo">
					<a href="panelrecursos.php">
					<span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
						Recursos 
					</a>
				</li>
				<li >
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
	            <li><a href="perfil.php?id=1">Configurar cuenta</a></li>
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
	 	<!-- Inicio de contenido-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 grid-margin">
				<div class="panel panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>   Mis Patrocinadores
					  </div>
					  <!--Inicio de panel izquierso -->
					  <div class="panel-body">
					  	<div id="operaciones-patrocinadores">
					  		<div class="btn-group" role="group" aria-label="...">
							  <button id="btnNuevoPatrocinador" type="button" class="btn btn-success" data-toggle="modal" data-target="#frmNuevoPatrocinador"> 
							  	 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
							  </button> 
							</div>
					  	</div>
					  	<br>					     
					    <div>
					    	<table class="table table-striped"  id="tabla-patrocinadores">
					    		<thead>
						    		<tr>
						    			<th>Código</th>
						    			<th>Nombre</th> 
						    		</tr>
						    	</thead>
						    	<tbody>
						    		<!-- <tr >
						    			<td>0000</td>
						    			<td>Nombre 1</td> 
						    		</tr>
						    		<tr>
						    			<td>0001</td>
						    			<td>Nombre 2</td> 
						    		</tr>
						    		<tr>
						    			<td>0003</td>
						    			<td>Nombre 3</td> 
						    		</tr> -->
						    	</tbody>
					    	</table>
					    </div>
					  </div>
					</div>	
			</div> <!-- Final del panel izquierdo-->

			<!-- Panel derecho-->
			<div>
				<div class="col-lg-8 grid-margin">
					<div class="panel with-nav-tabs panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<!--<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Proyecto: Nombre de proyecto-->
  						<ul class="nav nav-tabs">
  							<li><span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="padding: 10px;"></span> <label id="selectedTag">Nombre de patrocinador seleccionado</label>&nbsp;&nbsp;</li>
							<li class="active"><a  href="#1" data-toggle="tab">Información general</a></li>
							<li><a href="#2" data-toggle="tab">Contribuciones</a></li>
							<li><a href="#3" data-toggle="tab">Desembolsos</a></li>
						</ul>

					  </div>
					  <div class="panel-body">
						<div class="tab-content ">
						<br>
						<!-- tab 1-->
							<div class="tab-pane active" id="1"> 
								<div class="row">
									<div class="col-sm-10">
											<div class="btn-toolbar" role="toolbar"  >
												<div class="btn-group" role="group"  >
													<button type="button" id="btnEditar" class="btn btn-default" data-toggle="modal" data-target="#frmNuevoPatrocinador">
														<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
													</button>
												</div>
												<div class="btn-group" role="group"  >
													<button class="btn" type="button">
														Contribuciones <span class="badge" id="contribucionesCount">0</span>
													</button>
												</div> 
												<div class="btn-group" role="group"  >
													<button class="btn" type="button">
														Desembolsos <span class="badge" id="desembolsosCount">0</span>
													</button>
												</div>
												<div class="btn-group" role="group"  >
													<button class="btn" type="button">
														Disponible: <span class="badge" id="disponible">0</span>
													</button>
												</div> 
											</div> 
										<br>	<br>
									</div> 
								</div>
								<div class="row">
									<div class="col-lg-6">
										<table class="table table-condensed">
											<tr>
												<td><label>Nombre:</label></td>
												<td><label class="form-control" id="lblNombrePatrocinador"></label></td>
											</tr>
											<tr>
												<td><label>Procendencia:</label></td>
												<td><label class="form-control" id="lblProcedencia"></label></td>
											</tr>
											<tr>
												<td><label>Tipo patrocinador:</label></td>
												<td><label class="form-control" id="lblTipoPatrocinador"></label></td>
											</tr>
											<tr>
												<td><label>Ubicación:</label></td>
												<td><textarea class="form-control" rows="3" id="lblUbicacion" readonly></textarea> </td>
											</tr>
										</table>	
									</div>
									<div class="col-lg-6">
										<table class="table">
											<tr>
												<td colspan="2">Información de la persona de contacto:</td>
											</tr>
											<tr>
												<td><label>Nombre:</label></td>
												<td><label class="form-control" id="lblNombreContacto">Nombre de la persona</label></td>
											</tr>
											<tr>
												<td><label>correo:</label></td>
												<td><label class="form-control" id="lblCorreo"> </label></td>
											</tr>
											<tr>
												<td><label>Teléfono:</label></td> 
												<td><label class="form-control" id="lblTelefono" > </label> </td> 							    		
											</tr>
											 
										</table>
									</div> 
								</div>  	
							</div>

							<!--tab 2-->
							<div class="tab-pane" id="2">	 
								<table class="table table-striped"  id="tabla-patrocinios">
						    		<thead>
							    		<tr>
							    			<th>Codigo</th>
							    			<th>Fecha</th>
							    			<th>Tipo </th>
							    			<th>Valor</th>
							    			<th>Descripción</th>
							    		</tr>
							    	</thead>
							    	<tbody>
							    		 
							    	</tbody>
						    	</table>
							</div>
							<div class="tab-pane" id="3">
									<form class="form-inline">
										<div class="form-group">
											<select class="form-control" id="selProyectos">
												<option>Seleccione un proyecto</option> 
											</select>
										</div>
										<div class="form-group"> 
											<div class="input-group">
												<div class="input-group-addon">L. </div>
												<input type="text" class="form-control" id="txtMontoDesembolso" placeholder="500 lps máximo"> 
											</div>
										</div>
										<button type="button" id="btnGuardarDesembolso" class="btn btn-success">Agregar</button>
									</form>
							    <table class="table table-striped"  id="tabla-desembolsos">
						    		<thead> 
							    			<th>Codigo</th>
							    			<th>Fecha</th>
							    			<th>Monto</th> 
							    			<th>Proyecto</th>  
							    	</thead>
							    	<tbody>
							    	 
							    	</tbody>
						    	</table>
							</div>
							<div class="tab-pane" id="4">
								<h3>Lista de colaboradores</h3>
							</div>
						</div>

					  </div>
					 </div>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- ******************* VENTANAS MODALES ************************-->
	<!-- Formulario registro nuevo patrocinador -->
	<div id="frmNuevoPatrocinador" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Registro de nuevo patrocinador</h4>
					</div>
					<div class="modal-body">
							<form class="form-horizontal"> 
								<div class="form-group">
									<label class="col-sm-4 control-label">Nombre:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="txtNombrePatrocinador" placeholder="Nombre">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Procedencia: </label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="txtProcedencia" placeholder="Procedencia">
									</div>
								</div> 
								<div class="form-group">
										<label class="col-sm-4 control-label">Tipo de patrocinador: </label>
										<div class="col-sm-7">
											<select id="selTipoPatrocinador" class="form-control">
												<option value="0">Seleccione un tipo</option>
												<option value="Organizacion no gubernamental">Organizacion no gubernamental</option>
												<option value="Empresa Socialmente Responsable">Empresa socialmente responsable</option>
											</select>
										</div>
									</div> 
								<div class="form-group">
									<label class="col-sm-4 control-label">Ubicación: </label>
									<div class="col-sm-7">
										<textarea id="txtUbicacion" class="form-control"></textarea>
									</div>
								</div> 
								<div class="form-group">
									<label class="col-sm-4 control-label">Persona de contacto: </label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="txtPersonaContacto" placeholder="Nombre persona de contacto">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Correo electrónico: </label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="txtCorreoContacto" placeholder="correo electrónico">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Teléfono contacto: </label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="txtTelefono" placeholder="Telefono">
									</div>
								</div>
							</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnConfirmarEdit" class="btn btn-default">Confirmar</button> 
						<button type="button" id="btnGuardarNuevo" class="btn btn-default">Aceptar</button> 
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	
	<!-- /.modal -->

	<!-- Formulario de registro de nuevo patrocicio-->	
	<div id="frmNuevoPatrocinio" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title">Registo de nuevo patrocinio</h4>
	     	</div>
	     	<div class="modal-body">
	     		<form class="panel-formularios form-horizontal">
	     			<div class="form-group hidden">
					    <label class="col-sm-3 control-label">Fecha</label>
					    <div class="col-sm-9">
					      <input type="date" class="form-control" id="txtFecha" placeholder="dd/mm/aaaa" >
					    </div>
					 </div>
					 <div class="form-group">
					    <label class="col-sm-3 control-label">Tipo:</label>
					    <div class="col-sm-9">
					      	<select class="form-control" id="selTipoPatrocinio">
										<option value="0">Seleccione un tipo</option>
					      		<option value="Economico">Economico</option>
					      		<option value="Material">Material</option>
					      		<option value="Otro">Otro</option> 
					      	</select>
					    </div>
					 </div>
					 <div class="form-group">
					    <label class="col-sm-3 control-label">Valor:</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="txtValor" placeholder="00.00" >
					    </div>
					 </div>
					 <div class="form-group">
					    <label class="col-sm-3 control-label">Descripcion:</label>
					 </div>
					 <div class="form-group">
					    <div class="col-sm-12">
					      <textarea id="txtDescripcion" class="form-control" rows="4" cols="20"></textarea> 
					    </div>
					 </div>
	     		</form>
	     		
	     	</div>
	     	<div class="modal-footer">
	     		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<button type="button" id="btnGuardarPatrocinio" class="btn btn-success">Guardar</button>
	     	</div>
	    </div>
	  </div>
	</div>

	<!-- Formulario de registro de nuevo desembolso -->
	<div id="frmNuevoDesembolso" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">
			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <h4 class="modal-title">Registo de nuevo desembolso</h4>
			   </div>
			   <div class="modal-body">
				   <form class="panel-formularios form-horizontal">
					   <div class="form-group">
						  <label class="col-sm-3 control-label">Fecha:</label>
						  <div class="col-sm-9">
							<input type="date" class="form-control" id="txtFechaDesembolso" placeholder="dd/mm/aaaa" >
						  </div>
					   </div>
					   <div class="form-group">
						  <label class="col-sm-3 control-label">Tipo:</label>
						  <div class="col-sm-9">
								<select class="form-control" id="selTipoPatrocinio">
									<option value="Economico">Economico</option>
									<option value="Material">Material</option>
									<option value="Otro">Otro</option> 
								</select>
						  </div>
					   </div>
					   <div class="form-group">
						  <label class="col-sm-3 control-label">Valor:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="txtValor" placeholder="00.00" >
						  </div>
					   </div>
					   <div class="form-group">
						  <label class="col-sm-3 control-label">Descripcion:</label>
					   </div>
					   <div class="form-group">
						  <div class="col-sm-12">
							<textarea id="txtDescripcion" class="form-control" rows="4" cols="20"> </textarea> 
						  </div>
					   </div>
				   </form>
				   
			   </div>
			   <div class="modal-footer">
				   <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				  <button type="button" id="" class="btn btn-success">Guardar</button>
			   </div>
		  </div>
		</div>
	</div>

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
	<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.0.0/js/dataTables.rowGroup.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script> 
	<script src="js/validacion.js"></script>
	<script type="text/javascript" src="js/patrocinadores-init.js"></script>

</body>
</html>
