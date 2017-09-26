<?php

	class Material 
	{
		private $codMaterial;
		private $proveedor;
		private $material;
		private $cantidad;
		private $precio;
		private $total;
		
		function construir( 
							$codMaterial,
							$proveedor,
							$material,
							$cantidad,
							$precio,
							$total
							)
						{
					$this->codMaterial = $codMaterial;
					$this->proveedor = $proveedor;
					$this->material = $material;
					$this->cantidad = $cantidad;
					$this->precio = $precio;
					$this->total = $total;		
		}



		function toJSON(){
			return json_encode(get_object_vars($this));
		}
	}


?>