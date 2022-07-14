<?php
	class Pagina {
		public $paginas = array(
			'index' => "Inicio", 
			'Inicio' => "Inicio", 
			'IniciarSesion' => "IniciarSesion", 
			'Usuarios' => "Usuarios", 
			'Usuario' => "Usuario", 
			'Clientes' => "Clientes", 
			'Cliente' => "Cliente", 
			'MascotasCliente' => "MascotasCliente", 
			'Mascotas' => "Mascotas", 
			'Mascota' => "Mascota", 
			'HistoriaClinica' => "HistoriaClinica", 
			'Razas' => "Razas", 
			'Jaulas' => "Jaulas", 
			'Servicios' => "Servicios", 
			'Hospitalizacion' => "Hospitalizacion", 
			'HospitalizacionInfo' => "HospitalizacionInfo", 
			'Cirugia' => "Cirugia", 
			'CirugiaInfo' => "CirugiaInfo", 
			'Medicina' => "Medicina", 
			'MedicinaInfo' => "MedicinaInfo", 
			'Salir' => "Salir", 
			'Error' => "Error"
		);

		static public function traerPagina($pagina){
			$objPagina = new Pagina();
			$modulos = $objPagina -> paginas;
			if(isset($modulos[$pagina])){
				$ruta = "vista/modulo/".$modulos[$pagina].".php";
				Acceso::validarAcceso($pagina);
			}else{
				$ruta = "vista/modulo/Error.php";
			}
			return $ruta;
		}
	}