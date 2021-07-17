<?php
	class Acceso {
		public function validarAcceso($pagina) {
			if(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"])) {
				// echo '<script>console.log("Hay acceso fuera");</script>';
				// if ($pagina == "IniciarSesion") {
				// 	echo '<script>console.log("Hay acceso IS");</script>';
				// 	echo '<script>window.location = "index.php?pagina=Inicio"</script>';
				// } else {
				// 	echo '<script>console.log("Hay acceso");</script>';
				// }
			} else {
				if ($pagina != "IniciarSesion") {
					echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
				// } elseif ($url == "IniciarSesion") {
				// 	echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
				}
			}
		}
	}