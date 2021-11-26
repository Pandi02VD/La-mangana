<?php
	class Acceso {
		public function validarAcceso($pagina) {
			if(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"])) {
			} else {
				if ($pagina != "IniciarSesion") {
					echo '<script>window.location = "IniciarSesion"</script>';
				}
			}
		}
	}