<?php

	class Patrocinios{
		private $codigo;
		private $tipoPatrocinio;
		private $descripcion;		
		private $fecha;		
		private $valor;
		private $codPatrocinador;
		
		
		
		public function construir(
					$codigo,
					$tipoPatrocinio,
					$descripcion,
					$fecha,
					$valor,
					$codPatrocinador
					
					
			){
			$this->tipoPatrocinio=$tipoPatrocinio;
			$this->descripcion=$descripcion;			
			$this->fecha=$fecha;
			$this->valor=$valor;			
			
			
		}		

		public function getTipoPatrocinio(){
			return $this->tipoPatrocinio;
		}
		public function setTipoPatrocinio($tipoPatrocinio){
			$this->tipoPatrocinio = $tipoPatrocinio;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}		
		public function getFecha(){
			return $this->fecha;
		}
		public function setFecha($fecha){
			$this->fecha= $fecha;
		}
		public function getValor(){
			return $this->valor;
		}
		public function setValor($valor){
			$this->valor = $valor;
		}		

		public function __toString(){
			return 	$this->tipoPatrocinio.','.
					$this->descripcion.','.					
					$this->fecha.','.
					$this->valor;		}
	}
?>