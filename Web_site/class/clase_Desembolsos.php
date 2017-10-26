<?php

	class Desembolsos{
			
		private $fecha;		
		private $valor;
		
		
		
		public function construir(
					$fecha,
					$valor
					
					
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