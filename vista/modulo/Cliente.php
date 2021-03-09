<?php 
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        if (!isset($_GET["Cliente"]) && !isset($_GET["uc"])) {
            echo '<script>window.location = "index.php?pagina=Error"</script>';
        }
    }

    // $usuario = Controlador::seleccionarUsuarioCtl();
?>
<h2>Cliente</h2>