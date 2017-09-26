<?php

	class Usuario{
		private $identificacion;
		private $nombre;
		private $apellido;
		private $nacimiento;
		private $domicilio;
		private $departamento;
		private $cargo;
		

		public function __construct(
					$identificacion,
					$nombre,
					$apellido,
					$nacimiento,
					$domicilio,
					$departamento,
					$cargo
			){
			$this->identificacion=$identificacion;
			$this->nombre=$nombre;
			$this->apellido=$apellido;
			$this->nacimiento=$nacimiento;
			$this->domicilio=$domicilio;
			$this->departamento=$departamento;
			$this->cargo=$cargo;
			
		}		

		public function getIdentificacion(){
			return $this->identificacion;
		}
		public function setIdentificacion($identificacion){
			$this->identificacion = $identificacion;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getApellido(){
			return $this->apellido;
		}
		public function setApellido($apellido){
			$this->apellido = $apellido;
		}
		public function getNacimiento(){
			return $this->nacimiento;
		}
		public function setNacimiento($nacimiento){
			$this->nacimiento = $nacimiento;
		}
		public function getDomicilio(){
			return $this->domicilio;
		}
		public function setDomicilio($domicilio){
			$this->domicilio = $domicilio;
		}
		public function getDepartamento(){
			return $this->departamento;
		}
		public function setDepartamento($departamento){
			$this->departamento = $departamento;
		}
		public function getCargo(){
			return $this->cargo;
		}
		public function setCargo($cargo){
			$this->cargo = $cargo;
		}
		
		}
		// function encender(){
		// 	echo "Encendiendo";
		// }
		// function apagar(){
		// 	echo "Apagando";
		// }
		// function explotar(){
		// 	echo "Explotando";
		// }
		// function procesar(){
		// 	echo "Procesando";
		// }

		public function __toString(){
			return 	$this->identificacion.','.
					$this->nombre.','.
					$this->apellido.','.
					$this->nacimiento.','.
					$this->domicilio.','.
					$this->departamento.','.
					$this->cargo;
		}
	}
?>