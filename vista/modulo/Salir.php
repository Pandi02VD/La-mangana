<?php 
	$desconectarUsuario = ControladorUsuario::desconectarUsuarioCtl($_SESSION["usuario"]);
	if ($desconectarUsuario == true) {
		session_destroy();
		echo '<script>window.location = "index.php?pagina=IniciarSesion";</script>';
	}else{
		echo '<span>Error al cerrar la sesión</span>';
	}