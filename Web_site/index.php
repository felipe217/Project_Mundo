<?php
/*require 'sql/selectoperator.php';
require 'sql/selectsupervisor.php';
require 'sql/selectadministrator.php';
require 'sql/loginuser.php';

$conexion = new mysqli("mysql16.000webhost.com", "a7289093_root", "qwerty123", "a7289093_iwish");*/

require 'sql/loginuser.php';

$mensaje = null;

if(isset($_POST['login'])){
    $valid_user = $_POST['username'];
    $valid_pass = $_POST['password'];
    $valid_tipo = $_POST['tipo'];

    $var = new loginuser;
    $var->username = htmlspecialchars($_POST['username']);
    $var->password = sha1(htmlspecialchars($_POST['password']));
	  $var->login();
	  $mensaje = $var->mensaje;


}
?>






<!DOCTYPE html>
<html>
<head>
  <title>Bienvenido</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/miEstilo.css">

</head>
<body class="body">

  <div class="header-inicio">
      <br>
      <div class="container">
          <nav class="navbar ">
            <div class="container-fluid">
              <a class="a-link" href="http://www.unmundo.org/">Un Mundo</a>
              <a class="navbar-right a-link" href="#">Proyecto IS-802</a>
              <a class="navbar-right a-link" href="#">Contacto</a>
            </div><!-- /.container-fluid -->
          </nav>

        <!--Cajita del login -->
        <br>
        <div class="row-login">
          <div class="panel panel-default">
            <div class="panel-body">
            <center>
              <h4>Bienvenido a la plataforma de Administración de proyectos</h4>
              <br>
              <h4><span style="color: green">Iniciar Sesión</span></h4>
              <?php echo "<h2>$mensaje</h2>" ?>
              <br>
              <form method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Usuario">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                  </div>
                  <input type='hidden' name='login'>
                  <button type="submit" class="btn btn-primary">Ingresar</button>
                  <br><br>
                  <a href="#"><small>Reestablecer mi contraseña</small></a>

              </form>
              <hr>
              <a type="submit" class="btn btn-claro" href="inscripcionvoluntario.php" >Inscribirme como voluntario</a>
            </center>
            <br>
            </div>
          </div>
        </div>

      </div>
  </div>




   <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="img/pic1.jpg" alt="...">

        </div>
        <div class="item">
          <img src="img/pic3.jpg" alt="...">

        </div>
       </div>


     <!--  <! - - Controls ->-
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a> -->
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
