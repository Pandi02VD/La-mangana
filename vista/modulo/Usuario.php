<?php 
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        if ($_SESSION["tipo-usuario"] != 1) {
            echo '<script>
                    window.location = "index.php?pagina=Inicio";
                    alert("No tiene acceso a esta parte del sistema");
                </script>';
        }
    }
    // $usuarios = ControladorUsuario::seleccionarUsuariosCtl();
?>
<h2>Usuario</h2>