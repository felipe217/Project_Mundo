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

$conexion = new mysqli("localhost", "root", "", "mundo");


// Importando modulos SQL
require 'sql/Insertar_desde_admin.php';

// Invocando proceso de insercion
if(isset($_POST['save_user']))
	{
		// Empaquetando valores de los campos a guardar
		$Model = new Insertar_usuario;
		$Model->identificacion = addslashes($_POST['identificacion']);
		$Model->nombres = addslashes($_POST['nombres']);
		$Model->apellidos = addslashes($_POST['apellidos']);
		$Model->nacimiento = addslashes($_POST['nacimiento']);
		$Model->domicilio = addslashes($_POST['domicilio']);
		$Model->pais = addslashes($_POST['pais']);
		$Model->usuario = addslashes($_POST['usuario']);
		// Encriptando contrasena
		$Model->contrasena = sha1(htmlspecialchars($_POST['contrasena1']));
		$Model->cargo = addslashes($_POST['tipo']);
		// Ejecutando insercion a la base de datos
		$Model->Insertar();
	}


?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Usuarios</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/miEstilo.css">
     <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">


</head>
<body>

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

	<div id="new_user" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Formulario de inscripción para voluntarios</h4>
						</div>
						<div class="modal-body">
							<div class="panel-body">
								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<label>Nombre completo</label>
									<div class="row">
										<div class="form-group col-sm-6 grid-margin">
											<input type="text" name="nombres" class="form-control" id="txtNombres" placeholder="Nombres">
										</div>
										<div class="form-group col-sm-6 grid-margin">
											<input type="text" name="apellidos" class="form-control" id="txtApellidos" placeholder="Apellidos">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-6 grid-margin">
											<label>Numero de identificación</label>
											<input type="text" name="identificacion" class="form-control" id="txtId" placeholder="0000-0000-00000">
										</div>
										<div class="form-group col-sm-6 grid-margin">
											<label>Fecha de nacimiento</label>
											<input type="date" name="nacimiento" class="form-control" id="txtNacimiento" placeholder="">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-4 grid-margin">
											<label>País de origen</label>
											<select class="form-control" name="pais">
												<option>Seleciona un país</option>
												<option>Argentina</option>
												<option>Guatemala</option>
												<option>Honduras</option>
												<option>El salvador</option>
												<option>Otro</option>
											</select>
										</div>
										<div class="form-group col-sm-8 grid-margin">
											<label>Domicilio actual</label>
											<input type="text" name="domicilio" class="form-control" id="txtCiudad" placeholder="Describe tu Domicilio actual">
										</div>
									</div>

									<hr>
									<div class="row">
										<table class="mitabla">
											<tr>
												<td><label>Nombre de usuario: </label></td>
												<td><input type="text" name="usuario" class="form-control" placeholder="tu nombre de usuario"></td>
											</tr>
											<tr>
												<td><label>Contraseña de acceso: </label></td>
												<td><input type="password" name="contrasena1" class="form-control" placeholder="Contraseña"></td>
											</tr>
											<tr>
												<td><label>Confirma tu contraseña: </label></td>
												<td><input type="password" name="contrasena2" class="form-control" placeholder="Confirma tu contraseña"></td>
											</tr>
										</table>
									</div>
									<div class="row col-sm-6 col-sm-offset-3">
										<br>
										<center>
										<div class="form-group">
											<input type='hidden' name='save_user'>
											<button type="submit" class="btn btn-success">Guardar</button>
										</div>
										</center>
									</div>
								</form>
							</div>
						</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


























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
		        <li  >
		        	<a href="tablero.html">
		        	<span class="glyphicon glyphicon-scale" aria-hidden="true"></span>
					 Tablero
					</a>
				</li>
		        <li class="menu-activo">
		        	<a href="panelusuarios.php">
		        	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					 Usuarios
					</a>
				</li>
				<li >
		        	<a href="panelproyectos.html">
		        	<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
					  Proyectos
					</a>
				</li>
				<li>
		        	<a href="panelrecursos.html">
		        	<span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
					  Recursos
					</a>
				</li>
	      	</ul>



	      <ul class="nav navbar-nav navbar-right">

	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	           <img class="small-profile-pic img-circle" src="img/userprofile.jpg"> <?php echo $name ." ". $lastname; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="perfil.html">Configurar cuenta</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Acerca de</a></li>
	            <li role="separator" class="divider"></li>
	            <li>
								<a data-toggle="modal" data-target="#exit" >Cerrar sesión</a>
							</li>
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
			<div class="col-xs-12 col-lg-5 grid-margin">
				<div class="panel panel-default panel-cuadrado">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>   Administración de usuarios
					</div>
					<!--Inicio de panel izquierso -->
					<div class="panel-body">
					  	<div id="operaciones-proyectos">
					  		<div class="btn-group" role="group">
							  	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#new_user">
							  		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo
							 	</button>

							  	<!-- <button type="button" class="btn btn-default">
							    	<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Suspender
							  	</button> -->
							</div>
					  	</div>
					  	<br>
						    Listado de usuarios
						<br><br>
					    <div>
					    	<table class="table table-striped table-hover"  id="tabla-usuarios">
					    		<thead>
						    		<tr>
						    			<th>Codigo</th>
						    			<th>Nombre</th>
						    			<th>Tipo Usuario</th>
						    			<th>Departamento</th>
						    		</tr>
						    		</thead>
					    		<tbody>
										<?php
										$sql = "SELECT * FROM tblusuarios";
								    $resultado = $conexion->query($sql);
								    while($fila = $resultado->fetch_array())
								    {
								        echo "<tr>";
								        echo "<td>".$fila['codUsuario']."</td>";
								        echo "<td>".$fila['nombres']." ".$fila['apellidos']."</td>";
												echo "<td>".$fila['cargo']."</td>";
												echo "<td>".$fila['domicilio']."</td>";
								        echo "<tr>";
								    }



										?>





					    		</tbody>
					    	</table>
					    </div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-lg-7 grid-margin">
					<div class="panel with-nav-tabs panel-default panel-cuadrado">
					  <div class="panel-heading">
					  	<!--<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Proyecto: Nombre de proyecto-->
  						<ul class="nav nav-tabs">
  							<li><span class="glyphicon glyphicon-list-alt" aria-hidden="true" style="padding: 10px;"></span> Usuario: Nombre del usuario &nbsp;&nbsp;&nbsp;&nbsp;</li>
							<li class="active"><a  href="#1" data-toggle="tab">Datos generales</a></li>
							<li><a href="#2" data-toggle="tab">Cuenta</a></li>
							<li><a href="#3" data-toggle="tab">Proyectos</a></li>
						</ul>
					  </div>
					  <div class="panel-body">
						<div class="tab-content ">
							<br>
							<!-- tab 1-->
							<div class="tab-pane active" id="1">
 								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#">
								  	 	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Actualizar
								</button>
								<br><br>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Codigo:</label>
							    	<p class="col-md-9 control-label">0000</p>
							    </div>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Numero Identificación:</label>
							    	<p class="col-md-9 control-label">0000-0000-00000</p>
							    </div>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Nombres:</label>
							    	<p class="col-md-9 control-label">Nombres del usuario</p>
							    </div>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Apellido:</label>
							    	<p class="col-md-9 control-label">Apellidos del usuario</p>
							    </div>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Fecha de nacimiento:</label>
							    	<p class="col-md-9 control-label">dd/mm/aaaa</p>
							    </div>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Domicilio</label>
							    	<p class="col-md-9 control-label">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
							    </div>
							    <hr>
							    <div class="form-group">
							    	<label class="col-md-3 control-label">Tipo de usuario:</label>
							    	<p class="col-md-9 control-label">Tipo de usuario/acceso</p>
							    </div>
							     <div class="form-group">
							    	<label class="col-md-3 control-label">Departamento:</label>
							    	<p class="col-md-9 control-label">Departamento x</p>
							    </div>
							     <div class="form-group">
							    	<label class="col-md-3 control-label">Cargo:</label>
							    	<p class="col-md-9 control-label">Cargo x</p>
							    </div>
							    <hr><br><br>
							</div>
							<!-- tab 2-->
							<div class="tab-pane" id="2">
								 <div class="col-xs-12 col-sm-5">
								 	 <div class="form-group">
								    	<label class="  control-label">Nombre de usuario:</label>
								    	<p class="  control-label">Nombre de usuario</p>
								    </div>
								 </div>
								 <div class="col-xs-12 col-sm-7">
								 	<div class="btn-group" role="group" aria-label="...">
									  	<button type="button" class="btn btn-default">Reestablecer contraseña</button>

									 	<div class="btn-group" role="group">
									    	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnCambiaEstado">
									      	Activo
									      	<span class="caret"></span>
									    	</button>
									    	<ul class="dropdown-menu">
									      		<li><a id="activar" onclick="activarCuenta();">Activar</a></li>
									      		<li><a id="suspender" onclick="desactivarCuenta();">Suspender</a></li>
									    	</ul>
									    	<script type="text/javascript">
									    		function activarCuenta(){
									    			document.getElementById("btnCambiaEstado").textContent = "Activo"
									    			document.getElementById("btnCambiaEstado").className = "btn btn-success dropdown-toggle"
									    		}

									    		function desactivarCuenta(){
									    			document.getElementById("btnCambiaEstado").textContent = "Suspendido"
									    			document.getElementById("btnCambiaEstado").className = "btn btn-danger dropdown-toggle"
									    		}

									    	</script>
									  	</div>
									</div>
								 </div>
								 <div class="row">
								 	<div class="col-xs-12 col-md-12">
								 		<h5>Historial de actividad</h5>
										<table class="table table-striped" id="tabla-bitacora">
											<thead>
												<tr>
													<th>Fecha</th>
													<th>Actividad registrada</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>dd/mm/aaaa</td>
													<td>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</td>
												</tr>
												<tr>
													<td>dd/mm/aaaa</td>
													<td>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</td>
												</tr>
												<tr>
													<td>dd/mm/aaaa</td>
													<td>a aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</td>
												</tr>
											</tbody>
										</table>
								 	</div>
								 </div>
							</div>

							<!--Tab3-->
							<div class="tab-pane" id="3">
								<!-- <form class="form-inline">
								    	<select class="form-group selectpicker" data-live-search="true" multiple data-max-options="1" multiple size="3">
								    		<option>Proyecto 1</option>
								    		<option>Proyecto 2</option>
								    		<option>Proyecto 3</option>
								    		<option>Proyecto 4</option>
								    	</select>
								  	<button type="submit" class="btn btn-success">Asignar</button>
								</form> -->
								<table class="table table-striped"  id="tabla-proyectos-designados">
						    		<thead>
							    		<tr>
							    			<th>Codigo</th>
							    			<th>Nombre</th>
							    			<th>Tipo Proyecto</th>
							    			<th>Estado</th>
							    		</tr>
							    	</thead>
							    	<tbody>
							    		<tr>
							    			<td>0000</td>
							    			<td>Proyecto 0</td>
							    			<td>Tipo x</td>
							    			<td><span class="badge badge-proceso">En proceso</span></td>
							    		</tr>
							    		<tr>
							    			<td>0001</td>
							    			<td>Proyecto 1</td>
							    			<td>Tipo x</td>
							    			<td><span class=" badge badge-pendiente">Pendiente</span></td>
							    		</tr>
							    		<tr>
							    			<td>0002</td>
							    			<td>Proyecto 2</td>
							    			<td>Tipo x</td>
							    			<td><span class="badge">Terminado</span></td>
							    		</tr>
							    		<tr>
							    			<td>0003</td>
							    			<td>Proyecto 3</td>
							    			<td>Tipo x</td>
							    			<td><span class="badge">Terminado</span></td>
							    		</tr>
							    		<tr>
							    			<td>0004</td>
							    			<td>Proyecto 4</td>
							    			<td>Tipo x</td>
							    			<td><span class=" badge badge-pendiente">Pendiente</span></td>
							    		</tr>
							    		<tr>
							    			<td>0004</td>
							    			<td>Proyecto 4</td>
							    			<td>Tipo x</td>
							    			<td><span class=" badge badge-pendiente">Pendiente</span></td>
							    		</tr>
							    		<tr>
							    			<td>0004</td>
							    			<td>Proyecto 4</td>
							    			<td>Tipo x</td>
							    			<td><span class=" badge badge-pendiente">Pendiente</span></td>
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


</div>

	<script src="js/jquery.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="js/datatables.js"></script>
	<script type="text/javascript" src="js/inicializador.js"></script>


</body>
</html>
