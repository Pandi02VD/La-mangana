<?php 
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
    }
?>
<div class="title">
    <h2>Mascota</h2>
</div>

<div style="display: inline-block; width: auto">
    <div id="graficaPeso"></div>
</div>

<!-- <div style="display: inline-block; width: auto">
    <video src="video/Animacion.mp4" controls></video>
</div> -->