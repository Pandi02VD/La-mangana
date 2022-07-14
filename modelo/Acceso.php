<?php
	class Acceso {
		static public function validarAcceso($pagina) {
			if(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"])) {
			} else {
				if ($pagina != "IniciarSesion") {
					echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
				}
			}
		}
	}