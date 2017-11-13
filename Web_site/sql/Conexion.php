<?php

class Conexion{
    
    public function conectar(){
             
    $usuario = 'root';
    //$password = 'Turingenigma2017';
    $password = '';
    $host = 'localhost';
    $db = 'Mundo';
    
    return $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
    }
    
}

?>