<?php

	class Desembolsos{
		private $codDesembolso;	
		private $fecha;		
		private $valor;
		private $codPatrocinio;
		private $codProyecto;
		
		public function construir(
					$codDesembolso,
					$fecha,
					$valor,
					$codPatrocinio,
					$codProyecto					
					
			){						
			$this->fecha=$fecha;
			$this->valor=$valor;				
			
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
			return 					
					$this->fecha.','.
					$this->valor;		}
	}
?>