<?php

	class Patrocinadores{
		private $codPatrocinador;
		private $nombre;
		private $tipoPatrocinador;
		private $lugarProcedencia;		
		private $correoElectronico;
		private $nombreContacto;
		private $telefonoContacto;	
		private $direccion;	
		

		public function construir(
					$codPatrocinador,
					$nombre,
					$tipoPatrocinador,
					$lugarProcedencia,
					$correoElectronico,
					$nombreContacto,
					$telefonoContacto,
					$direccion
			){
			$this->codpatrocinador = $codPatrocinador;
			$this->nombre=$nombre;
			$this->tipoPatrocinador=$tipoPatrocinador;
			$this->lugarProcedencia=$lugarProcedencia;
			$this->correoElectronico=$correoElectronico;
			$this->nombreContacto=$nombreContacto;
			$this->telefonoContacto=$telefonoContacto;
			$this->direccion = $direccion;			
		}		

		public function setCodigo($codigo){
			$this->codPatrocinador= $codigo;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getTipoPatrocinador(){
			return $this->tipoPatrocinador;
		}
		public function setTipoPatrocinador($tipoPatrocinador){
			$this->tipoPatrocinador = $tipoPatrocinador;
		}
		public function getLugarProcedencia(){
			return $this->lugarProcedencia;
		}
		public function setLugarProcedencia($lugarProcedencia){
			$this->lugarProcedencia = $lugarProcedencia;
		}
		public function getCorreoElectronico(){
			return $this->correoElectronico;
		}
		public function setCorreoElectronico($correoElectronico){
			$this->correoElectronico = $correoElectronico;
		}
		public function getNombreContacto(){
			return $this->nombreContacto;
		}
		public function setNombreContacto($nombreContacto){
			$this->nombreContacto = $nombreContacto;
		}
		public function getTelefonoContacto(){
			return $this->telefonoContacto;
		}
		public function setTelefonoContacto($telefonoContacto){
			$this->telefonoContacto = $telefonoContacto;
		}			

		public function toJSON(){
        	return json_encode(get_object_vars($this));
    	}
		public function __toString(){
			return 	$this->nombre.','.
					$this->tipoPatrocinador.','.
					$this->lugarProcedencia.','.
					$this->correoElectronico.','.
					$this->nombreContacto.','.					
					$this->telefonoContacto;
		}
	}
?>