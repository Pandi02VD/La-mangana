<?php
	class Pagina {
		public $paginas = array(
			'index' => "Cita", 
			'Inicio' => "Inicio", 
			'Cita' => "Cita", 
			'Agenda' => "Agenda", 
			'Pacientes' => "Pacientes", 
			'PacienteInfo' => "PacienteInfo", 
			'Usuarios' => "Usuarios", 
			'MisDatos' => "MisDatos", 
			'HistoriaMedica' => "HistoriaMedica", 
			'Configuracion' => "Configuracion", 
			'IniciarSesion' => "IniciarSesion", 
			'Salir' => "Salir", 
			'Error' => "Error"
		);

		public function getPagina($pagina){
			$objPagina = new Pagina();
			$modulos = $objPagina -> paginas;
			if(isset($modulos[$pagina])){
				$ruta = "vista/modulo/".$modulos[$pagina].".php";
				$modulos[$pagina] != 'Cita' ? Acceso::validarAcceso($pagina) : null;
			}else{
				$ruta = "vista/modulo/Error.php";
			}
			return $ruta;
		}
	}