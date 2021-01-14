<?php 
    $desconectarUsuario = Controlador::desconectarUsuarioCtl($_SESSION["usuario"]);
    if ($desconectarUsuario == "desconectado") {
        session_destroy();
        echo '<script>window.location = "index.php?pagina=IniciarSesion";</script>';
    }else{
        echo '<span>Error al cerrar la sesión</span>';
    }