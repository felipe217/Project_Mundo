<?php

require 'sql/Conexion.php';

class Insertar_usuario{
    public $identificacion;
    public $nombres;
    public $apellidos;
    public $nacimiento;
    public $domicilio;
    public $pais;
    public $cargo = "Voluntario";
    public $usuario;
    public $contrasena;
    public $codTipoUsuario = 2;
    
    public function Insertar(){
        
        $model = new Conexion();
        $conexion = $model->conectar();

        $sql = "INSERT INTO tblUsuarios (identificacion, nombres, apellidos, nacimiento, domicilio, pais, cargo, usuario, contrasena, codTipoUsuario) VALUES ";
        $sql .= "(:identificacion, :nombres, :apellidos, :nacimiento, :domicilio, :pais, :cargo, :usuario, :contrasena, :codTipoUsuario)";

        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':identificacion', $this->identificacion);
        $consulta->bindParam(':nombres', $this->nombres);
        $consulta->bindParam(':apellidos', $this->apellidos);
        $consulta->bindParam(':nacimiento', $this->nacimiento);
        $consulta->bindParam(':domicilio', $this->domicilio);
        $consulta->bindParam(':pais', $this->pais);
        $consulta->bindParam(':cargo', $this->cargo);
        $consulta->bindParam(':usuario', $this->usuario);
        $consulta->bindParam(':contrasena', $this->contrasena);
        $consulta->bindParam(':codTipoUsuario', $this->codTipoUsuario);
        $consulta->execute(); 

        // Redireccionando despues de la insercion
        header('location: panelproyectos.php');     
    }
}

?>

