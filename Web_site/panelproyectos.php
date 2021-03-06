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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Panel de administración de proyectos</title> 
	<link rel="stylesheet" type="text/css" href="css/datatables.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/miEstilo.css"> 
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css"> 
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	

     <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

</head>
<body>

	<!--Barra de navegacion -->
	<nav class="navbar  navbar-default">
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
				<li class="menu-activo">
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
	           <img class="small-profile-pic img-circle" src="img/userprofile.jpg">  <?php echo $name ." ". $lastname; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="perfil.php?id=1">Configurar cuenta</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Acerca de</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a data-toggle="modal" data-target="#exit" >Cerrar sesión</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<!--Fin de la barra de navegación-->

	<!-- Inicio de contenido-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-sm-5 grid-margin">
				<div class="panel panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>   Mis proyectos
					  </div>
						<!--Inicio de panel izquierso -->
					  <div class="panel-body">
						<button type="button" class="btn btn-success" id="btn-nuevoProyecto" data-toggle="modal" data-target="#frmNuevoProyecto">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
							</button>
					  	 <br>
					    <div>
					    	<table class="table table-striped  "  id="tabla-proyectos">
					    		<thead>
						    		<tr>
						    			<th width="20%">Codigo</th>
						    			<th width="50%">Nombre</th>
						    			<th width="30%">Estado</th>
						    		</tr>
						    	</thead>
						    	<tbody id="tablaProyectosBody">
						    	
						    	</tbody>
					    	</table>
					    </div>
					  </div>
					</div>	
			</div> 
			<!-- Final del panel izquierdo-->

			<!-- Panel derecho       -->
			<div>
				<div class="col-lg-8 col-sm-7 grid-margin">
					<div class="panel with-nav-tabs panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<!--<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Proyecto: Nombre de proyecto-->
  						<ul class="nav nav-tabs">
							 <li><span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="padding: 10px;"></span>
								<label id="projectTag">Nombre del proyecto</label> &nbsp;&nbsp;&nbsp;&nbsp;
							</li>
							<li class="active"><a  href="#tab1" data-toggle="tab">Datos de proyecto</a></li>
							<li><a href="#2" data-toggle="tab">Operaciones y actividades</a></li>
							<li><a href="#3" data-toggle="tab">Materiales</a></li>
							<li><a href="#4" data-toggle="tab">Colaboradores</a></li>
						</ul>

					  </div>
					  <div class="panel-body">
						<div class="tab-content ">
						<br> 
							<!--Inicio del tab1 informacion de proyecto seleccionado +++++++++ -->
							<!--Inicio del tab1  +++++++++ --> 
							<div class="tab-pane active" id="tab1">
								<div id="operaciones-proyectos">
							  		<div class="btn-group" role="group" >
									  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmNuevoProyecto" onclick="editarProyecto();" >
									  	 <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
									  </button>
									</div>
									<div class="btn-group"role="group">										
										<button class="btn" type=" ">
											Tareas <span class="badge" id="tareasCount">0</span>
										</button>
									</div>  
									<div class="btn-group"role="group">										
										<button class="btn" type=" ">
											Materiales <span class="badge" id="materialesCount">0</span>
										</button>
									</div>  
									<div class="btn-group"role="group">										
										<button class="btn" type=" ">
											Colaboradores <span class="badge" id="colaboradoresCount">0</span>
										</button>
									</div>  									
							  	</div>
							  	<br>
							    <div class="col-lg-6">
							    	<table class="table table-condensed">
							    		<tr>
							    			<td><label>Codigo:</label></td>
							    			<td><label class="form-control" id="lblCodProyecto"></label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Nombre:</label></td>
							    			<td><label class="form-control" id="lblNomProyecto">Nombre del proyecto</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Fecha inicio:</label></td>
							    			<td><label class="form-control" id="lblInicioProy"> dd/mm/aaaa</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Fecha final:</label></td>
							    			<td><label class="form-control" id="lblFinalProy"> dd/mm/aaaa</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Lugar de ejecución:</label></td>
							    			<td><label class="form-control" id="lblLugar"> dd/mm/aaaa</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Responsable:</label></td>
							    			<td><label class="form-control" id="lblResponsable">Nombre del responsable</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Beneficiario directo:</label></td>
							    			<td><label class="form-control" id="lblBeneficiario"> Nombre del beneficiario</label></td>
							    		</tr>
							    	</table>	
							    </div>
							    <div class="col-lg-6">
							    	<table class="table">
							    		<tr>
							    			<td><label>Costo estipulado:</label></td>
							    			<td><label class="form-control" id="lblCosto"> 0000.00</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Descripción:</label></td>
							    			<td><textarea class="form-control" rows="3" id="lblDescripcion" readonly></textarea class="form-control"> </td>
							    		</tr>
							    		<tr>
							    			<td><label>Tipo de proyecto:</label></td>
							    			<td><label class="form-control" id="lblTipoProyecto"> Tipo de proyecto</label></td>
							    		</tr>
							    		<tr>
							    			<td><label>Estado actual:</label></td> 
							    			<td><label class="form-control" id="lblEstado" name"" > </label> </td> 							    		</tr>
							    		<tr>
							    			<td class="tr-patrocinadores" colspan="2" size="1" id="tr-patrocinadoresxproyecto"> 
							    			</td>
							    		</tr>
							    	</table>
							    </div>
							</div>
							<!--Inicio del tab2  tareas de proycto selecconado +++++++++ -->
							<div class="tab-pane" id="2">
								<div id="operaciones-proyectos">
							  		<div class="btn-group" role="group" aria-label="">
									  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#frmNuevaTarea" id="btnNuevaTarea"> 
									  	 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva
									  </button>
									  <button type="button" onclick="editarTarea();" class="btn btn-default" data-toggle="modal" data-target="#frmNuevaTarea">
									  	 <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
									  </button>
									  <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#frmComentarios">
								    	<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comentar</button>
								      </button> -->
									</div>
							  	</div>
								<br>
								<table class="table table-striped" id="tabla-tareas">
							    	<thead>
								    	<tr>
								    		<th>Código</th>
								    		<th>Tarea</th>
								    		<th>Prioridad</th>
								    		<th>Fecha inicio</th>
								    		<th>Fecha final</th>
								    		<th>Responsables</th>
								    	</tr>
								    </thead>
								    <tbody>
								    	<!-- <tr>
								    		<td>1</td>
								    		<td>Tarea 1</td>
								    		<td>Urgente</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>Usuario1, usuario2, usuario3</td>
								    	</tr>
								    	<tr>
								    		<td>2</td>
								    		<td>Tarea 2</td>
								    		<td>Urgente</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>Usuario1, usuario2, usuario3</td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Tarea 3</td>
								    		<td>Urgente</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>Usuario1, usuario2, usuario3</td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Tarea 3</td>
								    		<td>Urgente</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>Usuario1, usuario2, usuario3</td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Tarea 3</td>
								    		<td>Urgente</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>Usuario1, usuario2, usuario3</td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Tarea 3</td>
								    		<td>Urgente</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>dd/mm/aaaa</td>
								    		<td>Usuario1, usuario2, usuario3</td>
								    	</tr> -->
								    </tbody>
							    </table>
							</div>
							<!--Inicio del tab3  materiles del proyecto seleccionado+++++++++ -->
							<div class="tab-pane" id="3">
							    <div id="operaciones-proyectos">
									<button type="button" id="btnNuevoMaterial" class="btn btn-success" data-toggle="modal" data-target="#frmNuevoMaterial"> 
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
									</button>
							  		<div class="btn-group" role="group" aria-label="">
									  
									  <button type="button" class="btn btn-default hidden"data-toggle="modal" data-target="#frmNuevoMaterial">
									  	 <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
									  </button>
									</div>
							  	</div>
								<br>
								<table class="table table-striped" id="tabla-materiales">
							    	<thead>
								    	<tr>
								    		<th>Cod</th>
								    		<th>Proveedor</th>
								    		<th>Material</th>
								    		<th>Unidades</th>
								    		<th>Precio Uni</th>
								    		<th>Total</th>
								    	</tr>
								    </thead>
								    <tbody>
								    	<!-- <tr>
								    		<td>1</td>
								    		<td>Material 1</td>
								    		<td>Proveedor x</td>
								    		<td>10</td>
								    		<td>0.00</td>
								    		<td>0.00</td>
								    	</tr>
								    	<tr>
								    		<td>2</td>
								    		<td>Material 2</td>
								    		<td>Proveedor x</td>
								    		<td>200</td>
								    		<td>0.00</td>
								    		<td>0.00</td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Material 3</td>
								    		<td>Proveedor y</td>
								    		<td>400</td>
								    		<td>0.00</td>
								    		<td>0.00</td>
								    	</tr> -->
								    </tbody>
							    </table>
							</div>
							<!--Inicio del tab4 colaboradores del proyecto seleccionado +++++++++ -->
							<div class="tab-pane" id="4"> 
								<div id="operaciones-proyectos">
									<div class="col-sm-4 grid-margin">
										<div class="btn-toolbar" role="toolbar" >
											<div class="btn-group" role="group" >
													<button type="button" class="btn btn-info" id="btnAgregarColaborador" > 
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
													</button> 
											</div>
											<div class="btn-group" role="group"  > 
													<button type="button" class="btn btn-default" id="btnActualizarColaborador">
														<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
													</button>
											</div> 
										</div>
									</div>
									<div class="col-sm-2 grid-margin">
										<div class="btn-group" role="group" >
											<select class="form-control hidden" id="selUsuariosProyecto">
												<option>Selec. uno</option> 
											</select>
										</div>
									</div>
									<div class="col-sm-5 grid-margin">
										<div class="input-group hidden" id="rolTextGroup">
											<input type="text" class="form-control" placeholder="Indica un rol" id="txtRolColaborador">
											<input type="hidden" class="" id="txtCodOculto">
											<div class="input-group-btn">
												<button class="btn btn-default " type="button" id="btnRegistrarColaborador"><i class="fa fa-check" aria-hidden="true"></i></button>
												<button class="btn btn-default" type="button" id="btnOcultarRolText"><i class="fa fa-times" aria-hidden="true"></i></button>
											</div> 
										</div>
									</div>						  	
							  </div>
								<br>	<br>
								<table class="table table-striped" id="tabla-colaboradores">
							    	<thead>
								    	<tr>
								    		<th>Codigo</th>
								    		<th>Nombre Usuario</th>
								    		<th>Tipo Usuario</th>
								    		<th>Departamento</th>
								    		<th>Cargo</th>
								    		<th>Rol de proyecto</th>
								    	</tr>
								    </thead>
								    <tbody>
								    	<!-- <tr>
								    		<td>1</td>
								    		<td>Usuario 1</td>
								    		<td>Voluntario</td>
								    		<td>Ninguno</td>
								    		<td>Ninguno</td>
								    		<td>Rol 1</td>
								    	</tr>
								    	<tr>
								    		<td>2</td>
								    		<td>Usuario 2</td>
								    		<td>Empleado</td>
								    		<td>Departamento x</td>
								    		<td>Cargo 1</td>
								    		<td>Ninguno</td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Usuario 3</td>
								    		<td>Empleado</td>
								    		<td>Departamento y</td>
								    		<td>Cargo 2</td>
								    		<td>Rol 2</td>
								    	</tr> -->
								    </tbody>
							    </table>
							</div>
						</div>

					  </div>
					 </div>
				</div>
			</div>
		</div>
	</div>
		
	<!--VENTANAS MODALES -->
	<!-- Large modal ventana frmNuevoProyecto, es el formulario para registrar un nuevo proyecto-->
	<div id="frmNuevoProyecto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	     	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title">Registo de nuevo proyecto</h4>
	     	</div>
	     	<!-- CONTENIDO DEL FORMULARIO -->
	     	<div class="modal-body">
	     	<form class="panel-formularios">
		     	<div class="row ">
		     		<div class="col-lg-8 ">
		     			<div class="row">
						  	<div class="form-group col-lg-4">
							    <label>Código de proyecto</label>
							    <input type="text" class="form-control" id="txtCode" placeholder="Codigo de proyecto" readonly>
						  	</div>
						  	<div class="form-group col-lg-4">
						    	<label >Tipo de proyecto</label>
						    		<select class="form-control" id="selTipoProyecto"> 
									    <option>Selec. un tipo</option>  
								 	</select>	
						  	</div>
						  	<div class="form-group col-lg-4">
						    	<label  >Estado actual</label>
							    	<select class="form-control" id="selEstados"> 
								    	<option>Seleccione un estado</option> 
								 	</select>	
						  	</div>
					  	</div>
					  	<div class="row">
						  	<div class="form-group col-xs-12">
						    	<label for="exampleInputEmail1">Nombre del proyecto</label>
						    	<input type="text" class="form-control" id="txtNomProyecto" placeholder="Nombre proyecto (25 caracteres max)">
						  	</div> 
					  	</div>
					  	<div class="row">
						  	<div class="form-group col-lg-4">
							    <label >Lugar de ejecución</label>
							    <input type="text" class="form-control" id="txtLugar" placeholder="Lugar donde se ejecuta">
						  	</div>
						  	<div class="form-group col-lg-4">
							    <label>Fecha de inicio</label>
							    <input type="text" class="form-control" id="txtFechaInicio" placeholder="dd/mm/aaaa" readonly>
						  	</div>
						  	<div class="form-group col-lg-4">
							    <label>Fecha final</label>
							    <input type="text" class="form-control" id="txtFechaFinal" placeholder="dd/mm/aaaa" readonly>
						  	</div>
					  	</div>
					  	<div class="row">
						  	<div class="form-group col-lg-6">
							    <label >Responsable de proyecto</label>
							    <input type="text" class="form-control" id="txtResponsable" placeholder="Nombre de responsable de proyecto">
						  	</div>
						  	<div class="form-group col-lg-6">
							    <label>Beneficiario directo</label>
							    <input type="text" class="form-control" id="txtBeneficiario" placeholder="Nombre  de beneficiario directo">
						  	</div>
					  	</div>
					  	
		     		</div>
		     		<div class="col-lg-4 ">
					  	<div class="form-group">
					  		<label>Costo estimando</label>
						    <label class="sr-only">Amount</label>
						    <div class="input-group">
						      	<div class="input-group-addon">L. </div>
						      	<input type="text" class="form-control" id="txtCosto" placeholder="Cantidad">
						    </div>
						 </div>
					  	<div class="form-group">
					    	<label  >Patrocinadores:</label>
					    		<select  class="form-control selectpicker " data-live-search="true" id="selPatrocinadores" multiple> 
								</select>	
					  	</div> 
					  	<div class="row">
					  		<div class="form-group col-xs-12">
							  <label>Descripción:</label>
							  <textarea class="form-control" rows="5" id="txtDescripcion" placeholder="Escriba una descripcion o comentario"></textarea>
							</div>
					  	</div>
		     		</div>
		     	</div>
		    </form>	
	     	</div>
	     	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" id="btnCancelarGuardar" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-success" id="btnGuardarProyecto">Guardar</button>
						<button type="button" class="btn btn-default hidden" id="btnCancelarEdicion" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-success hidden" id="btnActualizarProyecto">Actualizar</button>
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Ventana modal para ver y agregar comentarios -->
	<div id="frmComentarios" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        				<h4 class="modal-title">Comentarios</h4>
      			</div>
      			<div class="caja-comentarios">
      				<div class="modal-body">
      				
        			<ul class="list-group">
					  <li class="list-group-item">
						<div class="media">
						  <div class="media-left">
						    <a href="#">
						      <img class="media-object small-profile-pic img-circle img-circle" src="img/userprofile.jpg" alt="...">
						    </a>
						  </div>
						  <div class="media-body">
						     <h5 class="media-heading">Nombre de persona     <small>     08/06/2017 10:00pm</small></h5>
						    <h6>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</h6>
						  </div>
						</div>
					  </li>
					  <li class="list-group-item">
						<div class="media">
						  <div class="media-left">
						    <a href="#">
						      <img class="media-object small-profile-pic img-circle" src="images/profile-pics/jobs.jpg" alt="...">
						    </a>
						  </div>
						  <div class="media-body">
						     <h5 class="media-heading">Nombre de persona     <small>     08/06/2017 10:00pm</small></h5>
						    <h6>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</h6>
						  </div>
						</div>
					  </li>
					  <li class="list-group-item">
						<div class="media">
						  <div class="media-left">
						    <a href="#">
						      <img class="media-object small-profile-pic img-circle" src="img/userprofile.jpg" alt="...">
						    </a>
						  </div>
						  <div class="media-body">
						     <h5 class="media-heading">Nombre de persona     <small>     08/06/2017 10:00pm</small></h5>
						    <h6>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</h6>
						  </div>
						</div>
					  </li>
					  <li class="list-group-item panel-formularios">
						<div class="media">
						  <div class="media-left">
						    <a href="#">
						      <img class="media-object small-profile-pic img-circle" src="img/userprofile.jpg" alt="...">
						    </a>
						  </div>
						  <div class="media-body">
						    <form>
	      						<div class="form-group">
								    <h5 class="media-heading"><b>Nombre de persona &nbsp;</b><small>&nbsp;08/06/2017 10:00pm</small></h5>
								     <textarea class="form-control" rows="2" id="txtDescripcion" placeholder="Escriba una descripcion o comentario"></textarea>
								     <button type=" " class="btn btn-default">Comentar</button>
								  </div>
							  	<div class="form-group">
							  		
							  	</div>
      						</form>
						  </div>
						</div>
					  </li>

					</ul>
      			</div>
      			
					
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>      			
        		</div>
    		</div><!-- /.modal-content -->
  		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<!-- Ventana modal frmNuevaTarea para registrar nueva tarea-->
	<div id="frmNuevaTarea" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title">Registro de nueva tarea</h4>
		      	</div>
		      	<div class="modal-body">
		        	<form class="panel-formularios">
		        		<div class="row">
		        			<div class="form-group col-xs-12 col-md-4">
					    		<label>Código de tarea</label>
					    		<input type="text" class="form-control" id="txtCodTarea" placeholder="000000" readonly>
					  		</div>
					  		<div class="form-group  col-xs-12 col-md-4">
					    		<label>Código de proyecto</label>
					    		<input type="text" class="form-control" id="txtTareaCodProyecto" placeholder="000000" readonly>
					  		</div>
					  		<div class="form-group col-xs-12 col-md-4">
					  			<label>Prioridad</label>
								  <select class="form-control" id="selPriodidades">
									<option value="0">Seleccione una</option>
									<option value="ALTA">ALTA</option>
									<option value="MEDIA">MEDIA</option>
									<option value="BAJA">BAJA</option>							    
								 </select>	 
					  		</div>
		        		</div>
		        		<div class="row">
		        			<div class="form-group col-xs-12 col-md-4">
		        				<label>Nombre de tarea</label>
		        				<input type="text" id="txtNomTarea" class="form-control" placeholder="Nombre de la tarea">
		        			</div>
		        			<div class="form-group col-xs-12 col-md-4">
		        				<label>Fecha de inicio</label>
		        				<input type="text" id="txtTareaInicio" class="form-control" placeholder="Seleccione fecha" readonly>
		        			</div>
		        			<div class="form-group col-xs-12 col-md-4">
		        				<label>Fecha de entrega</label>
		        				<input type="text" id="txtTareaEntrega" class="form-control" placeholder="Seleccione fecha" readonly>
		        			</div>
		        		</div>
		        		<div class="row">
		        			<div class="form-group col-xs-12 col-md-6">
		        				<label>Descripción</label>
		        				<textarea class="form-control" id="txtTareaDesc" placeholder="Escriba una descripcion" rows="2"></textarea>
		        			</div>
		        			<div class="form-group col-xs-12 col-md-6">
		        				<label>Responsables</label>		 
		        				<select class="form-control selectpicker" id="selUsuarios" data-live-search="true" multiple>
		        					<option value="0">Seleccione uno </option> 
		        				</select>       				
		        			</div>
		        		</div>
		        	</form>
		      	</div>
		      	<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success hidden" id="btnActualizarTarea">Actualizar</button>
		        	<button type="button" class="btn btn-success" id="btn-guardar-tarea">Guardar</button>
		      	</div>
	    	</div><!-- /.modal-content -->
	  	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Ventana modal frmNuevoMaterial para registrar nueva tarea-->
	<div id="frmNuevoMaterial" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Registro de nuevo material</h4>
				</div>
				<div class="modal-body">
					<form class="panel-formularios">
						<div class="row">
							<div class="form-group hidden col-xs-12 col-md-4">
								<label>Código de ingreso</label>
								<input type="text" class="form-control" id="txtCodIngreso" placeholder="000000" readonly>
							</div>
							<div class="form-group hidden  col-xs-12 col-md-4">
								<label>Código de proyecto</label>
								<input type="text" class="form-control" id="txtTareaCodProyecto" placeholder="000000" readonly>
							</div>
							<div class="form-group   col-xs-12 col-md-4">
								<label>Fecha de asignación</label>
								<input type="date" class="form-control" id="txtMatFecha" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-12 col-md-6">
								<label>Proveedor:</label>
								<input type="text" class="form-control" id="txtProveedor" placeholder="Ingrese nombre de Proveedor">
							</div>
							<div class="form-group col-xs-12 col-md-6">
									<label>Material:</label>
								<input type="text" class="form-control" id="txtMaterial" placeholder="Ingrese nombre de material">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-12 col-md-4">
								<label>Unidades:</label>
								<input type="number" class="form-control" id="txtMatUnidades" placeholder="Cantidad">
							</div>
							<div class="form-group col-xs-12 col-md-4">
								<label>Precio unidad:</label>
								<input type="number" class="form-control" id="txtPrecioUnidad" placeholder="0.00">
							</div>
							<div class="form-group col-xs-12 col-md-4">
								<label>Total</label>
								<input type="number" class="form-control" id="txtMatTotal" placeholder="0.00">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnConfirmarMaterial" class="btn btn-success">Guardar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

		<!-- Ventana modal frmNuevoColaborador para registrar un nuevo colaborador-->
	<div id="frmNuevoColaborador" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Registro de nuevo Colaborador</h4>
				</div>
				<div class="modal-body">
					<form class="panel-formularios">
						<div class="row">
							<div class="form-group hidden col-xs-12 col-md-4">
								<label>Código de ingreso</label>
								<input type="text" class="form-control" id="txtCodIngreso" placeholder="000000" readonly>
							</div>
							<div class="form-group hidden  col-xs-12 col-md-4">
								<label>Código de proyecto</label>
								<input type="text" class="form-control" id="txtTareaCodProyecto" placeholder="000000" readonly>
							</div>
							<div class="form-group   col-xs-12 col-md-4">
								<label>Fecha de asignación</label>
								<input type="date" class="form-control" id="txtMatFecha">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-12 col-md-6">
								<label>Proveedor:</label>
								<input type="text" class="form-control" id="txtProveedor" placeholder="Ingrese nombre de Proveedor">
							</div>
							<div class="form-group col-xs-12 col-md-6">
								<label>Material:</label>
								<input type="text" class="form-control" id="txtMaterial" placeholder="Ingrese nombre de material">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-xs-12 col-md-4">
								<label>Unidades:</label>
								<input type="number" class="form-control" id="txtMatUnidades" placeholder="Cantidad">
							</div>
							<div class="form-group col-xs-12 col-md-4">
								<label>Precio unidad:</label>
								<input type="number" required name="price" step=".01" class="form-control" id="txtPrecioUnidad" placeholder="0.00">
							</div>
							<div class="form-group col-xs-12 col-md-4">
								<label>Total</label>
								<input type="number" required name="price" pattern="^\d+(\.|\,)\d{2}$" class="form-control" id="txtMatTotal" placeholder="0.00">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnConfirmarColaborador" class="btn btn-success">Guardar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
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

	<script src="js/jquery.js"></script>
	<script src="js/datatables.js"></script>     
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script> 
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
	<script src="js/validacion.js"></script>
	<script type="text/javascript" src="js/inicializador.js"></script>	 

</body>
</html>