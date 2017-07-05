<?php
// Importando modulos SQL
require 'sql/Insertar_usuario.php';

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

		// Ejecutando insercion a la base de datos
		$Model->Insertar();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulario de inscripción de voluntarios</title>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="description" content="">
  	<meta name="author" content="">

  	<link href="css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="css/miEstilo.css">

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

	   
	  </div><!-- /.container-fluid -->
	</nav>
	<!--Fin de la barra de navegación-->

	<div class="container">
		<div class="row">
			<div class="panel panel-default panel-cuadrado col-xs-12 col-lg-6 col-lg-offset-3">
				<div class="panel-body">
					<center>
					<h4><span style="color:green;">Formulario de inscripción para voluntarios</span></h4>
					</center>
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
								<button type="submit" class="btn btn-success">Aceptar</button>
							</div>
							</center>
						</div>
						
					</form>
				</div>			
		</div>		
	</div>


</body>
</html>