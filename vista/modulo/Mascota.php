<?php 
    $nameGET = 'um';
    $mascota = ControladorMascota::seleccionarMascotaCtl($_GET[$nameGET]);
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