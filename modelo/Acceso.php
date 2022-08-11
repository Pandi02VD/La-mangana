<?php
	class Acceso {
		public function validarAcceso($pagina) {
			if(
				isset($_SESSION["ingresado"]) && 
				isset($_SESSION["usuario"]) && 
				isset($_SESSION["tipo-usuario"])
			) {
			} else {
				if ($pagina != "IniciarSesion") {
					echo '<script>window.location = "IniciarSesion"</script>';
				}
			}
		}
	}