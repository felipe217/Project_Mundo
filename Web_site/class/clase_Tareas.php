<?php

	class Tarea{
		private $codTarea;
		private $nombreTarea;
		private $descripcion;
		private $prioridad;
		private $fechaInicio;		
		private $fechaEntrega; 

		public function construir(
					$codTarea,
					$nombreTarea,
					$descripcion,
					$prioridad,
					$fechaInicio,
					$fechaEntrega
					){
			$this->codTarea=$codTarea;
			$this->nombreTarea=$nombreTarea;
			$this->descripcion=$descripcion;
			$this->prioridad=$prioridad;
			$this->fechaInicio=$fechaInicio;
			$this->fechaEntrega=$fechaEntrega;	
		}		

		public function setCodTarea($codTarea){
			$this->codTarea= $codTarea;
		}
		public function getCodTarea(){
			return $this->codTarea;
		}
		public function getNombreTarea(){
			return $this->nombreTarea;
		}
		public function setNombreTarea($nombreTarea){
			$this->nombreTarea = $nombreTarea;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getPrioridad(){
			return $this->prioridad;
		}
		public function setPrioridad($prioridad){
			$this->prioridad = $prioridad;
		}
		public function getFechaInicio(){
			return $this->fechaInicio;
		}
		public function setFechaInicio($fechaInicio){
			$this->fechaInicio = $fechaInicio;
		}
		public function getFechaEntrega(){
			return $this->fechaEntrega;
		}
		public function setFechaEntrega($fechaEntrega){
			$this->fechaEntrega = $fechaEntrega;
		}			


		public function toJSON(){
			return json_encode(get_object_vars($this));
		}
	

		public function __toString(){
			return 	$this->nombreTarea.','.
					$this->descripcion.','.
					$this->prioridad.','.
					$this->fechaInicio.','.
					$this->fechaEntrega;
		}
	}
?>