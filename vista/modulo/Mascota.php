<?php 
    if(!(isset($_SESSION["tipo-usuario"]) && isset($_SESSION["ingresado"]))){
        echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
    }else{
        if (!isset($_GET["um"])) {
            echo '<script>window.location = "index.php?pagina=IniciarSesion"</script>';
        } else {
            $mascota = ControladorMascota::seleccionarMascotaCtl($_GET["um"]);
        }
    }
?>
<div class="title">
    <h2>Mascota</h2>
    <h3><?=$mascota["nombre"]?></h3>
</div>
<!-- <div style="display: inline-block; width: auto"> -->
<div>
    <input type="hidden" name="mascotaid" id="mascotaid" value="<?=$mascota["idmascota"]?>">
    <div id="graficaPeso"></div>
</div>

<!-- <div style="display: inline-block; width: auto">
    <video src="video/Animacion.mp4" controls></video>
</div> -->