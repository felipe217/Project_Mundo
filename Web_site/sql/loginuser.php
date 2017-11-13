<?php
require 'Conexion.php';

class loginuser{

    public $username;
    public $password;
    public $mensaje;
    public $tipoUsuario;

    public function login(){

        $model = new Conexion;
        $conexion = $model->conectar();
        $sql = 'SELECT * FROM tblUsuarios WHERE usuario=:username AND contrasena=:password';
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':username', $this->username, PDO::PARAM_STR);
        $consulta->bindParam(':password', $this->password, PDO::PARAM_STR);
        $consulta->execute();
        $total = $consulta->rowCount();

        if($total == 0)
            {
                $this->mensaje = 'Error al iniciar sesion, datos incorrectos :(';
            }
        else
            {
                $fila = $consulta->fetch();
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['tipo'] = $fila['codTipoUsuario'];
                $_SESSION['username'] = $fila['usuario'];
                $_SESSION['name'] = $fila['nombres'];
                $_SESSION['lastname'] = $fila['apellidos'];

                if($_SESSION['tipo'] == 1){
                  header('location: panelusuarios.php');
            		}
                else{
                  header('location: perfil.php?id='.$fila['codUsuario']);
                }
            }
    }
}
?>
