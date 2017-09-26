<?php

	class Proyecto{
		private $codProyecto;
		private $nombreProyecto;
		private $fechaInicio;		
		private $fechaFinal;
		private $lugar;
		private $descripcion;
		private $costoEstimado;
		private $beneficiario;
		private $estado;
		private $responsable;

		public function construir(
					$codigo,
					$nombreProyecto,
					$fechaInicio,
					$fechaFinal,
					$lugar,
					$descripcion,
					$costoEstimado,
					$beneficiario, 
					$estado
			){
			$this->codProyecto=$codigo;
			$this->nombreProyecto=$nombreProyecto;
			$this->fechaInicio=$fechaInicio;
			$this->fechaFinal=$fechaFinal;
			$this->lugar=$lugar;
			$this->descripcion=$descripcion;
			$this->costoEstimado=$costoEstimado;
			$this->beneficiario=$beneficiario;
			$this->estado = $estado;
			
		}		

		

		public function setCodProyecto($code){
			$this->codProyecto = $code;
		}

		public function getCodProyecto(){
			return $this->codProyecto;
		}
		public function getNombreProyecto(){
			return $this->nombreProyecto;
		}
		public function setEstado($estado){
			$this->estado= $estado;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setNombreProyecto($nombreProyecto){
			$this->nombreProyecto = $nombreProyecto;
		}
		public function getFechaInicio(){
			return $this->fechaInicio;
		}
		public function setFechaInicio($fechaInicio){
			$this->fechaInicio = $fechaInicio;
		}
		public function getFechaFinal(){
			return $this->fechaFinal;
		}
		public function setFechaFinal($fechaFinal){
			$this->fechaFinal = $fechaFinal;
		}
		public function getLugar(){
			return $this->lugar;
		}
		public function setLugar($lugar){
			$this->lugar = $lugar;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getCostoEstimado(){
			return $this->costoEstimado;
		}
		public function setCostoEstimado($costoEstimado){
			$this->costoEstimado = $costoEstimado;
		}
		public function getBeneficiario(){
			return $this->beneficiario;
		}
		public function setBeneficiario($beneficiario){
			$this->beneficiario = $beneficiario;
		}
		public function setResponsable($responsable){
			$this->responsable = $responsable;
		}
		public function getResponsable(){
			return $this->responsable;
		}
		
		

		public function toJSON(){
        	return json_encode(get_object_vars($this));
    	}

		public function __toString(){
			return 	$this->nombreProyecto.','.
					$this->fechaInicio.','.
					$this->fechaFinal.','.
					$this->lugar.','.
					$this->descripcion.','.
					$this->costoEstimado.','.
					$this->beneficiario;
		}
	}
?>