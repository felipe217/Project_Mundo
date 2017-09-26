<?php


	class Colaborador 
	{
		private $codUsuario;
		private $nombreUsuario;
		private $tipoUsuario;
		private $departamento;
		private $cargo;
		private $rol;
		
		function construir(
							$codUsuario,
							$nombreUsuario,
							$tipoUsuario,
							$departamento,
							$cargo,
							$rol
							){
			$this->codUsuario = $codUsuario;
			$this->nombreUsuario = $nombreUsuario;
			$this->tipoUsuario = $tipoUsuario;
			$this->departamento = $departamento;
			$this->cargo = $cargo;
			$this->rol = $rol;
		}

		public function getCodUsuario(){
			return $this->codUsuario;
		}

		public function getNombreUsuario(){
			return $this->nombreUsuario;
		}

		public function getTipoUsuario(){
			return $this->tipoUsuario;
		}

		public function getDepartamento(){
			return $this->departamento;
		}

		public function getRol(){
			return $this->rol;
		}


		function toJSON(){
			return json_encode(get_object_vars($this));
		}

	}

?>