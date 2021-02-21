<?php
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }
?>
<h2>Inicio</h2>