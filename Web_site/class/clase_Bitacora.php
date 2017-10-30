<?php

	class Bitacora{
		private $codOperacion;	
		private $Operacion;		
		private $codUsuario;
		private $descripcion;
		private $fecha;
		
		public function construir(
					$codOperacion,
					$Operacion,
					$codUsuario,
					$descripcion,
					$fecha					
					
			){						
			$this->codOperacion=$codOperacion;
			$this->Operacion=$Operacion;
            $this->codUsuario=$codUsuario;
            $this->descripcion=$descripcion;
            $this->fecha=$fecha;				
			
		}	
				
		public function getOperacion(){
			return $this->Operacion;
		}
		public function setOperacion($Operacion){
			$this->Operacion= $Operacion;
		}
		public function getcodUsuario(){
			return $this->codUsuario;
		}
		public function setcodUsuario($codUsuario){
			$this->codUsuario = $codUsuario;
		}		
        
        public function getcodOperacion(){
			return $this->codOperacion;
		}
		public function setcodOperacion($codOperacion){
			$this->codOperacion = $codOperacion;
		}

        public function getdescripcion(){
			return $this->descripcion;
		}
		public function setdescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

        public function getfecha(){
			return $this->fecha;
		}
		public function setfecha($fecha){
			$this->fecha = $fecha;
		}	
		
		

		public function __toString(){
			return 					
					$this->Operacion.','.
                    $this->codOperacion.','.
                    $this->descripcion.','.
                    $this->fecha.','.
					$this->codUsuario;		}
	}
?>